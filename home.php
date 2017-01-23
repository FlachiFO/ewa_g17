<?php
session_start();
include_once './conf/db_config.php';
include_once './conf/sql_query.php';
if(!isset($_SESSION['user_session_id']))
{
	header("Location: index.php");
}



?>
    <!DOCTYPE html>
    <html lang="de">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>EWA-Shop</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <!--    <script src="js/function.js"></script>-->
<!--        <script src="js/angular.min.js"></script>-->
    </head>
    <script>
           var sql = <?php echo json_encode($row2); ?>; 
    </script>
        <script src="js/book_search.js"></script>

    <body ng-app="myApp">
        <!------------------------------------------------------------------------------------------------------------------------------>
        <header class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                </div>
                <center>
                    <div class="navbar-collapse collapse" id="navbar-main">
                        <ul class="nav navbar-nav">
                            <li><a href="#home" data-ajax="false">Home</a> </li>
                            <!--                        <li><a href="#">Shop</a> </li>-->
                            <li><a href="#">Contact us</a> </li>
                        </ul>
<!--
                        <form id="search" class="navbar-form navbar-left search-form" role="search">
                            <input type="text" name="book_search" class="book_search form-control" placeholder="Search" /> </form>
-->
<!--
                        <div>
                            <select data-live-search="true" class="selectpicker" ng-model="id" ng-change="changeMetpoint(id)">
                                <option class="small-font" ng-repeat="member in metpoint track by $index" data-select-watcher data-last="{{ '{{$last}}' }}" value="{{ '{{member.id}}' }}">{{ '{{member.name}}' }}</option>
                            </select>
                        </div>
-->
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="glyphicon glyphicon-user"></span> &nbsp;Hi
                                    <?php echo $_SESSION['user_session_name']; ?>&nbsp; <span class="caret"></span> </a>
                                <ul class="dropdown-menu">
                                    <li><a href="user_site.php"><span class="glyphicon glyphicon-user"></span>&nbsp;View Profile</a></li>
                                    <li><a href="./conf/logout_process.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </center>
            </div>
        </header>
        <!------------------------------------------------------------------------------------------------------------------------------>
        <div id="main" class="container main_content well">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <?php 
                    for ($i = 0; $i < count($row2); $i++) {     
                        echo '<div class="book_list col-xs-12 col-sm-4 col-md-3 col-lg-3 col-xl-3">';
                        echo '<a href="book_site.php?index='.$row2[$i]["ProduktID"].'">';
                        echo '<img class="book_img_shop" src="'.$row2[$i]["LinkGrafikdatei"].'" ></a>';
                        echo '</div>';
                    }
                ?>
                </div>
            </div>
            <!------------------------------------------------------------------------------------------------------------------------------>
            <!--
    <footer>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <ul class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1 col-xl-10 col-xl-offset-1">
                <li><a href="./config/regist.php">REGISTRIENEN</a></li>
                <li><a href="www.htw-dresden.de"><img class="footer_img" src="img/HTW%20Ohne.png"></a></li>
            </ul>
            <p class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1 col-xl-10 col-xl-offset-1">&copy; 2016 Flache und Bruntsch<p>
        </div>
    </footer>
-->
    </body>

    </html>