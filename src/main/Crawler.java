package main;

import java.io.File;
import java.io.IOException;
import java.io.PrintStream;
import java.util.Arrays;
import java.util.LinkedList;

import org.eclipse.egit.github.core.client.GitHubClient;
import org.eclipse.jgit.api.errors.GitAPIException;
import org.eclipse.jgit.api.errors.InvalidRemoteException;
import org.eclipse.jgit.api.errors.TransportException;
import org.quartz.Job;
import org.quartz.JobExecutionContext;
import org.quartz.JobExecutionException;

public class Crawler implements Job {

	/**
	 * Method to keep the application from running out of GitHub API queries.
	 * Sleeps the current thread for ten minutes if the number of remaining API
	 * queries (aka requests) is less than a threshold that differs depending on
	 * whether the client is authenticated.
	 * 
	 * @param client
	 *            - GitHubClient used for API querying (can be null)
	 */
	public void limitQueries(GitHubClient client) { // method name subject to
													// change
		int remainingRequests;
		if (client == null) {
			client = new GitHubClient();
		}

		// grab remaining API queries
		remainingRequests = client.getRemainingRequests();

		// determine the proper threshold for rate limiting (subject to change)
		int limit = (client == null) ? 10 : 50;

		// get milliseconds in ten minutes
		long time = 1000 * 60 * 10;
		while (remainingRequests < limit) {
			// try-catch in order to fulfill Thread.sleep requirements
			try {
				// sleep for ten minutes
				Thread.sleep(time);
			} catch (InterruptedException e) {
				// don't really allow interrupts (possibly bad form)
				System.err.println("Unexpected thread interrupt");
			}

			// grab remaining API queries
			remainingRequests = client.getRemainingRequests();
		}
	}

	/* Recursively traverse a directory and generate AST file */
	public static void getAST(String directoryName, ASTGenerator astg, String topDirectory) {
		File directory = new File(directoryName);
		// Check if the current directory is a top-level sub-directory (file
		// path contains repoId)
		if (directory.getParentFile().getName().equals(topDirectory)) {
			astg.setRepoId(Long.parseLong(directory.getName()));
		}
		// get all the files from a directory
		LinkedList<File> fList = new LinkedList<File>(Arrays.asList(directory.listFiles()));
		while (!fList.isEmpty()){
			File f = fList.poll();
			if(f.getName().endsWith(".java")){
				astg.generate(f);
				astg.generate_small(f);
			}else if(f.isDirectory()){
				fList.addAll(Arrays.asList(new File(f.getAbsolutePath()).listFiles()));
			}else{
				continue;
			}
		}
	}

	public static void main(String[] args) throws InvalidRemoteException, TransportException, GitAPIException {
		// TODO: Set the path to store cloned projects
		// String cloneDest = "C:/miningDir/"; // Bree's test directory
		String cloneDest = "/data/db/"; // Seth's
		// TODO: Set the path to store AST files
		// String ASTDest = "C:/miningDir/AST/"; //Bree's test directory
		String ASTDest = "/data/ast/"; // Seth's
		int queryLimit = 10;

		// create a client with Ben's personal access token
		GitHubClient ben = new GitHubClient();
		ben.setOAuth2Token("adeecbc47992116fddbe38bf4b08d7d1e38f58b1");

		System.out.println("[Crawler] Inside main function");
		// Handle queries, arrange into desired format
		String myQuery = args[0];

		// Take query for search
		SearchEngine mySearch = new SearchEngine(ben, queryLimit);
		try {
			mySearch.Search(myQuery);
		} catch (IOException e) {
			System.out.println("[Crawler] Search Interrupted");
			e.printStackTrace();
		}
		// Data -> MongoDB
		mySearch.OutputResults();
		// Take search result urls for clone
		CloneEngine cl = new CloneEngine(mySearch.getUrls(), mySearch.getRepoIds(), cloneDest);
		cl.Clone();
		// Use AST parser to Parse AST

		ASTGenerator astg = new ASTGenerator(ASTDest);

		String[] arr = cloneDest.split("/");
		String topSubDir = arr[arr.length - 1];
		System.out.println("[Crawler] Generating AST files");
		PrintStream standard = System.out;
		try{
			getAST(cloneDest, astg, topSubDir);
			System.setOut(standard);
		} catch (org.bson.BsonSerializationException e) {
			System.out.println("bson file too big");
		}
		finally{
			System.out.println("[Crawler] Finished " + myQuery);
		}
	}

	public void execute(JobExecutionContext context) throws JobExecutionException {
		String args[] = new String[2];
		args[0] = context.getJobDetail().getJobDataMap().getString("queryText");
		System.out.println("[Crawler] Beginning crawl with query '" + args[0] + "'");
		try {
			main(args);
		} catch (InvalidRemoteException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (TransportException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (GitAPIException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}

}
