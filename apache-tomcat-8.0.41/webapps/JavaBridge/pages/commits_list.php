<?php
		$fullboat=array();
		$commandstring=null;

        if(isset($_GET['repository'])){
            #echo $_GET['format'] ."<br />\n";
			#echo json_encode($_GET['command']) ."<br />\n";
			
#			$fullboat['repoId'] = array('$eq' => intval($_GET['repository']));
#			echo json_encode($fullboat);
			
#			$mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");			
#			$query = new MongoDB\Driver\Query($fullboat);

#			$rows = $mng->executeQuery('test.issues', $query);
#{ "_id" : ObjectId("58f4185e488be81bd0740ec9"), "repoId" : NumberLong(7009146), "issueId" : NumberLong(42755186), "creationDate" : ISODate("2014-09-15T09:36:42Z"), "state" : "open", "closeDate" : null, "lastUpdate" : ISODate("2014-09-15T09:36:42Z"), "commentCount" : 0, "labels" : "[]", "title" : "add a form for crawl an user or an organization", "body" : "Will allow update components without using crawler website or component(1) command\n\nhttps://github.com/componentjs/crawler.js#patch-user\n" }


#				foreach ($rows as $row) {			
#					echo '"'.$row->issueId.'",'
#					.'"'.$row->state.'",'
#					.$row->commentCount.','
#					.$row->score.','
#					.'"'.substr($row->creationDate,0,10).'",'
#					.'"'.$row->title				
#					."\"\n";
#					}

        }else{
                echo "SESSION format has no value.";
        }
?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Github Miner | Commits</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- daterange picker -->
        <link href="../css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="../css/iCheck/all.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Color Picker -->
        <link href="../css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
        <!-- Bootstrap time Picker -->
        <link href="../css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
        <!-- Theme style -->
        <link href="../css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- DATA TABLES -->
        <link href="../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
	
	<?php

try {

    $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $query = new MongoDB\Driver\Query([]); 
     
    #$rows = $mng->executeQuery("testdb.cars", $query);
    #
    #foreach ($rows as $row) {
    #
    #    echo "$row->name : $row->price\n";
    #}
    
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
<!--                             <img src="../img/avatar3.png" class="img-circle" alt="User Image" /> -->
<!--                         </div> -->
<!--                         <div class="pull-left info"> -->
<!--                             <p>Hello, Jane</p> -->

<!--                             <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
<!--                         </div> -->
<!--                     </div> -->

                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="../">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="query.php">
                                <i class="fa fa-edit"></i> <span>Make a Query</span> 
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-edit"></i> <span>Activities</span> 
                            </a>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>Gathered Data</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="simple_data.php"><i class="fa fa-angle-double-right"></i> Simple</a></li>
                                <li><a href="verbose_data.php"><i class="fa fa-angle-double-right"></i> Verbose</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>Export Results</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
<?php
$fullboat['repoID'] = array('$eq' => intval($_GET['repository']));
$committed = NULL;
 if(isset($_GET['commitMessage'])){
	 $committed=$_GET['commitMessage'];
	 $committed= str_replace(" ",".*",$committed);
	 if (strlen($committed)>0) {
		$fullboat['commitMessage']= array('$regex' => $committed, '$options' => 'i');
	 }
 }
 $author = NULL;
  if(isset($_GET['commitAuthor'])){
	  $author=$_GET['commitAuthor'];
	  if (strlen($author) >0 ) {
		$fullboat['commitAuthor']= array('$regex' => $author, '$options' => 'i');
	  }
 }

#$csvdata = array('format' => 'csv','repository' =>intval($_GET['repository']),'command' => $fullboat);
$csvdata = array('format' => 'csv','repository' =>intval($_GET['repository']));
if ($committed){$csvdata['commitMessage']= $committed;}
if ($author){$csvdata['commitAuthor']= $author;}
#$jsondata = array('format' => 'json','repository' => intval($_GET['repository']),'command' => $fullboat);
$jsondata = array('format' => 'json','repository' => intval($_GET['repository']));
if ($committed){$jsondata['commitMessage']= $committed;}
if ($author){$jsondata['commitAuthor']= $author;}
?>
                                <li><a href="commits_export.php?<?php echo http_build_query($csvdata) ?>" ><i class="fa fa-angle-double-right"></i> CSV</a></li>								
                                <li><a href="commits_export.php?<?php echo http_build_query($jsondata) ?>" ><i class="fa fa-angle-double-right"></i> JSON</a></li>
                            </ul>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Commits Listing
                        <small><?php echo json_encode($fullboat); ?></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="../"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Gathered Data</a></li>
                        <li><a href="#">Simple</a></li>
                        <!-- <li class="active">Advanced Elements</li> -->
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Results:</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Commit Message</th>
                                                <th>Comment Count</th>
                                                <th>Author</th>
                                            </tr>
                                        </thead>
                                        <tbody>

<?php			
			$mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");			
			$query = new MongoDB\Driver\Query($fullboat);

			$rows = $mng->executeQuery('test.commits', $query);
#{ "_id" : ObjectId("58f4185e488be81bd0740ec9"), "repoId" : NumberLong(7009146), "issueId" : NumberLong(42755186), "creationDate" : ISODate("2014-09-15T09:36:42Z"), "state" : "open", "closeDate" : null, "lastUpdate" : ISODate("2014-09-15T09:36:42Z"), "commentCount" : 0, "labels" : "[]", "title" : "add a form for crawl an user or an organization", "body" : "Will allow update components without using crawler website or component(1) command\n\nhttps://github.com/componentjs/crawler.js#patch-user\n" }



	
    foreach ($rows as $row) { ?>
                                            <tr>

                                                <td><?php echo "$row->commitMessage" ?></td>
												<td><?php echo "$row->commentCount" ?></td>
												<td><?php echo "$row->commitAuthor" ?></td>

                                            </tr>

												
                                            </tr>

<?php  } ?>    					
                      
                                        </tbody>									
                                        <tfoot>
                                            <tr>
												<th>Commit Message</th>
                                                <th>Comment Count</th>
                                                <th>Author</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->


      <!--          </section><!-- /.content -->
				<form role="form" method="get" action="commits_list.php" >
				<div class="box-body">
                                <label>Filter commits:</label>
				<input class="form-control input-lg" name="commitMessage" type="text" placeholder="Word or phrase in commit message">
				</div>
				 <div class="box-footer">
				 
				<input class="form-control input-lg" name="commitAuthor" type="text" placeholder="Author">
				</div>
				 <div class="box-footer">
 
                                        <button type="submit" name="repository" value="<?php echo $_GET['repository'] ?>" >
<!--                                        <!-- ID="demo" class="btn btn-primary" -->
                                        Submit</button>
                                    </div>
									</form>
									                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- InputMask -->
        <script src="../js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="../js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="../js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <!-- date-range-picker -->
        <script src="../js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- bootstrap color picker -->
        <script src="../js/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
        <!-- bootstrap time picker -->
        <script src="../js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../js/AdminLTE/app.js" type="text/javascript"></script>

        <!-- DATA TABES SCRIPT -->
        <script src="../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

        <!-- Page script -->
        <script type="text/javascript">
            $(function() {
                //Datemask dd/mm/yyyy
                $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
                //Datemask2 mm/dd/yyyy
                $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Money Euro
                $("[data-mask]").inputmask();

                //Date range picker
                $('#reservation').daterangepicker();
                //Date range picker with time picker
                $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
                //Date range as a button
                $('#daterange-btn').daterangepicker(
                        {
                            ranges: {
                                'Today': [moment(), moment()],
                                'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                                'Last 7 Days': [moment().subtract('days', 6), moment()],
                                'Last 30 Days': [moment().subtract('days', 29), moment()],
                                'This Month': [moment().startOf('month'), moment().endOf('month')],
                                'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                            },
                            startDate: moment().subtract('days', 29),
                            endDate: moment()
                        },
                function(start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }
                );

                //iCheck for checkbox and radio inputs
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal',
                    radioClass: 'iradio_minimal'
                });
                //Red color scheme for iCheck
                $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                    checkboxClass: 'icheckbox_minimal-red',
                    radioClass: 'iradio_minimal-red'
                });
                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_flat-red',
                    radioClass: 'iradio_flat-red'
                });

                //Colorpicker
                $(".my-colorpicker1").colorpicker();
                //color picker with addon
                $(".my-colorpicker2").colorpicker();

                //Timepicker
                $(".timepicker").timepicker({
                    showInputs: false
                });
            });
        </script>

        <!-- page script -->
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>

    </body>
</html>

