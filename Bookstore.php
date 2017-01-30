<?php

session_start();
include_once './admin/db_config.php';
include_once './admin/sql_query.php';
if(isset($_SESSION['user_session_id'])!="")
{
	header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EWA-Shop</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <script src="js/ewa_angular.js"></script>
    <script src="js/Bookstore.js"></script>
    <script type="text/javascript">
        var sql = <?php echo json_encode($row2); ?>;
    </script>
</head>
<header class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
            <div class="navbar-collapse collapse" id="navbar-main">
                <ul class="nav navbar-nav">
                    <li><a href="#" id="start" data-ajax="false">Home</a> </li>
                    <li><a href="/ewa/AngularPrakt.html">Contact us</a> </li>
                    <li><a href="#" id="angular">Angular</a></li>

                </ul>
                <button class="btn btn-default glyphicon glyphicon-search" onclick="openNav()"></button>
                <form class="navbar-form navbar-right form-sigin" action="login_regist_site.php">
                    <button class="btn btn-default" type="submit" value="Login / Registrierung">Login / Registrierung</button>
                </form>
            </div>
    </div>
</header>
<body ng-controller="myController" ng-app="myApp" ng-init="books()">
    <div id="body">
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

        </div>
</body>
<footer style="background: #aaa;color:white;position: fixed;  right: 0;  bottom: 0;  left: 0;  padding: 1rem;  text-align: center;">Benjamin Flache & Paul Bruntsch</footer>
</html>