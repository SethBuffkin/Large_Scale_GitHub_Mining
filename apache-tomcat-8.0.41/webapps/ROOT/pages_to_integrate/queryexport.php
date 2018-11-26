<?php
		$fullboat=array();
		$commandstring=null;

        if(isset($_GET['format'])){
            #echo $_GET['format'] ."<br />\n";
			#echo json_encode($_GET['command']) ."<br />\n";
			if(!isset($_GET['command'])){
				$commandstring="[]";             # handle empty request by returning all projects
			} else {
				$commandstring=json_encode($_GET['command']);
			}
			$fullboat=json_decode($commandstring,true);  # turn string into an array

			$mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");			
			$query = new MongoDB\Driver\Query($fullboat);

			$rows = $mng->executeQuery('test.repositories', $query);
			if ($_GET['format']=='csv') {
				header('Content-Type: application/csv');
				header('Content-Disposition: attachment; filename=query.csv');
				header('Pragma: no-cache');
				echo '"'."Name of Project".'",'
					.'"'."Owner".'",'
					."Forks".','
					."Languages".','
					.'"'."Watchers".'",'
					.'"'."Date".'",'
					.'"'."Description"				
					."\"\n";
				foreach ($rows as $row) {			
					echo '"'.$row->name.'",'
					.'"'.$row->owner->login.'",'
					.$row->forks.','
					.$row->language.','
					.'"'.$row->watchers.'",'
					.'"'.substr($row->created_at,0,10).'",'
					.'"'.$row->description				
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