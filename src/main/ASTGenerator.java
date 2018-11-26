package main;

import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.PrintStream;
import java.util.ArrayList;
import java.util.Iterator;
import java.util.List;
import java.util.Scanner;
import java.util.Vector;

import org.bson.Document;
import org.bson.conversions.Bson;
import org.eclipse.jdt.core.dom.AST;
import org.eclipse.jdt.core.dom.ASTNode;
import org.eclipse.jdt.core.dom.ASTParser;
import org.eclipse.jdt.core.dom.ASTVisitor;
import org.eclipse.jdt.core.dom.ChildListPropertyDescriptor;
import org.eclipse.jdt.core.dom.ChildPropertyDescriptor;
import org.eclipse.jdt.core.dom.CompilationUnit;
import org.eclipse.jdt.core.dom.ImportDeclaration;
import org.eclipse.jdt.core.dom.MethodDeclaration;
import org.eclipse.jdt.core.dom.MethodInvocation;
import org.eclipse.jdt.core.dom.SimpleName;
import org.eclipse.jdt.core.dom.SimplePropertyDescriptor;
import org.eclipse.jdt.core.dom.TypeDeclaration;
import org.eclipse.jdt.core.dom.VariableDeclarationFragment;

import com.mongodb.MongoClient;
import com.mongodb.client.MongoCollection;
import com.mongodb.client.MongoDatabase;
import com.mongodb.client.model.Filters;
import com.mongodb.client.model.UpdateOptions;

public class ASTGenerator {

	//vectors for small AST generation
	static Vector methodInvocations = new Vector();
	static Vector variableNames = new Vector();
	static Vector classNames = new Vector();
	static Vector methodNames = new Vector();
	static Vector importNames = new Vector();
	static Vector methodsUsed = new Vector();
	
	private ASTParser parser;
	private String path;
	private long repoId = 0;
	
	public ASTGenerator(String s){
		this.path = s;
		this.parser = ASTParser.newParser(AST.JLS3);
	}
	
	public void setRepoId(long repo){
		this.repoId = repo;
	}
	
	public long getRepoId(){
		return this.repoId;
	}
	
	public static void print(ASTNode node, int spaces) {

		List properties = node.structuralPropertiesForType();
		for (Iterator iterator = properties.iterator(); iterator.hasNext();) {
			Object descriptor = iterator.next();
			if (descriptor instanceof SimplePropertyDescriptor) {
				SimplePropertyDescriptor simple = (SimplePropertyDescriptor) descriptor;
				Object value = node.getStructuralProperty(simple);
				if(!(value == null)){
					tab(spaces);
					System.out.println(simple.getId() + " (" + value.toString() + ")");
				}
			} else if (descriptor instanceof ChildPropertyDescriptor) {

				ChildPropertyDescriptor child = (ChildPropertyDescriptor) descriptor;
				ASTNode childNode = (ASTNode) node.getStructuralProperty(child);
				if (childNode != null) {
					tab(spaces);

					System.out.println(child.getId() + "{");
					print(childNode, spaces + 1);
					tab(spaces);

					System.out.println("}");
				}
			} else {

				ChildListPropertyDescriptor list = (ChildListPropertyDescriptor) descriptor;
				tab(spaces);
				System.out.println(list.getId() + "{");
				print((List) node.getStructuralProperty(list), spaces + 1);
				tab(spaces);
				System.out.println("}");
			}
		}
	}

	public static void print(List nodes, int spaces) {
		for (Iterator iterator = nodes.iterator(); iterator.hasNext();) {
			print((ASTNode) iterator.next(), spaces);
		}
	}

	public static void tab(int spaces) {
		while (spaces > 0) {
			System.out.print("  ");
			spaces--;
		}
	}

	public void generate(File file) {
		
		String content = "";

		try {
			content = new Scanner(file).useDelimiter("\\Z").next();
		} catch (FileNotFoundException e) {
			e.printStackTrace();
		}

		this.parser.setSource(content.toCharArray());
		this.parser.setKind(ASTParser.K_COMPILATION_UNIT);
		this.parser.setResolveBindings(true);
		CompilationUnit parse = (CompilationUnit) this.parser.createAST(null);

		try {
			PrintStream out = new PrintStream(new FileOutputStream(path + file.getName() +"_AST.txt"));
			System.setOut(out);
		} catch (IOException e1) {
			System.out.println("Couldn't write file");
		}

		print(parse, 0);

	}
	
	public void generate_small(File file) {
		String content = "";
		// input from
		// http://stackoverflow.com/questions/3402735/what-is-simplest-way-to-read-a-file-into-string
		try {
			content = new Scanner(file).useDelimiter("\\Z").next();
		} catch (FileNotFoundException e) {
			e.printStackTrace();
		}
		this.parser.setSource(content.toCharArray());
		this.parser.setKind(ASTParser.K_COMPILATION_UNIT);
		final CompilationUnit cu = (CompilationUnit) this.parser.createAST(null);

		cu.accept(new ASTVisitor() {
			public boolean visit(VariableDeclarationFragment node) {
				SimpleName name = node.getName();
				variableNames.add(name.toString());
				return true; // do not continue to avoid usage info
			}
			public boolean visit(TypeDeclaration node) {
				classNames.add(node.getName().toString());
				return true;
			}
			public boolean visit(MethodDeclaration node) {
				methodNames.add(node.getName().toString());
				return true;
			}
			public boolean visit(ImportDeclaration node) {
				importNames.add(node.getName().toString());
				return false;
			}
			public boolean visit(MethodInvocation node) {
				methodInvocations.add(node.getName().toString());
				return false;
			}
		});
		
		int count = 0;

		for (int x = 0; x < methodInvocations.size(); x++) {
			count = 0;
			for (int y = x + 1; y < methodInvocations.size(); y++) {
				if (methodInvocations.get(x).equals(methodInvocations.get(y))) {
					methodInvocations.remove(y);
					count++;
					y--;
				}
			}
			count++;
			methodsUsed.add(methodInvocations.get(x) + " = " + count);
		}
		//dump data into MongoDB
		MongoClient client = new MongoClient( "localhost" , 27017 );
		MongoDatabase db = client.getDatabase("test");
		MongoCollection<Document> curCollection = db.getCollection("ast");
		Document doc = new Document("repoId", this.repoId)
				.append("Imports", importNames)
				.append("Classes", classNames)
				.append("Methods", methodNames)
				.append("Variables", variableNames)
				.append("Methods & # of Invocations", methodsUsed);
		Bson filter = Filters.eq("repoId",doc.get("repoId"));
		UpdateOptions options = new UpdateOptions().upsert(true);   
		curCollection.replaceOne(filter, doc, options);
		client.close();
	}
	
	
}
