<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Github Miner | Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="./css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="./css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="./css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="./css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    
    
     <?php 
    
    if(isset($_REQUEST['submit']))
    {
    	echo "hello";
    	submit_form();
    }
    
    ?>
    
    
<?php
try {

    $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $query = new MongoDB\Driver\Query([]); 
     
    $rows = $mng->executeQuery("testdb.cars", $query);
    
    foreach ($rows as $row) {
    
        echo "$row->name : $row->price\n";
    }
    
} catch (MongoDB\Driver\Exception\Exception $e) {

    $filename = basename(__FILE__);
    
    echo "The $filename script has experienced an error.\n"; 
    echo "It failed with the following exception:\n";
    
    echo "Exception:", $e->getMessage(), "\n";
    echo "In file:", $e->getFile(), "\n";
    echo "On line:", $e->getLine(), "\n";       
}

?>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="../" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                GitHub Miner
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
<!--                     <div class="user-panel"> -->
<!--                         <div class="pull-left image"> -->
<!--                             <img src="./img/avatar3.png" class="img-circle" alt="User Image" /> -->
<!--                         </div> -->
<!--                         <div class="pull-left info"> -->
<!--                             <p>Hello, Jane</p> -->

<!--                             <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
<!--                         </div> -->
<!--                     </div> -->
                    <!-- search form -->
                    <!-- <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form> -->
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="#">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="./pages/query.php">
                                <i class="fa fa-edit"></i> <span>Make a Query</span> 
                            </a>
                        </li>
                        <li>
                            <a href="./pages/activities.php">
                                <i class="fa fa-fw fa-check-square-o"></i> <span>Activities</span> 
                            </a>
                        </li>
                        <!-- <li class="treeview">
                            <a href="#">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>Activities</span><small class="badge pull-right bg-green">new</small>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="charts/morris.html"><i class="fa fa-angle-double-right"></i> Current Queries</a></li>
                                <li><a href="charts/flot.html"><i class="fa fa-angle-double-right"></i> History</a></li>
                                
                            </ul>
                        </li> -->
                        <!-- <li class="treeview">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>Gathered Data</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="UI/general.html"><i class="fa fa-angle-double-right"></i> General</a></li>
                                <li><a href="UI/icons.html"><i class="fa fa-angle-double-right"></i> Icons</a></li>
                                <li><a href="UI/buttons.html"><i class="fa fa-angle-double-right"></i> Buttons</a></li>
                                <li><a href="UI/sliders.html"><i class="fa fa-angle-double-right"></i> Sliders</a></li>
                                <li><a href="UI/timeline.html"><i class="fa fa-angle-double-right"></i> Timeline</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-edit"></i> <span>Forms</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="forms/general.html"><i class="fa fa-angle-double-right"></i> General Elements</a></li>
                                <li><a href="forms/advanced.html"><i class="fa fa-angle-double-right"></i> Advanced Elements</a></li>
                                <li><a href="forms/editors.html"><i class="fa fa-angle-double-right"></i> Editors</a></li>                                
                            </ul>
                        </li> -->
                        
                                <li>
                            <a href="./pages/simple_data.php">
                                <i class="fa fa-fw fa-bar-chart-o"></i> <span>Collected Data</span> 
                            </a>
                        </li>
                              
                        <!-- <li>
                            <a href="calendar.html">
                                <i class="fa fa-calendar"></i> <span>Calendar</span>
                                <small class="badge pull-right bg-red">3</small>
                            </a>
                        </li>
                        <li>
                            <a href="mailbox.html">
                                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                                <small class="badge pull-right bg-yellow">12</small>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-folder"></i> <span>Examples</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="examples/invoice.html"><i class="fa fa-angle-double-right"></i> Invoice</a></li>
                                <li><a href="examples/login.html"><i class="fa fa-angle-double-right"></i> Login</a></li>
                                <li><a href="examples/register.html"><i class="fa fa-angle-double-right"></i> Register</a></li>
                                <li><a href="examples/lockscreen.html"><i class="fa fa-angle-double-right"></i> Lockscreen</a></li>
                                <li><a href="examples/404.html"><i class="fa fa-angle-double-right"></i> 404 Error</a></li>
                                <li><a href="examples/500.html"><i class="fa fa-angle-double-right"></i> 500 Error</a></li>                                
                                <li><a href="examples/blank.html"><i class="fa fa-angle-double-right"></i> Blank Page</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-folder"></i>  Multilevel Menu
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>                            

                            <ul class="treeview-menu">
                                <li class="treeview">
                                    <a href="#">
                                        First level
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>

                                    <ul class="treeview-menu">
                                        <li class="treeview">
                                            <a href="#">
                                                Second level
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </a>

                                            <ul class="treeview-menu">
                                                <li>
                                                    <a href="#">Third level</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li> -->
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <!-- <small>Control panel</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <!-- <li class="active">Blank page</li> -->
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                
<!--                 <div class="box box-info"> -->
<!--                                 <div class="box-header"> -->
<!--                                     <h3 class="box-title">Charts of Relevant Information</h3> -->
<!--                                 </div> -->
<!--                                 <div class="box-body"> -->
   
<!--                                     <a href="./Query_Language.php"><p> -->
<!--                                     Languages -->
<!--                                     </p></a> -->
<!--                                     <a href="./Query_Size.php"><p> -->
<!--                                     Size -->
<!--                                     </p></a> -->
<!--                                     <a href="./Query_Stars.php"><p> -->
<!--                                     Stars -->
<!--                                     </p></a> -->
<!--                                 </div> -->
<!--                             </div> -->

                    <div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Quick Query</h3>
                                </div>
                                <div class="box-body">
                                <p>
                                This allows you to quickly search projects by keywords. This may take longer to process since there are less filters. If you want more options, visit the "Make a Query" page.
                                </p>
                                <form role="form" method="post" >
                                    <input class="form-control input-lg" name="project" type="text" placeholder="Keywords">
                                    
                                    <br/>
                                    <button type="submit" name="submit" >
<!--                                        <!-- ID="demo" class="btn btn-primary" -->
                                        Submit</button>
                                        </form>
                                    <a href="./pages/query.php"><p>
                                    <br/>
                                    More Search Options
                                    </p></a>
                                </div>
                            </div>


                    
                            
                            <div class="col-md-12">
                            <div class="box">
                                <div class="box-header">
                                    <a href="./pages/activities.html"><h3 class="box-title">Active Queries</h3></a>
                                    
<!--                                     <div class="box-tools"> -->
<!--                                         <ul class="pagination pagination-sm no-margin pull-right"> -->
<!--                                             <li><a href="#">&laquo;</a></li> -->
<!--                                             <li><a href="#">1</a></li> -->
<!--                                             <li><a href="#">2</a></li> -->
<!--                                             <li><a href="#">3</a></li> -->
<!--                                             <li><a href="#">&raquo;</a></li> -->
<!--                                         </ul> -->
<!--                                     </div> -->
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                <p>
                                   &emsp; 	A glimpse into the curently queued queries, waiting to be processed. To view more entries, along with pass queries, visit the "Activities" page.
                                    </p>
                                    <table class="table">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Task</th>
<!--                                             <th>Progress</th> -->
<!--                                              <th style="width: 40px">Label</th>-->
                                        </tr>
                                        <?php
                                        // Connecting, selecting database
// 										$link = mysql_connect('localhost', 'jobuser', 'thissucks')
// 										or die('Could not connect: ' . mysql_error());
// 										echo 'Connected successfully';
// 										mysql_select_db('jobs') or die('Could not select database');
										
// 										// Performing Insertion
// 										$query = "INSERT INTO jobs (query) values ('" . $finalquery . "')";
// 										mysql_query($query) or die('Query failed: ' . mysql_error());
										
										$mysqli = new mysqli("localhost", "jobuser", "thissucks", "jobs");
										if ($mysqli->connect_error) {
											die("Connection failed: " . $conn->connect_error);
										}
											
										$result = $mysqli->query("SELECT query FROM jobs");
											
									
										for($count = 1; $row = $result->fetch_assoc() && $count < 8; $count++) {
											echo "<tr>" . "<td>" . $count ."</td>" . "\t\t<td>" . $row["query"]."</td>\n" . "</tr>";
										}
										
										if($count == 1){
											echo "<tr>" . "<td>*</td>" . "\t\t<td><b>All activities have been processed.</b></td>\n" . "</tr>";
										}
										
										$mysqli->close();

// 										for ($count = 1; $line = mysql_fetch_array($result, MYSQL_ASSOC); $count++) {
// 										echo"<tr>";
// 										echo "<td>" . $count ."</td>";
// 										foreach ($line as $col_value) {
// 											echo "\t\t<td>$col_value</td>\n";
// 										}
// // 										<td>Progress</td>
// // 										<td>Label</td>
// 										echo"</tr>";
// 										}
										
										
// 										// Free resultset
// 										mysql_free_result($result);
										
// 										// Closing connection
// 										mysql_close($link);
										?>
                                        
<!--                                         <tr> -->
<!--                                             <td>1.</td> -->
<!--                                             <td>Massive Debugger Projects</td> -->
<!--                                             <td> -->
<!--                                                 <div class="progress xs"> -->
                                                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
<!--                                                 </div> -->
<!--                                             </td> -->
<!--                                             <td><span class="badge bg-red">55%</span></td> -->
<!--                                         </tr> -->
<!--                                         <tr> -->
<!--                                             <td>2.</td> -->
<!--                                             <td>HTML Parser Projects</td> -->
<!--                                             <td> -->
<!--                                                 <div class="progress xs"> -->
                                                    <div class="progress-bar progress-bar-yellow" style="width: 70%"></div>
<!--                                                 </div> -->
<!--                                             </td> -->
<!--                                             <td><span class="badge bg-yellow">70%</span></td> -->
<!--                                         </tr> -->
<!--                                         <tr> -->
<!--                                             <td>3.</td> -->
<!--                                             <td>Procedural Imperitive Parcel Abstract Classes Run Time Projects</td> -->
<!--                                             <td> -->
<!--                                                 <div class="progress xs progress-striped active"> -->
                                                    <div class="progress-bar progress-bar-primary" style="width: 30%"></div>
<!--                                                 </div> -->
<!--                                             </td> -->
<!--                                             <td><span class="badge bg-light-blue">30%</span></td> -->
<!--                                         </tr> -->
<!--                                         <tr> -->
<!--                                             <td>4.</td> -->
<!--                                             <td>buzzword buzzword buzzword buzzword projects</td> -->
<!--                                             <td> -->
<!--                                                 <div class="progress xs progress-striped active"> -->
                                                    <div class="progress-bar progress-bar-success" style="width: 90%"></div>
<!--                                                 </div> -->
<!--                                             </td> -->
<!--                                             <td><span class="badge bg-green">90%</span></td> -->
<!--                                         </tr> -->
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->



                <!-- Main content -->
<!--                 <section class="content"> -->
                    <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Mined Project Data</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                <p>
                                A glimpse into the first several entries of collected data. To view more, visit the "Collected Data" page.
                                </p>
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Name of Project</th>
                                                <th>Authors</th>
                                                <th>Forks</th>
                                                <th>Stars</th>
                                                <th>Language</th>
                                                <th>Downloads</th>
                                                <th>Other Info</th>
                                            </tr>
                                        </thead>
                                        <tbody>
             
<?php	
	$query = new MongoDB\Driver\Query([]); 
    $rows = $mng->executeQuery("test.repositories", $query);
    $count = 0;
    foreach ($rows as $row) { 
    $count++;
    if($count == 10){break;}
    	
    	?>
    
    
	
				<!--	.append("name",repo.getName())
				//get Owner will return null, so manually parse the owner
				.append("owner", repo.getHtmlUrl().replace("https://github.com/", "")
						.replace("/" + repo.getName(), ""))
			    .append("creation date",repo.getCreatedAt())
			    .append("last update", repo.getUpdatedAt())
			    .append("language",repo.getLanguage())
			    .append("watchers",  repo.getWatchers())
			    .append("forks", repo.getForks())
			    .append("is fork", repo.isFork())
			    .append("has issues", repo.isHasIssues())
			    .append("#of open issues", repo.getOpenIssues())
			    .append("has wiki", repo.isHasWiki())
			    .append("size", repo.getSize() + " kb")
			    .append("url",repo.getHtmlUrl())
				.append("description", repo.getDescription()));
	-->
                                            <tr>
                                                <td><?php echo "$row->name" ?></td>
                                                <td><?php print_r($row->owner) ?></td>
												<!-- substr($row->created_at,0,10) -->
                                                <td><?php echo "$row->creationDate" ?></td>
                                                <td><?php echo "$row->forks" ?></td>
                                                <td><?php echo "$row->language" ?></td>
                                                <td><?php echo "$row->watchers" ?></td>
                                                <td><?php echo "$row->description" ?></td>
                                            </tr>

<?php  } ?>    					                                        
                                        </tbody>									
                                        <tfoot>
                                            <tr>
                                                <th>Name of Project</th>
                                                <th>Authors</th>
                                                <th>Forks</th>
                                                <th>Stars</th>
                                                <th>Language</th>
                                                <th>Downloads</th>
                                                <th>Other Info</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->


                </section><!-- /.content -->


<!--                 </section> -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->









 <?php 
        
        function submit_form()
        {
        	

			// Turns a form/group of forms into a GitHub API query
			// Currently outlines more functionality than is implemented on the
			// front end
			
			$keyword = null;
			
			
			
			
			// handling keyword input
			if (strlen($_POST["project"]) != 0) {
				$keyword = $_POST["project"];
			}
	
			
			$finalquery = '';
			
			if ($keyword != null) {
				$finalquery = $finalquery . $keyword;
			}
			
			
			
			// TODO: start jar script
			
			// for testing


			$mysqli = new mysqli("localhost", "jobuser", "thissucks", "jobs");
			if ($mysqli->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			$mysqli->query("INSERT INTO jobs (query, user) values ('" . $finalquery . "', 'Jane')");
// 			$result = $mysqli->query("SELECT query FROM jobs");
			
// 			if ($result->num_rows > 0) {
// 				// output data of each row
// 				while($row = $result->fetch_assoc()) {
// 					echo  $row["query"]. "<br>";
// 				}
// 			} else {
// 				echo "0 results";
// 			}
			$mysqli->close();
			
			
			header("Location:./pages/activities.php");

        }
        
//         exec("java -jar QueryStarter.jar");
        
        
        
        
        
        
        
        
        
        ?>









        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="./js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="./js/AdminLTE/app.js" type="text/javascript"></script>

    </body>
</html>