package main;

import java.util.Scanner;
import java.io.*;
import org.eclipse.jdt.core.dom.*;
import java.io.FileOutputStream;
import java.util.Vector;

//code adapted from http://www.programcreek.com/2011/01/a-complete-standalone-example-of-astparser/
//useful resource http://help.eclipse.org/mars/index.jsp?topic=%2Forg.eclipse.jdt.doc.isv%2Freference%2Fapi%2Forg%2Feclipse%2Fjdt%2Fcore%2Fdom%2FASTVisitor.html

public class Test {

	static Vector methodInvocations = new Vector();
	static Vector variableNames = new Vector();
	static Vector classNames = new Vector();
	static Vector methodNames = new Vector();
	static Vector importNames = new Vector();
	static Vector methodsUsed = new Vector();

	public static void main(String args[]) {

		ASTParser parser = ASTParser.newParser(AST.JLS3);
		String content = "";
		String filename = "";
		System.out.println("Enter a filename: ");

		filename = new Scanner(System.in).nextLine();

		// input from
		// http://stackoverflow.com/questions/3402735/what-is-simplest-way-to-read-a-file-into-string
		try {
			content = new Scanner(new File(filename)).useDelimiter("\\Z").next();
		} catch (FileNotFoundException e) {
			e.printStackTrace();
		}

		parser.setSource(content.toCharArray());
		parser.setKind(ASTParser.K_COMPILATION_UNIT);
		final CompilationUnit cu = (CompilationUnit) parser.createAST(null);

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
		try {
			PrintStream out = new PrintStream(new FileOutputStream(filename + "_output.txt"));
			System.setOut(out);
		} catch (IOException e1) {
			System.out.println("Couldn't write file");
		}
		System.out.println("Imports: " + importNames);
		System.out.println("Classes: " + classNames);
		System.out.println("Methods: " + methodNames);
		System.out.println("Variables: " + variableNames);

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

		System.out.println("Methods and Number of Invocations: " + methodsUsed);

	}

}