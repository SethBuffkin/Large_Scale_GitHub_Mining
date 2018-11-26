package main;

import org.eclipse.egit.github.core.service.CommitService;
import org.eclipse.egit.github.core.service.IssueService;
import org.eclipse.egit.github.core.service.RepositoryService;

import com.mongodb.MongoClient;
import com.mongodb.client.MongoCollection;
import com.mongodb.client.MongoDatabase;
import com.mongodb.client.model.Filters;
import com.mongodb.client.model.UpdateOptions;

import org.bson.Document;
import org.bson.conversions.Bson;
import org.eclipse.egit.github.core.Issue;
import org.eclipse.egit.github.core.Repository;
import org.eclipse.egit.github.core.RepositoryCommit;
import org.eclipse.egit.github.core.RepositoryId;
import org.eclipse.egit.github.core.SearchRepository;
import org.eclipse.egit.github.core.client.GitHubClient;

import java.io.IOException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;


class SearchEngine {
	
	private RepositoryService rs;
	private CommitService cs;
	private IssueService is;
	private ArrayList<SearchRepository> repoList;
	private ArrayList<String> urls = new ArrayList<String>();
	private ArrayList<Long> repoId = new ArrayList<Long>();
	private List<Document> repoData = new ArrayList<Document>();
	private List<Document> commitData = new ArrayList<Document>();
	private List<Document> issueData = new ArrayList<Document>();
	private int numOfResults;
	
	public SearchEngine(GitHubClient client){
		this.rs =  new RepositoryService(client);
		this.cs = new CommitService(client);
		this.is = new IssueService(client);
		this.repoList = new ArrayList<SearchRepository>();
		this.numOfResults = 10;
	}
	
	public SearchEngine(GitHubClient client, int resultNum){
		this.rs =  new RepositoryService(client);
		this.cs = new CommitService(client);
		this.is = new IssueService(client);
		this.repoList = new ArrayList<SearchRepository>();
		this.numOfResults = resultNum;
	}
	
	
	public void Search(String query) throws IOException{
		this.repoList = (ArrayList<SearchRepository>) this.rs.searchRepositories(query);
		SearchRepository searchRepo;
		Repository repo;
		this.numOfResults = Math.min(numOfResults, repoList.size());
		for(int i =0; i < numOfResults; ++i){
			searchRepo =this.repoList.get(i);
			repo = rs.getRepository(RepositoryId.createFromId(searchRepo.generateId())); 
			crawlRepo(repo);
			crawlSingleRepoCommits(repo);
			crawlSingleRepoIssues(repo);
		}
	}
	
	//Input results into mongoDB
	public void OutputResults(){
		//Connect to database
		System.out.println("Successfully connect to database");
		MongoClient mongoClient = new MongoClient( "localhost" , 27017 );
		MongoDatabase db = mongoClient.getDatabase("test");
		//Write data in bulk to repositories collection
		MongoCollection<Document> curCollection = db.getCollection("repositories"); 
		System.out.println("Writing repository matadata into database");
		//update repositories database when "name" and "author" is different
		for(Document newData: repoData){
			Bson filter = Filters.eq("repoID", newData.get("repoID"));
			UpdateOptions options = new UpdateOptions().upsert(true);   
			curCollection.replaceOne(filter, newData, options);
		}
		//Write data in bulk to commits collection
		System.out.println("Writing commits data into database");
		curCollection = db.getCollection("commits");
		//update commits database when "SHA" is different
		for(Document newData: commitData){
			Bson filter = Filters.eq("SHA", newData.get("SHA"));
			UpdateOptions options = new UpdateOptions().upsert(true);   
			curCollection.replaceOne(filter, newData, options);
		}
		
		//Write data in bulk to issues collection
		System.out.println("Writing issue data into database");
		curCollection = db.getCollection("issues");
		//update issues database when issueId is different
		for(Document newData: issueData){
			Bson filter = Filters.eq("issueId", newData.get("issueId"));
			UpdateOptions options = new UpdateOptions().upsert(true);   
			curCollection.replaceOne(filter, newData, options);
		}
		///Close database
		mongoClient.close();
	}
	
	public ArrayList<String> getUrls(){
		return this.urls;
	}
	
	public ArrayList<Long> getRepoIds(){
		return this.repoId;
	}
	
	// Strip meta data from repositories
	private void crawlRepo(Repository repo) throws IOException {
		this.urls.add(repo.getHtmlUrl());
		this.repoId.add(repo.getId());
		this.repoData.add(new Document("repoID", repo.getId())
				.append("name",repo.getName())
				//get Owner will return null, so manually parse the owner
				.append("owner", repo.getHtmlUrl().replace("https://github.com/", "")
						.replace("/" + repo.getName(), ""))
			    .append("creationDate",repo.getCreatedAt())
			    .append("lastUpdate", repo.getUpdatedAt())
			    .append("language",repo.getLanguage())
			    .append("watchers",  repo.getWatchers())
			    .append("forks", repo.getForks())
			    .append("isFork", repo.isFork())
			    .append("hasIssues", repo.isHasIssues())
			    .append("numberOfOpenIssues", repo.getOpenIssues())
			    .append("hasWiki", repo.isHasWiki())
			    .append("size", repo.getSize() + " kb")
			    .append("url",repo.getHtmlUrl())
				.append("description", repo.getDescription()));
	}

	// Strip meta data for commits from a repository
	private void crawlSingleRepoCommits(Repository repo) throws IOException {
		List<RepositoryCommit> commits = (List<RepositoryCommit>) cs.getCommits(repo);
		for(RepositoryCommit rc : commits){
			this.commitData.add(new Document("repoID", repo.getId())
					.append("SHA", rc.getSha())
					.append("commitMessage", rc.getCommit().getMessage())
					.append("commentCount", rc.getCommit().getCommentCount())
					.append("commitAuthor", rc.getCommit().getAuthor().getName()));
		}
	}

	// Strip meta data for issues from a repository
	private void crawlSingleRepoIssues(Repository repo) throws IOException {
		Map<String,String> filter = new HashMap<String,String>();
		filter.put("state", "all");
		List<Issue> issues = (List<Issue>) is.getIssues(repo, filter);
		for(Issue issue : issues){
			this.issueData.add(new Document("repoId", repo.getId())
					.append("issueId", issue.getId())
					.append("creationDate", issue.getCreatedAt())
					.append("state", issue.getState())
					.append("closeDate", issue.getClosedAt())
					.append("lastUpdate", issue.getUpdatedAt())
					.append("commentCount", issue.getComments())
					.append("labels", issue.getLabels().toString())
					.append("title", issue.getTitle())
					.append("body", issue.getBody()));
		}
	}
	
}
