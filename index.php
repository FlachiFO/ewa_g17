<?php

session_start();
include_once './config/db_config.php';
include_once './config/sql_query.php';
if(isset($_SESSION['user_session_id'])!="")
{
	header("Location: home.php");
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

    
</head>

<body>
    
    <header class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
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
                    <form class="navbar-form navbar-right search-form" role="search">
				        <input type="text" class="form-control" placeholder="Search" />
                    </form>
-->
<!--                    <button class="navbar-right btn btn-default"><a href="login_regist_site.php">Account</a></button>-->
                    <form class="navbar-form navbar-right form-sigin" action="login_regist_site.php">
                        <button class="btn btn-default" type="submit" value="Login / Registrierung">Login / Registrierung</button>
                    </form>
<!--
                    <form class="navbar-form navbar-right form-sigin" role="search" method="post" id="login-form">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username" name="user" id="user" /> 
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" name="password" id="password" />
                        </div>
                        <button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
                            <span class="glyphicon glyphicon-log-in"></span>
                            &nbsp; Sign In
                        </button>
                        <div id="error"></div>
                    </form>
-->
                </div>
            </center>
        </div>
    </header>
    <div id="main" class="container main_content well"> 
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <?php 
                        for ($i = 0; $i < count($row2); $i++) {     
                            echo '<div class="book_list col-xs-12 col-sm-4 col-md-3 col-lg-3 col-xl-3">';
                            echo '<a href="pages/book_site.php?index='.$row2[$i]["ProduktID"].'">';
                            echo '<img class="book_img_shop" src="'.$row2[$i]["LinkGrafikdatei"].'" ></a>';
                            echo '</div>';
                        }
                ?>
            </div>
        </div>
    </div>
    <footer>
<!--
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <ul class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1 col-xl-10 col-xl-offset-1">
                <li><a href="./pages/regist_site.php">REGISTRIENEN</a></li>
            </ul>
        </div>
    </footer>
-->
</body>

</html>