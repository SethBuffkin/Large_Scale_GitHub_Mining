package main;

import java.util.Scanner;
import java.io.*;
import org.eclipse.jdt.core.dom.*;
import java.io.FileOutputStream; 
import java.util.List;
import java.util.Iterator;


// print methods and general concept from "How to Train the JDT Dragon"
// https://www.eclipsecon.org/2012/sites/eclipsecon.org.2012/files/How%20To%20Train%20the%20JDT%20Dragon%20combined.pdf

public class ASTGeneration {

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
         } 
         else if (descriptor instanceof ChildPropertyDescriptor) {
         
            ChildPropertyDescriptor child = (ChildPropertyDescriptor) descriptor;
            ASTNode childNode = (ASTNode) node.getStructuralProperty(child);
            if (childNode != null) {
               tab(spaces);
            
               System.out.println(child.getId() + "{");
               print(childNode, spaces + 1); //<--------recursion!
               tab(spaces);
            
               System.out.println("}");
            }
         } 
         else {
         
            ChildListPropertyDescriptor list = (ChildListPropertyDescriptor) descriptor;
            tab(spaces);
            System.out.println(list.getId() + "{");
            print((List) node.getStructuralProperty(list), spaces + 1);//<--------recursion!
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
   
   public static void tab(int spaces){
      while(spaces>0)
      {
         System.out.print("  ");
         spaces--;
      }
   }

   public static void main(String args[]){
      
      ASTParser parser = ASTParser.newParser(AST.JLS3);
      String filename = "";
      String content = "";
      
      System.out.println("Enter a filename: ");
      
   
      filename = new Scanner(System.in).nextLine();
      
      try{
         content = new Scanner(new File(filename)).useDelimiter("\\Z").next();
      }
      catch(FileNotFoundException e){
         e.printStackTrace();}
   
     
      parser.setSource(content.toCharArray());
      parser.setKind(ASTParser.K_COMPILATION_UNIT);
      parser.setResolveBindings(true);
      CompilationUnit parse = (CompilationUnit) parser.createAST(null);
   
   
      try {
      
         PrintStream out = new PrintStream(new FileOutputStream(filename + "_AST.txt"));
         System.setOut(out);
      }
      catch(IOException e1) {
         System.out.println("Couldn't write file");
      }
   
   
      print(parse, 0);
      
   }
}