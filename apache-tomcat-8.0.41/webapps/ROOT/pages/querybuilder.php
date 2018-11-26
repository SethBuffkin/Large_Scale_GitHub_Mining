<?php
// querybuilder.php
// Turns a form/group of forms into a GitHub API query
// Currently outlines more functionality than is implemented on the
// front end

$keyword = null;
$inchoice = null;
$sizemin = null;
$sizemax = null;
$forksmin = null;
$forksmax = null;
$isfork = null;
$createstart = null;
$createend = null;
$pushedstart = null;
$pushedend = null;
$languages = array();
$notlanguages = array();
$starsmin = null;
$starsmax = null;

// handling language input
if(isset($_POST['java'])){
	array_push($languages, 'java');
}

if(isset($_POST['C'])){
	array_push($languages, 'c');
}
if(isset($_POST['Python'])){
	array_push($languages, 'python');
}
if(isset($_POST['HTML'])){
	array_push($languages, 'html');
}
if(isset($_POST['CSS'])){
	array_push($languages, 'css');
}

if(isset($_POST['other'])){
	$tmp = $_POST["other"];
	$tmp = trim($tmp, " /");
	$tmparray = explode(', ', $tmp);
	$languages = array_merge($languages, $tmparray);
}

// handling minimum star input
if (strlen($_POST["stars"]) != 0) {
	$starsmin = $_POST["stars"];
}

// handling minimum fork input
if (strlen($_POST["forks"]) != 0) {
	$forksmin = $_POST["forks"];
}

/*
 * to implement later
 * 
// handling creation date information
if (strlen($_POST["date"]) != 0) {
	$tmp = $_POST["date"];
	$date = explode(" - ", $tmp);
}
*/

// handling unwanted language input
if (strlen($_POST["neglanguages"]) != 0) {
	$tmp = $_POST["neglanguages"];
	$tmp = trim($tmp, " /");
	$tmparray = explode(', ', $tmp);
	$notlanguages = array_merge($notlanguages, $tmparray);
}

// handling keyword input
if (strlen($_POST["project"]) != 0) {
	$keyword = $_POST["project"];
}

$finalquery = '';

if ($keyword != null) {
	$finalquery = $finalquery . $keyword;
}

// add languages and unwanted languages to the query
foreach ($languages as $language) {
	$language = ' language:' . $language;
	$finalquery = $finalquery . $language;
}

foreach ($notlanguages as $language) {
	$language = ' -language:' . $language;
	$finalquery = $finalquery . $language;
}

unset($language);

// add star information to the query
$starnums = ' stars:';
if ($starsmin != null) {
	$starnums = $starnums . $starsmin;
}
else {
	$starnums = $starnums . '*';
}

$starnums = $starnums . '..';

if ($starsmax != null) {		// currently unimplemented on front end
	$starnums = $starnums . $starsmax;
}
else {
	$starnums = $starnums . '*';
}

$finalquery = $finalquery . $starnums;

unset($starnums);

// add choice of location(s) to search for keyword to the query
if ($inchoice != null) {		// currently unimplemented on front end
	
}

// add repository size (kb) information to the query
if ($sizemin != null) {			// currently unimplemented on front end
	
}

if ($sizemax != null) {			// currently unimplemented on front end
	
}

// add fork number information to the query
$forknums = ' forks:';
if ($forksmin != null) {
	$forknums = $forknums . $forksmin;
}
else {
	$forknums = $forknums . '*';
}

$forknums = $forknums . '..';

if ($forksmax != null) {		// currently unimplemented on front end
	$forknums = $forknums . $forksmax;
}
else {
	$forknums = $forknums . '*';
}

$finalquery = $finalquery . $forknums;

unset($forknums);

// add information to the query about whether forks are allowed
if ($isfork != null) {			// currently unimplemented on front end
	
}

// add creation date information to the query
if ($createstart != null) {		// currently unimplemented
	
}

if ($createend != null) {		// currently unimplemented
	
}

// add most recent push date information to the query
if ($pushedstart != null) {		// currently unimplemented on front end
	
}

if ($pushedend != null) {		// currently unimplemented on front end
	
}

// TODO: start jar script

// for testing
echo $finalquery;


?>
