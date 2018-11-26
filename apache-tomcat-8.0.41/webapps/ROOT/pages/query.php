<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Advanced Query</title>
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
    	submit_form();
    }
    
    ?>
    
   
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="../index.php" class="logo">
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
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 4 messages</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="../img/avatar3.png" class="img-circle" alt="User Image"/>
                                                </div>
                                                <h4>
                                                    Support Team
                                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li><!-- end message -->
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="../img/avatar2.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    AdminLTE Design Team
                                                    <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="../img/avatar.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Developers
                                                    <small><i class="fa fa-clock-o"></i> Today</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="../img/avatar2.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Sales Department
                                                    <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="../img/avatar.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Reviewers
                                                    <small><i class="fa fa-clock-o"></i> 2 days</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                        </li>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-warning"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-people info"></i> 5 new members joined today
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-warning danger"></i> Very long description here that may not fit into the page and may cause design problems
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users warning"></i> 5 new members joined
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-cart success"></i> 25 sales made
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-person danger"></i> You changed your username
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>
                        <!-- Tasks: style can be found in dropdown.less -->
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-tasks"></i>
                                <span class="label label-danger">9</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 9 tasks</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Design some buttons
                                                    <small class="pull-right">20%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Create a nice theme
                                                    <small class="pull-right">40%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">40% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Some task I need to do
                                                    <small class="pull-right">60%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">60% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Make beautiful transitions
                                                    <small class="pull-right">80%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">80% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all tasks</a>
                                </li>
                            </ul>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Jane Doe <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="../img/avatar3.png" class="img-circle" alt="User Image" />
                                    <p>
                                        Jane Doe - Web Developer
                                        <small>Member since Nov. 2012</small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="#" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="../img/avatar3.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, Jane</p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
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
                            <a href="../index.php">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-edit"></i> <span>Make a Query</span> 
                            </a>
                        </li>
                        <li>
                            <a href="activities.php">
                                <i class="fa fa-edit"></i> <span>Activities</span> <small class="badge pull-right bg-green">new</small>
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
                        Make a Query
                        <!-- <small>Preview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Make a Query</a></li>
                        <!-- <li class="active">Advanced Elements</li> -->
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">

                            
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Advanced Query Search</h3>
                                </div>
                                <form role="form" method="post"  >
                                <!--                                 action="sendRequest.php" -->
                                

                                <div class="box-body">
                                <label>Title of Project:</label>
                                    <input class="form-control input-lg" name="project" type="text" placeholder="Keywords">
                                    
                                    <!-- <div class="form-group">
                                            <label>Minimum Amount of Stars</label>
                                            <input type="text" class="form-control" placeholder="Minimum Amount of Stars"/>
                                        </div> -->
                                        <br>

                                        

<!--                                         <div class="form-group"> -->
<!--                                             <label>Programming Languages: </label> -->
<!--                                             <select multiple class="form-control"> -->
<!--                                                 <option>Java</option> -->
<!--                                                 <option>C/ C++</option> -->
<!--                                                 <option>Python</option> -->
<!--                                                 <option>HTML</option> -->
<!--                                                 <option>CSS</option> -->
<!--                                             </select> -->
<!--                                             <div class="form-group"> -->
<!--                                             <input type="text" name="languages" class="form-control" placeholder="Other Language(s) (Separate with commas and a space)"/> -->
<!--                                         </div> -->
<!--                                         </div> -->
                                        
                                         <!-- checkbox -->
						              <div class="form-group">
						              	<label>Programming Languages: </label>
						                <label>
						                  <input type="checkbox" name="java" >
						                  Java <br>
						                </label>
						                <label>
						                  <input type="checkbox" name="C" >
						                  C/C++ <br>
						                </label>
						                <label>
						                  <input type="checkbox" name="Python" >
						                  Python <br>
						                </label>
						                <label>
						                  <input type="checkbox" name="HTML" >
						                  HTML <br>
						                </label>
						                <label>
						                  <input type="checkbox" name="CSS" >
						                  CSS <br>
						                </label>
						                <label>
						                   <input size="40" name="other" type="text" placeholder="Other Language(s) (Separate with commas and a space)">
						                </label>
						              </div>
						              
						              <div class="form-group">
						              <label>List of Unwanted Languages (Separate with commas and a space)</label>
                                            <input size="45" type="text" name="neglanguages" class="form-control" placeholder="Tags"/>
                                            </div>

                                    <label>Minimum Amount of Stars:</label>
                                    <div class="form-group">
                                    <!-- <label>Minimum Amount of Stars</label> -->
                                                
                                                 <input size="65" type="text" name="stars" class="form-control" placeholder="Stars"/>
                                                
                                            </div><!-- /input-group -->
                                            <br>

                                    <label>Minimum Amount of Forks:</label>
                                    <div class="form-group">
                                    <!-- <label>Minimum Amount of Stars</label> -->
                                                
                                                 <input type="text" name="forks" class="form-control" placeholder="Forks"/>
                                                 </div>
                                            <!-- /input-group -->
                                            <br>

                                    <div class="form-group">
						                <label>Date range:</label>
						
						                <div class="input-group">
						                  <div class="input-group-addon">
						                    <i class="fa fa-calendar"></i>
						                  </div>
						                  <input  size="45" type="text" name="date" class="form-control pull-right" id="reservation">
						                </div>
						                <!-- /.input group -->
						              </div>
						              <!-- /.form group -->
<!--                                     <div class="form-group"> -->
                                            
<!--                                         </div> -->
                                    <div class="box-footer">
                                        <button type="submit" name="submit" >
<!--                                        <!-- ID="demo" class="btn btn-primary" -->
                                        Submit</button>
                                    </div>
                                    </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                            
                        </div><!-- /.col (right) -->
                    </div><!-- /.row -->                    

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
        <?php 
        
        function submit_form()
        {
        	

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
			
			
			if(isset($_POST['date'])){
				$tmp = $_POST["date"];
				$tmparray = explode(' - ', $tmp);
				$createstart = $tmparray[0];
				$createend = $tmparray[1];
				
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
// 			if ($createstart != null) {		// currently unimplemented
// 				$finalquery = $finalquery . $createstart;
// 			}
			
// 			if ($createend != null) {		// currently unimplemented
// 				$finalquery = $finalquery . $createend;
// 			}
			
			$daterange = ' created:';
			if ($createstart != null) {
				$daterange = $daterange . $createstart;
			}
			else {
				$daterange = $daterange . '*';
			}
				
			$daterange = $daterange . '..';
				
			if ($createend != null) {		// currently unimplemented on front end
				$daterange = $daterange . $createend;
			}
			else {
				$daterange = $daterange . '*';
			}
				
			$finalquery = $finalquery . $daterange;
				
			unset($daterange);
			
			// add most recent push date information to the query
			if ($pushedstart != null) {		// currently unimplemented on front end
				
			}
			
			if ($pushedend != null) {		// currently unimplemented on front end
				
			}
			
			// TODO: start jar script
			
			// for testing
			echo $finalquery;
			
			$message = "Query Sent";
			echo "<script type='text/javascript'>alert('$finalquery');</script>";

			// Connecting, selecting database
			$link = mysql_connect('localhost', 'jobuser', 'thissucks')
			or die('Could not connect: ' . mysql_error());
			echo 'Connected successfully';
			mysql_select_db('jobs') or die('Could not select database');
			
			// Performing Insertion
			$query = "INSERT INTO jobs (query) values ('" . $finalquery . "')";
			mysql_query($query) or die('Query failed: ' . mysql_error());
			
			// Performing SQL query
			$query = 'SELECT * FROM jobs';
			$result = mysql_query($query) or die('Query failed: ' . mysql_error());
			
			// Printing results in HTML
			echo "<table>\n";
			while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
				echo "\t<tr>\n";
				foreach ($line as $col_value) {
					echo "\t\t<td>$col_value</td>\n";
				}
				echo "\t</tr>\n";
			}
			echo "</table>\n";
			
			// Free resultset
			mysql_free_result($result);
			
			// Closing connection
			mysql_close($link);


        }
        
//         exec("java -jar QueryStarter.jar");
        
        
        
        
        
        
        
        
        
        ?>

<!-- <form action="sendRequest.php" method="post"> -->
<!-- Name: <input type="text" name="name"><br> -->
<!-- E-mail: <input type="text" name="email"><br> -->
<!-- <input type="submit"> -->
<!-- </form> -->

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

        <!-- The file that sends the query to processes -->
        <script src="../js/AdminLTE/sendRequest.js" type="text/javascript"></script>

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
                $('#reservation').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'YYYY-MM-DD'});
                //Date range picker with time picker
                $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'YYYY-MM-DDThh:mm:ssTZD'});
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

    </body>
</html>