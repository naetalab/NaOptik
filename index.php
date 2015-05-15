<?php
session_start();
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

define('BASEPATH','TEST');
// Baca Jam pada Komputer
date_default_timezone_set("Asia/Jakarta");

if(isset($_SESSION['SES_LOGIN']))
{
   
?>
<!DOCTYPE html>
<html class="" lang="en"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
           Simple POS
    </title>
    
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">
	<link rel="stylesheet" type="text/css" href="css/theme.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="js/jquery_010.js"></script>
	
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/jquery_008.js"></script>
	<script type="text/javascript" src="js/jquery_002.js"></script>
	<script type="text/javascript" src="js/jquery_009.js"></script>
	<script type="text/javascript" src="js/cakeui.js"></script>
	<script type="text/javascript" src="js/jquery_006.js"></script>
	<script type="text/javascript" src="js/jquery_005.js"></script>
	  
	    <style>
		body  {
		   background-image: url('images/body-bg.gif');
		   min-height: 100%;
		   
		}
		.success {  background-color: #F5F5F5;
		            display: block; 
				    border-radius: 4px;
					list-style: none outside none;
					margin: 0 0 20px;
					padding: 8px 15px;
		}
		
		.navbar {
		  
			background-color: #f2f2f2;
			background-image: none;
		 
		}
		
		</style>
		
	
  
	<link rel="stylesheet" type="text/css" href="css/debug_toolbar.css">
<script type="text/javascript">
//<![CDATA[
window.DEBUGKIT_JQUERY_URL = "/ecanteen_ws/debug_kit/js/jquery.js";
//]]>
</script><script type="text/javascript" src="js/js_debug_toolbar.js"></script>
<style type="text/css">.fancybox-margin{margin-right:17px;}</style></head>
  <body role="document">
  	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
	  
		<a class="navbar-brand" href="?open"> 
				<i class="fa fa-android"></i>
		Simple POS</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
	 
	<?php include "menu.php"; ?>
	

	
	</div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>	
    <div class="container theme-showcase" role="main">
                

<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="js/jquery.js"></script>

<!-- Add fancyBox -->
<link rel="stylesheet" href="js/jquery_003.css" type="text/css" media="screen">
<script type="text/javascript" src="js/jquery_004.js"></script>

<!-- Optionally add helpers - button, thumbnail and/or media -->
<link rel="stylesheet" href="js/jquery_002.css" type="text/css" media="screen">
<script type="text/javascript" src="js/jquery_003.js"></script>
<script type="text/javascript" src="js/jquery_011.js"></script>

<link rel="stylesheet" href="css/jquery.css" type="text/css" media="screen">
<script type="text/javascript" src="js/jquery_007.js"></script>

<script type="text/javascript">

	$(document).ready(function() {
		$(".fancybox").fancybox();
	});

</script>
<div class="page-header">
  <h1><i class="fa fa-list-alt"></i>&nbsp;Simple POS</h1>
</div>

<ol class="breadcrumb">
  <li><a href="#">Home</a></li>
  <li><a href="#">Simple POS</a></li>
  <li class="active">Index</li>
</ol>		
<br>		
<div class="panel panel-primary">
  <div class="panel-heading">Simple POS:</div>
   
  
       <div class="panel-body">
   
          	<?php include "buka_file.php";?>
		
       </div>
     </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="js/FusionCharts.js"></script>  
	

  <script>
    $('.cakeui-tooltip').tooltip();
    $('.pop').popover({
      container: 'body',
      html: true,
      content: function () {
        return $(this).next('.pop-content').html();
      }
    });
    </script>
</body>
</html>

<?php 
}
else
{
	 header("Location:login.php");
}

?>