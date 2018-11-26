package main;

import java.io.File;
import java.util.ArrayList;

import org.eclipse.jgit.api.Git;
import org.eclipse.jgit.api.errors.GitAPIException;
import org.eclipse.jgit.api.errors.InvalidRemoteException;
import org.eclipse.jgit.api.errors.JGitInternalException;
import org.eclipse.jgit.api.errors.TransportException;

/**
 * @author Zhuowei Huang
 * A script for cloning Git repositories with Jgit
 */
public class CloneEngine{
	
	private ArrayList<String> urls;
	private ArrayList<Long> repoIds;
	private File storePath;
	private String path;
	
	// Constructor
	public CloneEngine (ArrayList<String> url, ArrayList<Long> ids, String inputPath){
		this.urls = url;
		this.repoIds = ids;
		this.path = inputPath;
		storePath = new File (path);
	}
	
	// Clone function
	public void Clone() throws InvalidRemoteException, TransportException, GitAPIException{
		for(int i = 0; i < urls.size(); i++){
			String url = urls.get(i);
			//String extension = url.replace("https://github.com", "");
			String extension = repoIds.get(i).toString();
			storePath = new File(path + extension);
			try{
				Git.cloneRepository().setURI(url).setDirectory(storePath).call();
				System.out.println("Cloning from " + url + " to " + storePath);
			}catch(JGitInternalException e){
				System.out.println(extension + " already cloned");
			}
		}
	}

}
