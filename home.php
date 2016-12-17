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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EWA-Shop</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
<!--    <link href="css/bootstrap-theme.min.css" rel="stylesheet">-->
    <link href="css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="js/function.js"></script>

    
</head>

<body>
<!------------------------------------------------------------------------------------------------------------------------------>
    <header class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main"> 
                    <span class="icon-bar"></span> 
                    <span class="icon-bar"></span> 
                    <span class="icon-bar"></span> 
                </button>
            </div>
            <center>
                <div class="navbar-collapse collapse" id="navbar-main">
                    <ul class="nav navbar-nav">
                        <li><a href="#home" data-ajax="false">Home</a> </li>
                        <li><a href="#">Shop</a> </li>
                        <li><a href="#">Contact us</a> </li>
                    </ul>
                    <form class="navbar-form navbar-left search-form" role="search">
				        <input type="text" class="form-control" placeholder="Search" />
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-user"></span>
                            &nbsp;Hi <?php echo $_SESSION['user_session_name']; ?>&nbsp;
                            <span class="caret"></span>
                        </a>
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
    <div id="main" class="main_content well"> 
         <table id="katalog" class="table">
            <tr>
                <th>Buchtitel</th>
                <th>Autor</th>
            </tr>
           <?php 
                for ($i = 0; $i < count($row2); $i++) {     
                    echo '<tr>';
                    echo '<td>' .$row2[$i]["Produkttitel"]. '</td>';
                    echo '<td>' .$row2[$i]["Autorname"]. '</td>';
                    echo '</tr>';
                }
            ?>
        </table>
       
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