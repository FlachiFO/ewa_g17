<?php
session_start();
include_once './config/db_config.php';
include_once './config/sql_query.php';
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
        <link href="css/sweetalert.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <script src="js/sweetalert.js"></script>
        <script src="js/function.js"></script>
    </head>
    <body>
        <!------------------------------------------------------------------------------------------------------------------------------>
        <header class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                </div>
                <center>
                    <div class="navbar-collapse collapse" id="navbar-main">
                        <ul class="nav navbar-nav">
                            <li><a href=".." data-ajax="false">Home</a> </li>
                            <!--                        <li><a href="#">Shop</a> </li>-->
                            <li><a href="#">Contact us</a> </li>
                        </ul>
                        <form class="navbar-form navbar-left search-form" role="search">
                            <input type="text" class="form-control" placeholder="Search" /> </form>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="glyphicon glyphicon-user"></span> &nbsp;Hi
                                    <?php echo $_SESSION['user_session_name']; ?>&nbsp; <span class="caret"></span> </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;View Profile</a></li>
                                    <li><a href="./config/logout_process.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </center>
            </div>
        </header>
        <!------------------------------------------------------------------------------------------------------------------------------>
        <div class="container main_content well">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 user_site_img" >
                <img src="./img/profilbild.jpg" class="img-circle">
            </div>

            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 col-xl-5">
            <?php
                echo '<h3>'.$_SESSION['user_session_anrede'].' '.$_SESSION['user_session_name'].'</h3>';
                echo '<h6>Addresse:'.$_SESSION['user_session_address'].'</h6>';
            ?>
            </div>
            
            <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1 col-xl-1">
                <div class="btn-group">
                    <a class="btn dropdown-toggle btn-info" data-toggle="dropdown" href="#">
                        Action 
                        <span class="icon-cog icon-white"></span><span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><span id="del_user" class="icon-wrench"></span> Passwort ändern</a></li>
                        <li><a class="del_user" href="#"><span class="icon-trash"></span> Delete</a></li>
                    </ul>
                </div>
            </div>
    </div>
        <!------------------------------------------------------------------------------------------------------------------------------>
</body>
</html>