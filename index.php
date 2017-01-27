<?php

session_start();
include_once './admin/db_config.php';
include_once './admin/sql_query.php';
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
        <link href="./css/style.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<!--        <script src="https://github.com/silviomoreto/bootstrap-select.git"></script>-->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script>
        <script src="js/ewa_angular.js"></script>
        <!--    <script src="js/function.js"></script>-->
        <script type="text/javascript">
            var sql = <?php echo json_encode($row2); ?>;
            console.log(sql);
        </script>
    </head>

    <body ng-controller="myController" ng-app="myApp" ng-init="books()">

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <input type="text" ng-model="book" ng-change="callBook(book)"  placeholder="Search" />
        <div class="well">
            <ul>
                <li ng-repeat="rs in resultSearch | limitTo:quantity">
                    <span ng-bind="rs.Produkttitel"></span>
                </li>
                <li>and more</li>
            </ul>
        </div>
    </div>

    <!-- Use any element to open the sidenav -->
    <span onclick="openNav()">open</span>
        <header class="navbar navbar-default navbar-fixed-top">

            <div class="container-fluid">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
<!--                    <button class="glyphicon glyphicon-search" onclick="openNav()"></button>-->
                </div>
                <center>
                    <div class="navbar-collapse collapse" id="navbar-main">
                        <ul class="nav navbar-nav">
                            <li><a href="#home" data-ajax="false">Home</a> </li>
                            <!--                        <li><a href="#">Shop</a> </li>-->
                            <li><a href="#">Contact us</a> </li>
                            <li><a href="#">Angular</a></li>
                        </ul>
                        <button class="btn btn-default glyphicon glyphicon-search" onclick="openNav()"></button>
                        <form class="navbar-form navbar-right form-sigin" action="login_regist_site.php">
                            <button class="btn btn-default" type="submit" value="Login / Registrierung">Login / Registrierung</button>
                        </form>
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
                            echo '<a href="book_site.php?index='.$row2[$i]["ProduktID"].'">';
                            echo '<img class="book_img_shop" src="'.$row2[$i]["LinkGrafikdatei"].'" ></a>';
                            echo '</div>';
                        }
                ?>
                </div>
            </div>
        </div>
        <footer style="background: #aaa;color:white;position: fixed;  right: 0;  bottom: 0;  left: 0;  padding: 1rem;  text-align: center;">Benjamin Flache & Paul Bruntsch</footer>
    <div class="modal fade" id="angularPrakt" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">AngularJS Praktikum</h4>
                </div>
                <div class="modal-body">
                    <p>Some text in the modal.</p>
                    <ul class="w3-ul">
                        <li ng-repeat="x in products" class="w3-padding-16">
                            <span ng-bind="x.title"></span><span style="float:right"
                                                                 ng-hide="hideVariable" ng-bind="x.detail"></span>
                        </li>
                    </ul>
                    <div class="w3-container w3-light-grey w3-padding-16">
                        <div class="w3-row w3-margin-top">
                            <div class="w3-col s10">

                                <form>
                                    <input placeholder="Add shopping items here" ng-model="title"
                                           class="w3-input w3-border w3-padding">
                                    <input placeholder="Add shopping items here" ng-model="detail"
                                           class="w3-input w3-border w3-padding">
                                    <input type="button" ng-click="newObject(title, detail)">
                                </form>

                            </div>
                            <div class="w3-col s2"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal">Abbrechen</button>
                </div>
            </div>

                 </div>
    </div>

    </body>

    </html>