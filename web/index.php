<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include "config.php";

$req_uri = $_SERVER['REQUEST_URI'];
$my_uri = explode('/',$req_uri);
$page = $my_uri[2];
// var_dump(parse_url($req_uri, PHP_URL_QUERY));
// echo $_GET['filename'];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Material Admin - Form layouts</title>

		<!-- BEGIN META -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="your,keywords">
		<meta name="description" content="Short explanation about this website">
		<!-- END META -->

		<!-- BEGIN STYLESHEETS -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
		<link type="text/css" rel="stylesheet" href="assets/css/theme-default/bootstrap.css?1422792965" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-default/materialadmin.css?1425466319" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-default/font-awesome.min.css?1422529194" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-default/material-design-iconic-font.min.css?1421434286" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-default/libs/DataTables/jquery.dataTables.css?1423553989" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-default/libs/DataTables/extensions/dataTables.colVis.css?1423553990" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-default/libs/DataTables/extensions/dataTables.tableTools.css?1423553990" />
		<!-- END STYLESHEETS -->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script type="text/javascript" src="assets/js/libs/utils/html5shiv.js?1403934957"></script>
		<script type="text/javascript" src="assets/js/libs/utils/respond.min.js?1403934956"></script>
		<![endif]-->
	</head>
	<body class="menubar-hoverable header-fixed ">

		<!-- BEGIN HEADER-->
		<header id="header" >
			<div class="headerbar">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="headerbar-left">
					<ul class="header-nav header-nav-options">
						<li class="header-nav-brand" >
							<div class="brand-holder">
								<a href="../../html/dashboards/dashboard.html">
									<span class="text-lg text-bold text-primary">MATERIAL ADMIN</span>
								</a>
							</div>
						</li>
						<li>
							<a class="btn btn-icon-toggle menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
								<i class="fa fa-bars"></i>
							</a>
						</li>
					</ul>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="headerbar-right">
					<ul class="header-nav header-nav-options">
						<li>
							<!-- Search form -->
							<form class="navbar-search" role="search">
								<div class="form-group">
									<input type="text" class="form-control" name="headerSearch" placeholder="Enter your keyword">
								</div>
								<button type="submit" class="btn btn-icon-toggle ink-reaction"><i class="fa fa-search"></i></button>
							</form>
						</li>
						<li class="dropdown hidden-xs">
							<a href="javascript:void(0);" class="btn btn-icon-toggle btn-default" data-toggle="dropdown">
								<i class="fa fa-bell"></i><sup class="badge style-danger">4</sup>
							</a>
							<ul class="dropdown-menu animation-expand">
								<li class="dropdown-header">Today's messages</li>
								<li>
									<a class="alert alert-callout alert-warning" href="javascript:void(0);">
										<img class="pull-right img-circle dropdown-avatar" src="assets/img/avatar2.jpg?1404026449" alt="" />
										<strong>Alex Anistor</strong><br/>
										<small>Testing functionality...</small>
									</a>
								</li>
								<li>
									<a class="alert alert-callout alert-info" href="javascript:void(0);">
										<img class="pull-right img-circle dropdown-avatar" src="assets/img/avatar3.jpg?1404026799" alt="" />
										<strong>Alicia Adell</strong><br/>
										<small>Reviewing last changes...</small>
									</a>
								</li>
								<li class="dropdown-header">Options</li>
								<li><a href="../../html/pages/login.html">View all messages <span class="pull-right"><i class="fa fa-arrow-right"></i></span></a></li>
								<li><a href="../../html/pages/login.html">Mark as read <span class="pull-right"><i class="fa fa-arrow-right"></i></span></a></li>
							</ul><!--end .dropdown-menu -->
						</li><!--end .dropdown -->
						<li class="dropdown hidden-xs">
							<a href="javascript:void(0);" class="btn btn-icon-toggle btn-default" data-toggle="dropdown">
								<i class="fa fa-area-chart"></i>
							</a>
							<ul class="dropdown-menu animation-expand">
								<li class="dropdown-header">Server load</li>
								<li class="dropdown-progress">
									<a href="javascript:void(0);">
										<div class="dropdown-label">
											<span class="text-light">Server load <strong>Today</strong></span>
											<strong class="pull-right">93%</strong>
										</div>
										<div class="progress"><div class="progress-bar progress-bar-danger" style="width: 93%"></div></div>
									</a>
								</li><!--end .dropdown-progress -->
								<li class="dropdown-progress">
									<a href="javascript:void(0);">
										<div class="dropdown-label">
											<span class="text-light">Server load <strong>Yesterday</strong></span>
											<strong class="pull-right">30%</strong>
										</div>
										<div class="progress"><div class="progress-bar progress-bar-success" style="width: 30%"></div></div>
									</a>
								</li><!--end .dropdown-progress -->
								<li class="dropdown-progress">
									<a href="javascript:void(0);">
										<div class="dropdown-label">
											<span class="text-light">Server load <strong>Lastweek</strong></span>
											<strong class="pull-right">74%</strong>
										</div>
										<div class="progress"><div class="progress-bar progress-bar-warning" style="width: 74%"></div></div>
									</a>
								</li><!--end .dropdown-progress -->
							</ul><!--end .dropdown-menu -->
						</li><!--end .dropdown -->
					</ul><!--end .header-nav-options -->
					<ul class="header-nav header-nav-profile">
						<li class="dropdown">
							<a href="javascript:void(0);" class="dropdown-toggle ink-reaction" data-toggle="dropdown">
								<img src="assets/img/avatar1.jpg?1403934956" alt="" />
								<span class="profile-info">
									Daniel Johnson
									<small>Administrator</small>
								</span>
							</a>
							<ul class="dropdown-menu animation-dock">
								<li class="dropdown-header">Config</li>
								<li><a href="../../html/pages/profile.html">My profile</a></li>
								<li><a href="../../html/pages/blog/post.html">My blog <span class="badge style-danger pull-right">16</span></a></li>
								<li><a href="../../html/pages/calendar.html">My appointments</a></li>
								<li class="divider"></li>
								<li><a href="../../html/pages/locked.html"><i class="fa fa-fw fa-lock"></i> Lock</a></li>
								<li><a href="../../html/pages/login.html"><i class="fa fa-fw fa-power-off text-danger"></i> Logout</a></li>
							</ul><!--end .dropdown-menu -->
						</li><!--end .dropdown -->
					</ul><!--end .header-nav-profile -->
					<ul class="header-nav header-nav-toggle">
						<li>
							<a class="btn btn-icon-toggle btn-default" href="#offcanvas-search" data-toggle="offcanvas" data-backdrop="false">
								<i class="fa fa-ellipsis-v"></i>
							</a>
						</li>
					</ul><!--end .header-nav-toggle -->
				</div><!--end #header-navbar-collapse -->
			</div>
		</header>
		<!-- END HEADER-->

		<!-- BEGIN BASE-->
		<div id="base">

			<?php
			$qs = parse_url($req_uri, PHP_URL_QUERY);
			if(($page == 'form') || isset($_GET['num_bank_accounts'])) {
				include "form.php";
			} elseif (($page == 'upload') || isset($_GET['filename'])) {
				include "upload.php";
			} else {
				echo "Page Not Found";
			}
			?>

			<!-- BEGIN MENUBAR-->
			<div id="menubar" class="menubar-inverse ">
				<div class="menubar-fixed-panel">
					<div>
						<a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
							<i class="fa fa-bars"></i>
						</a>
					</div>
					<div class="expanded">
						<a href="../../html/dashboards/dashboard.html">
							<span class="text-lg text-bold text-primary ">MATERIAL&nbsp;ADMIN</span>
						</a>
					</div>
				</div>
				<div class="menubar-scroll-panel">

					<!-- BEGIN MAIN MENU -->
					<ul id="main-menu" class="gui-controls">

						<!-- BEGIN TABLES -->
						<li class="gui-folder">
							<a>
								<div class="gui-icon"><i class="fa fa-table"></i></div>
								<span class="title">Tables</span>
							</a>
							<!--start submenu -->
							<ul>
								<li><a href="<?= $base_url; ?>credit-score/upload" ><span class="title">Upload File</span></a></li>
							</ul><!--end /submenu -->
						</li><!--end /menu-li -->
						<!-- END TABLES -->

						<!-- BEGIN FORMS -->
						<li class="gui-folder">
							<a>
								<div class="gui-icon"><span class="glyphicon glyphicon-list-alt"></span></div>
								<span class="title">Forms</span>
							</a>
							<!--start submenu -->
							<ul>
								<li><a href="<?= $base_url; ?>credit-score/form" ><span class="title">Input Data</span></a></li>
							</ul><!--end /submenu -->
						</li><!--end /menu-li -->
						<!-- END FORMS -->

					</ul><!--end .main-menu -->
					<!-- END MAIN MENU -->

					<div class="menubar-foot-panel">
						<small class="no-linebreak hidden-folded">
							<span class="opacity-75">Copyright &copy; 2014</span> <strong>CodeCovers</strong>
						</small>
					</div>
				</div><!--end .menubar-scroll-panel-->
			</div><!--end #menubar-->
			<!-- END MENUBAR -->

			<!-- BEGIN OFFCANVAS RIGHT -->
			<div class="offcanvas">

				<!-- BEGIN OFFCANVAS SEARCH -->
				<div id="offcanvas-search" class="offcanvas-pane width-8">
					<div class="offcanvas-head">
						<header class="text-primary">Search</header>
						<div class="offcanvas-tools">
							<a class="btn btn-icon-toggle btn-default-light pull-right" data-dismiss="offcanvas">
								<i class="md md-close"></i>
							</a>
						</div>
					</div>
					<div class="offcanvas-body no-padding">
						<ul class="list ">
							<li class="tile divider-full-bleed">
								<div class="tile-content">
									<div class="tile-text"><strong>A</strong></div>
								</div>
							</li>
							<li class="tile">
								<a class="tile-content ink-reaction" href="#offcanvas-chat" data-toggle="offcanvas" data-backdrop="false">
									<div class="tile-icon">
										<img src="assets/img/avatar4.jpg?1404026791" alt="" />
									</div>
									<div class="tile-text">
										Alex Nelson
										<small>123-123-3210</small>
									</div>
								</a>
							</li>
							<li class="tile">
								<a class="tile-content ink-reaction" href="#offcanvas-chat" data-toggle="offcanvas" data-backdrop="false">
									<div class="tile-icon">
										<img src="assets/img/avatar9.jpg?1404026744" alt="" />
									</div>
									<div class="tile-text">
										Ann Laurens
										<small>123-123-3210</small>
									</div>
								</a>
							</li>
							<li class="tile divider-full-bleed">
								<div class="tile-content">
									<div class="tile-text"><strong>J</strong></div>
								</div>
							</li>
							<li class="tile">
								<a class="tile-content ink-reaction" href="#offcanvas-chat" data-toggle="offcanvas" data-backdrop="false">
									<div class="tile-icon">
										<img src="assets/img/avatar2.jpg?1404026449" alt="" />
									</div>
									<div class="tile-text">
										Jessica Cruise
										<small>123-123-3210</small>
									</div>
								</a>
							</li>
							<li class="tile">
								<a class="tile-content ink-reaction" href="#offcanvas-chat" data-toggle="offcanvas" data-backdrop="false">
									<div class="tile-icon">
										<img src="assets/img/avatar8.jpg?1404026729" alt="" />
									</div>
									<div class="tile-text">
										Jim Peters
										<small>123-123-3210</small>
									</div>
								</a>
							</li>
							<li class="tile divider-full-bleed">
								<div class="tile-content">
									<div class="tile-text"><strong>M</strong></div>
								</div>
							</li>
							<li class="tile">
								<a class="tile-content ink-reaction" href="#offcanvas-chat" data-toggle="offcanvas" data-backdrop="false">
									<div class="tile-icon">
										<img src="assets/img/avatar5.jpg?1404026513" alt="" />
									</div>
									<div class="tile-text">
										Mabel Logan
										<small>123-123-3210</small>
									</div>
								</a>
							</li>
							<li class="tile">
								<a class="tile-content ink-reaction" href="#offcanvas-chat" data-toggle="offcanvas" data-backdrop="false">
									<div class="tile-icon">
										<img src="assets/img/avatar11.jpg?1404026774" alt="" />
									</div>
									<div class="tile-text">
										Mary Peterson
										<small>123-123-3210</small>
									</div>
								</a>
							</li>
							<li class="tile">
								<a class="tile-content ink-reaction" href="#offcanvas-chat" data-toggle="offcanvas" data-backdrop="false">
									<div class="tile-icon">
										<img src="assets/img/avatar3.jpg?1404026799" alt="" />
									</div>
									<div class="tile-text">
										Mike Alba
										<small>123-123-3210</small>
									</div>
								</a>
							</li>
							<li class="tile divider-full-bleed">
								<div class="tile-content">
									<div class="tile-text"><strong>N</strong></div>
								</div>
							</li>
							<li class="tile">
								<a class="tile-content ink-reaction" href="#offcanvas-chat" data-toggle="offcanvas" data-backdrop="false">
									<div class="tile-icon">
										<img src="assets/img/avatar6.jpg?1404026572" alt="" />
									</div>
									<div class="tile-text">
										Nathan Peterson
										<small>123-123-3210</small>
									</div>
								</a>
							</li>
							<li class="tile divider-full-bleed">
								<div class="tile-content">
									<div class="tile-text"><strong>P</strong></div>
								</div>
							</li>
							<li class="tile">
								<a class="tile-content ink-reaction" href="#offcanvas-chat" data-toggle="offcanvas" data-backdrop="false">
									<div class="tile-icon">
										<img src="assets/img/avatar7.jpg?1404026721" alt="" />
									</div>
									<div class="tile-text">
										Philip Ericsson
										<small>123-123-3210</small>
									</div>
								</a>
							</li>
							<li class="tile divider-full-bleed">
								<div class="tile-content">
									<div class="tile-text"><strong>S</strong></div>
								</div>
							</li>
							<li class="tile">
								<a class="tile-content ink-reaction" href="#offcanvas-chat" data-toggle="offcanvas" data-backdrop="false">
									<div class="tile-icon">
										<img src="assets/img/avatar10.jpg?1404026762" alt="" />
									</div>
									<div class="tile-text">
										Samuel Parsons
										<small>123-123-3210</small>
									</div>
								</a>
							</li>
						</ul>
					</div><!--end .offcanvas-body -->
				</div><!--end .offcanvas-pane -->
				<!-- END OFFCANVAS SEARCH -->

				<!-- BEGIN OFFCANVAS CHAT -->
				<div id="offcanvas-chat" class="offcanvas-pane style-default-light width-12">
					<div class="offcanvas-head style-default-bright">
						<header class="text-primary">Chat with Ann Laurens</header>
						<div class="offcanvas-tools">
							<a class="btn btn-icon-toggle btn-default-light pull-right" data-dismiss="offcanvas">
								<i class="md md-close"></i>
							</a>
							<a class="btn btn-icon-toggle btn-default-light pull-right" href="#offcanvas-search" data-toggle="offcanvas" data-backdrop="false">
								<i class="md md-arrow-back"></i>
							</a>
						</div>
						<form class="form">
							<div class="form-group floating-label">
								<textarea name="sidebarChatMessage" id="sidebarChatMessage" class="form-control autosize" rows="1"></textarea>
								<label for="sidebarChatMessage">Leave a message</label>
							</div>
						</form>
					</div>
					<div class="offcanvas-body">
						<ul class="list-chats">
							<li>
								<div class="chat">
									<div class="chat-avatar"><img class="img-circle" src="assets/img/avatar1.jpg?1403934956" alt="" /></div>
									<div class="chat-body">
										Yes, it is indeed very beautiful.
										<small>10:03 pm</small>
									</div>
								</div><!--end .chat -->
							</li>
							<li class="chat-left">
								<div class="chat">
									<div class="chat-avatar"><img class="img-circle" src="assets/img/avatar9.jpg?1404026744" alt="" /></div>
									<div class="chat-body">
										Did you see the changes?
										<small>10:02 pm</small>
									</div>
								</div><!--end .chat -->
							</li>
							<li>
								<div class="chat">
									<div class="chat-avatar"><img class="img-circle" src="assets/img/avatar1.jpg?1403934956" alt="" /></div>
									<div class="chat-body">
										I just arrived at work, it was quite busy.
										<small>06:44pm</small>
									</div>
									<div class="chat-body">
										I will take look in a minute.
										<small>06:45pm</small>
									</div>
								</div><!--end .chat -->
							</li>
							<li class="chat-left">
								<div class="chat">
									<div class="chat-avatar"><img class="img-circle" src="assets/img/avatar9.jpg?1404026744" alt="" /></div>
									<div class="chat-body">
										The colors are much better now.
									</div>
									<div class="chat-body">
										The colors are brighter than before.
										I have already sent an example.
										This will make it look sharper.
										<small>Mon</small>
									</div>
								</div><!--end .chat -->
							</li>
							<li>
								<div class="chat">
									<div class="chat-avatar"><img class="img-circle" src="assets/img/avatar1.jpg?1403934956" alt="" /></div>
									<div class="chat-body">
										Are the colors of the logo already adapted?
										<small>Last week</small>
									</div>
								</div><!--end .chat -->
							</li>
						</ul>
					</div><!--end .offcanvas-body -->
				</div><!--end .offcanvas-pane -->
				<!-- END OFFCANVAS CHAT -->

			</div><!--end .offcanvas-->
			<!-- END OFFCANVAS RIGHT -->

		</div><!--end #base-->
		<!-- END BASE -->

		<!-- BEGIN JAVASCRIPT -->
		<script src="assets/js/libs/jquery/jquery-1.11.2.min.js"></script>
		<script src="assets/js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
		<script src="assets/js/libs/bootstrap/bootstrap.min.js"></script>
		<script src="assets/js/libs/spin.js/spin.min.js"></script>
		<script src="assets/js/libs/autosize/jquery.autosize.min.js"></script>
		<script src="assets/js/libs/DataTables/jquery.dataTables.min.js"></script>
		<script src="assets/js/libs/DataTables/extensions/ColVis/js/dataTables.colVis.min.js"></script>
		<script src="assets/js/libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
		<script src="assets/js/libs/moment/moment.min.js"></script>
		<script src="assets/js/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
		<script src="assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
		<script src="assets/js/core/source/App.js"></script>
		<script src="assets/js/core/source/AppNavigation.js"></script>
		<script src="assets/js/core/source/AppOffcanvas.js"></script>
		<script src="assets/js/core/source/AppCard.js"></script>
		<script src="assets/js/core/source/AppForm.js"></script>
		<script src="assets/js/core/source/AppNavSearch.js"></script>
		<script src="assets/js/core/source/AppVendor.js"></script>
		<script src="assets/js/core/demo/Demo.js"></script>
		<script src="assets/js/core/demo/DemoFormLayouts.js"></script>
		<script src="assets/js/core/demo/DemoTableDynamic.js"></script>
		<!-- END JAVASCRIPT -->

	</body>
</html>
