<!DOCTYPE HTML>
<html>
<head>
<title>Query Input</title>
</head>
<body>

project: <?php echo $_POST["project"]; ?><br>

languages: 
<?php 
if(isset($_POST['java'])){
	echo"Java, ";
}

if(isset($_POST['C'])){
	echo"C/C++, ";
}
if(isset($_POST['Python'])){
	echo"Python, ";
}
if(isset($_POST['HTML'])){
	echo"HTML, ";
}
if(isset($_POST['CSS'])){
	echo"CSS, ";
}

if(isset($_POST['other_languages'])){
	echo $_POST["other"];
}
?>
// <?php echo $_POST["other"]; ?>
<br>
stars: <?php echo $_POST["stars"]; ?><br>
forks: <?php echo $_POST["forks"]; ?><br>
date: <?php echo $_POST["date"]; ?><br>
tags: <?php echo $_POST["tags"]; ?>


</body>
</html>