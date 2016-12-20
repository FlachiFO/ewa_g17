<?php

session_start();
include_once '../config/db_config.php';
include_once '../config/sql_query.php';
$book = $_GET["index"];

?>
<!DOCTYPE html>

<html lang="de">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EWA-Shop</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<!--    <script src="js/function.js"></script>-->

    
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
                        <li><a href="#">Contact us</a> </li>
                    </ul>
                    <form class="navbar-form navbar-left search-form" role="search">
                        <input type="text" class="form-control" placeholder="Search" /> </form>
                    <?php if (isset($_SESSION['user_session_id'])!="") { ?>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="glyphicon glyphicon-user"></span> &nbsp;Hi
                                    <?php echo $_SESSION['user_session_name']; ?>&nbsp; <span class="caret"></span> </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;View Profile</a></li>
                                    <li><a href="../config/logout_process.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    <?php } elseif(!isset($_SESSION['user_session_id'])) { ?>
                        <form class="navbar-form navbar-right form-sigin" action="../login_regist_site.php">
                            <button class="btn btn-default" type="submit" value="Login / Registrierung">Login / Registrierung</button>
                        </form>
                    <?php } ?>
                </div>
            </center>
        </div>
    </header>
    <!------------------------------------------------------------------------------------------------------------------------------>
    <main class="container main_content well">
        <?php 
                for ($i = 0; $i < count($row2); $i++) {
                    if ($row2[$i]["ProduktID"] == $book) {
        ?>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 book_site_img">
            <img src="<?php echo $row2[$i]["LinkGrafikdatei"]; ?>">        
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 book_site_main">
            <H3><?php echo $row2[$i]["Produkttitel"]; ?></H3>
            <ul>
                <li><b>Autorname: </b><?php echo $row2[$i]["Autorname"]; ?></li>
                <li><b>Verlagsname: </b><?php echo $row2[$i]["Verlagsname"]; ?></li>
                <li>VerlagsID: <?php echo $row2[$i]["VerlagsID"]; ?></li>
                <li>Preis: <?php echo $row2[$i]["PreisBrutto"]; ?></li>
            </ul>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 book_site_text">
            <H5>Kurzbeschreibung</H5><br>
            <article>
                <?php echo $row2[$i]["Kurzinhalt"] ?>
            </article>
        </div>
        <?php }} ?>
    </main>
</body>
</html>