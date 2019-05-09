<?php
require "dbconnect.php" ;
date_default_timezone_set("Asia/Dhaka");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SurveQ</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/lightbox.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/modern-business.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="plugins/DataTables-1.10.5/media/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="plugins/DataTables-1.10.5/media/css/dataTables.bootstrap.css">
    <!--FOOTER-->
    <link rel="stylesheet" href="css/footer-distributed-with-address-and-phones.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

    <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
    <!--Services-->
    <!-- Main color style -->
    <link rel="stylesheet" href="css/red.css"/>
    <!-- Template styles-->
    <link rel="stylesheet" href="css/custom.css" />
    <!-- Responsive -->
    <link rel="stylesheet" href="css/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />


    <!--[if lt IE 9]>
	    <script src="js/html5shiv.js"></script>
	    <script src="js/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" charset="utf8" src="plugins/DataTables-1.10.5/media/js/jquery.dataTables.js"></script>
        <script type="text/javascript"  src="plugins/charts/amcharts/amcharts.js"></script>
        <script type="text/javascript"  src="plugins/charts/amcharts/pie.js"></script>

        <link rel="shortcut icon" href="images/surveqlogo5.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">


    </head><!--/head-->

    <body>
       <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 overflow">
                 <div class="social-icons pull-right">
                    <ul class="nav nav-pills">
                        <li><a href=""><i class="fa fa-facebook"></i></a></li>
                        <li><a href=""><i class="fa fa-twitter"></i></a></li>
                        <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                        <li><a href=""><i class="fa fa-dribbble"></i></a></li>
                        <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
                </div>
            </div>
        </div>
           <a class="navbar-brand" href="index.php">
               <h1 style="height: 130px ; width: 250px"><img src="images/surveqlogo5.png" alt="logo"></h1>
           </a>
    <div class="navbar navbar-inverse" role="banner">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
           </div>
           <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <?php

                if(isset($_SESSION['email']))
                {
                    echo'
                    <li class="active"><a href="homepage.php" style="font-size:15px;">'.$_SESSION['user_name'].'</a></li>
                    <li class="active"><a href="search.php" style="font-size:15px;" >SEARCH</a></li>
                    <li class="active"><a href="quizlist.php" style="font-size:15px;">Quiz Invites</a></li>
                    <li class="active"><a href="signout.php" style="font-size:15px ">SIGNOUT</a></li>
                    ';
                }
                else
                {

                    echo'<form class="navbar-form navbar-right" action="signin.php" method="post">
                    <div class="form-group">
                        <input type="text" placeholder="Email" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Password" class="form-control" name="password">
                    </div>
                    <button type="submit" class="btn btn-success">Sign in</button>
                </form>
                ';
            }

            ?>

        </ul>
    </div>
</div>
</div>
</header>
<!--/#header-->
