<?php
// querybuilder.php
// Turns a form/group of forms into a GitHub API query
// Currently outlines more functionality than is implemented on the
// front end

$keyword = null;
$keywordlower=null;
$inchoice = null;
$sizemin = null;
$sizemax = null;
$forksmin = null;
$forksmax = null;
$forkminer=0;						// Minimum number of forks, as an integer`
$isfork = null;
$createstart = null;
$createend = null;
$pushedstart = null;
$pushedend = null;
$languages = array();
$lang=array();                    // Language list in array format for MongoDB query
$nolang=array();					// Negative language list in array format`
$notlanguages = array();
$starsmin = null;
$starsminer=0;                    // Minimum number of stars, as an integer  
$starsmax = null;
$formatedDate=null;
$fullboat=array();                // query being built to pass to MongoDB

// handling language input
if(isset($_POST['java'])){
	array_push($languages, 'java');
	array_push($lang, 'Java');
}

if(isset($_POST['C'])){
	array_push($languages, 'c');
	array_push($lang, 'c');
}
if(isset($_POST['Python'])){
	array_push($languages, 'python');
	array_push($lang, 'Python');
}
if(isset($_POST['HTML'])){
	array_push($languages, 'html');
	array_push($lang, 'html');
}
if(isset($_POST['CSS'])){
	array_push($languages, 'css');
	array_push($lang, 'css');
}

if(isset($_POST['other'])){
	$tmp = $_POST["other"];
	$tmp = trim($tmp, " /");
	$tmparray = explode(', ', $tmp);
	if (strlen($tmp)>0) {
		$lang=array_merge($lang, $tmparray);
	}
	$languages = array_merge($languages, $tmparray);
}

if (!empty($lang))  {
	$fullboat['language'] = array('$in' => $lang);
}

// handling minimum star input
if (strlen($_POST["stars"]) != 0) {
	$starsmin = $_POST["stars"];
	$starsminer=intval($starsmin);
}

// handling minimum fork input
if (strlen($_POST["forks"]) != 0) {
	$forksmin = $_POST["forks"];
}

 
// handling creation date information
if (strlen($_POST["date"]) != 0) {
	$tmp = $_POST["date"];
	$date = explode(" - ", $tmp);
	date_default_timezone_set('America/New_York');
	$formatedDate= substr($date[0], 6, 4) . '-'. substr($date[0],0,2) . '-'.  substr($date[0],3,2);
	$$now = new DateTime($formatedDate);
	#$orig_date = new DateTime($date[0]);
	#{$gte=> "2017-03-01"}} )
	$startdate = new MongoDB\BSON\UTCDateTime(strtotime($formatedDate)*1000);
	#####$fullboat['pushed_at'] = array('$gte' => $orig_date);
	$fullboat['creationDate'] = array('$gte' => $startdate);
	}


// handling unwanted language input
if (strlen($_POST["neglanguages"]) != 0) {
	$tmp = $_POST["neglanguages"];
	$tmp = trim($tmp, " /");
	$tmparray = explode(', ', $tmp);
	$notlanguages = array_merge($notlanguages, $tmparray);

	$nolang=explode(' ',$tmp);
}

if (!empty($nolang))  {
	$fullboat['language'] = array('$nin' => $nolang);
}

// handling keyword input
if (strlen($_POST["project"]) != 0) {
	$keyword = $_POST["project"];
	$keywordlower=strtolower($keyword);
}

$finalquery = '';

if ($keyword != null) {
	#$regexp= new MongoDB\BSON\Regex($keyword,$options: 'i');

    #$fullboat['description'] = array('$regex' => $regexp);
	$fullboat['name']= array('$regex' => $keywordlower, '$options' => 'i');
	#$fullboat['name']= array($regexp);
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

if ($starsminer> 0) { 
$fullboat['watchers'] = array('$gte' => $starsminer);
}

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
$forkminer=intval($forksmin);
if ($forkminer> 0) { 
$fullboat['forks'] = array('$gte' => $forkminer);
}

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
#echo $finalquery;


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Github Miner | Collected Data</title>
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
                        <li>
                            <a href="../index.php">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="query.php">
                                <i class="fa fa-edit"></i> <span>Make a Query</span> 
                            </a>
                        </li>
                        <li >
                            <a href="./activities.php">
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
                        
                                <li class="active">
                            <a href="./simple_data.php">
                                <i class="fa fa-fw fa-bar-chart-o"></i> <span>Collected Data</span> 
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>Export Results</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
<?php
$csvdata = array('format' => 'csv','command' => $fullboat);
$jsondata = array('format' => 'json','command' => $fullboat);
?>
                                <li><a href="queryexport.php?<?php echo http_build_query($csvdata) ?>" ><i class="fa fa-angle-double-right"></i> CSV</a></li>								
                                <li><a href="queryexport.php?<?php echo http_build_query($jsondata) ?>" ><i class="fa fa-angle-double-right"></i> JSON</a></li>
                            </ul>
                        </li>
						 <li class="treeview">
<!--                             <a href="#"> -->
<!--                                 <i class="fa fa-table"></i> <span>Query History</span> -->
<!--                                 <i class="fa fa-angle-left pull-right"></i> -->
<!--                             </a> -->
<!--                             <ul class="treeview-menu"> -->
 <?php
// $historydata = array('user' => 'Jane Doe');
 ?>
 <!--                                 <li><a href="history_list.php?<?php echo http_build_query($historydata) ?>" ><i class="fa fa-angle-double-right"></i> Jane Doe</a></li>	-->							
<!--                             </ul> -->
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
                        Gathered Data
                        <small><?php echo json_encode($fullboat); ?></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li>Gathered Data</li>
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
                                                <th>Name of Project</th>
                                                <th>Authors</th>
                                                <th>Creation Date</th>
												<th>Detail</th>
                                                <th>Forks</th>
												<th>Languages</th>
                                                <th>Watchers</th>
                                                <th>Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>

<?php	

 $langSetting=array('Java');
 $noLangSetting=array('Java');
 $query = new MongoDB\Driver\Query($fullboat);
 $rows = $mng->executeQuery('test.repositories', $query);
	
	
    foreach ($rows as $row) { ?>
                                            <tr>
 
                                                <td><?php echo "$row->name" ?></td>
                                                <td><?php print_r($row->owner) ?></td>
												<!-- substr($row->created_at,0,10) -->

<?php $datenum = substr($row->creationDate,0,10 );
$phpDate = date('Y-M-d', $datenum);  ?>
                                                <td><?php echo $phpDate ?></td>
<?php
$commitsdata = array('repository' => $row->repoID);
$issuesdata = array('repository' => $row->repoID);
?>
                                                <td><a href="commits_list.php?<?php echo http_build_query($commitsdata) ?>" >commits</a>/<a href="issues_list.php?<?php echo http_build_query($issuesdata) ?>" >issues</a></td>
                                                <td><?php echo "$row->forks" ?></td>
												<td><?php echo "$row->language" ?></td>
                                                <td><?php echo "$row->watchers" ?></td>
                                                <td><?php echo "$row->description" ?></td>
                                            </tr>

												
                                            </tr>

<?php  } ?>    					
                      
                                        </tbody>									
                                        <tfoot>
                                            <tr>
                                                <th>Name of Project</th>
                                                <th>Authors</th>
                                                <th>Creation Date</th>
												<th>Detail</th>
                                                <th>Forks</th>
												<th>Languages</th>
                                                <th>Watchers</th>
                                                <th>Description</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->


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
