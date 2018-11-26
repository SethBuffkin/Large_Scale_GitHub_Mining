<?php
		$fullboat=array();
		$commandstring=null;

		        if(isset($_GET['repository'])){
            #echo $_GET['format'] ."<br />\n";
			#echo json_encode($_GET['command']) ."<br />\n";
			
			$fullboat['repoId'] = array('$eq' => intval($_GET['repository']));
			if(isset($_GET['title'])){
	 $committed=$_GET['title'];
	 $committed= str_replace(" ",".*",$committed);
	 if (strlen($committed)>0) {
		$fullboat['title']= array('$regex' => $committed, '$options' => 'i');
	 }
 }
						#echo json_encode($fullboat);
			
#			$mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");			
#			$query = new MongoDB\Driver\Query($fullboat);

#			$rows = $mng->executeQuery('test.issues', $query);
#{ "_id" : ObjectId("58f4185e488be81bd0740ec9"), "repoId" : NumberLong(7009146), "issueId" : NumberLong(42755186), "creationDate" : ISODate("2014-09-15T09:36:42Z"), "state" : "open", "closeDate" : null, "lastUpdate" : ISODate("2014-09-15T09:36:42Z"), "commentCount" : 0, "labels" : "[]", "title" : "add a form for crawl an user or an organization", "body" : "Will allow update components without using crawler website or component(1) command\n\nhttps://github.com/componentjs/crawler.js#patch-user\n" }

			$mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");			
			$query = new MongoDB\Driver\Query($fullboat);

			$rows = $mng->executeQuery('test.issues', $query);
			if ($_GET['format']=='csv') {
				header('Content-Type: application/csv');
				header('Content-Disposition: attachment; filename=query.csv');
				header('Pragma: no-cache');

				foreach ($rows as $row) {			
				echo '"'.$row->issueId.'",'
					.'"'.$row->state.'",'
					.$row->commentCount.','
					.$row->score.','
					.'"'.substr($row->creationDate,0,10).'",'
					.'"'.$row->title				
					."\"\n";
					}
				}
			else if ($_GET['format']=='json') {
				header('Content-Type: application/json');
				header('Content-Disposition: attachment; filename=query.json');
				header('Pragma: no-cache');

				foreach ($rows as $row) {
					echo (json_encode($row)
					."\n" );
					}
			}
			else {
				echo "Invalid format type specified.";
			}
        }else{
                echo "SESSION format has no value.";
        }
?>