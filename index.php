<?php

session_start();
include_once './admin/db_config.php';
include_once './admin/sql_query.php';


?>
    <!DOCTYPE html>
    <html lang="de">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>EWA-Shop</title>
        <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
        <link href="./css/style.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/angularjs/1.0.3/angular-sanitize.js"></script>
        <script src="https://cdn.rawgit.com/leodido/ng-luhn/master/luhn.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/ngStorage/0.3.11/ngStorage.min.js"></script>
<!--        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-route.js">-->
        <script src="js/ewa_angular.js"></script>
        <script src="js/book_site.js"></script>
        <script src="js/creditcardcheck.js"></script>

        <script>
            $(document).ready(function(){
                $('.dropdown-submenu a.test').on("click", function(e){
                    $(this).next('ul').toggle();
                    e.stopPropagation();
                    e.preventDefault();
                });
            });
        </script>
        <style>
            .dropdown-submenu {
                position: relative;
            }

            .dropdown-submenu .dropdown-menu {
                top: 0;
                left: 100%;
                margin-top: -1px;
            }


        </style>
    </head>

<!--    <section >-->





    <body ng-controller="myController" ng-app="myApp" ng-init="books()">
    <img src="Unbenannt.png">
    <header class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div>
            <center>
                <div class="navbar-collapse collapse" id="navbar-main">
                    <ul class="nav navbar-nav">
                        <li><a href="#" ng-click="switchTo('start')">Home</a> </li>
                        <li><a href="/ewa/AngularPrakt.html">Contact us</a> </li>
                        <?php if(isset($_SESSION['user_session_id'])!=""){ ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Links<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="http://wave.webaim.org/report#/http://ivm108.informatik.htw-dresden.de/ewa/G17/" data-ajax="false">Barrierefreiheit</a> </li>
                                <li><a href="#" ng-click="switchTo('angular')">Angular</a></li>
                                <li><a href="http://ivm108.informatik.htw-dresden.de/ewa/G17/wordpress/">Wordpress</a></li>
                                <li><a href="https://warm-spire-16575.herokuapp.com/">NodeJs</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-submenu">
                                    <a class="test" href="#">XML<span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a tabindex="-1" href="./xml/buecher.xsl">xsl</a></li>
                                            <li><a tabindex="-1" href="./xml/buecher.dtd">dtd</a></li>
                                            <li><a href="./xml/buecher.xml">xml</a></li>
                                            <li><a href="./xml/buecher.xsd">xsd</a></li>
                                        </ul>
                                </li>
                            </ul>
                        </li>
                        <?php } ?>
                        <li><button class="btn btn-default glyphicon glyphicon-search" onclick="openNav()"></button></li>
                    </ul>
                    <form class="navbar-form navbar-right form-sigin" action="login_regist_site.php">
                            <?php if(isset($_SESSION['user_session_id'])!=""){ ?>
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="#" ng-click="switchTo('shopingCart');countSCTotal()" class="btn btn-default glyphicon glyphicon-shopping-cart"></a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="glyphicon glyphicon-user"></span> &nbsp;Hi
                                            <?php echo $_SESSION['user_session_name']; ?>&nbsp; <span class="caret"></span> </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="user_site.php"><span class="glyphicon glyphicon-user"></span>&nbsp;View Profile</a></li>
                                            <li><a href="./admin/logout_process.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
                                        </ul>
                                    </li>
                                </ul>
                           <?php } else { ?>
                                <button class="btn btn-default" type="submit" value="Login / Registrierung"> <?php echo 'Login / Registrierung'; ?></button>
                            <?php } ?>

                    </form>
                </div>
            </center>
        </div>
    </header>
    <!-- Use any element to open the sidenav -->
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <input type="text" ng-model="book" ng-change="callBook(book)"  placeholder="Search" />
        <div class="well">
            <ul>
                <li ng-repeat="rs in resultSearch | limitTo:quantity">
                    <a href="#" onclick="closeNav()" ng-click="chooseBook(rs.ProduktID)">
                        <span ng-bind="rs.Produkttitel"></span>
                    </a>
                </li>
                <li>and more</li>
            </ul>
        </div>
    </div>

    <div ng-switch="presentMode">
        <start ng-switch-when="0"></start>
        <angular ng-switch-when="1"></angular>
        <book-site ng-switch-when="2"></book-site>
        <shoping-cart ng-switch-when="3"></shoping-cart>

    </div>
    </body>

<!--    </body>-->
        <footer style="background: #aaa;color:white; right: 0;  bottom: 0;  left: 0;  padding: 1rem;  text-align: center;">Benjamin Flache & Paul Bruntsch</footer>
<!--    </section>-->



    </html>