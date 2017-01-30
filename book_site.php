<?php

session_start();

?>
    <main class="container main_content well" ng-repeat="y in singleBook track by $index">

        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 book_site_img">
            <img ng-src="{{y.LinkGrafikdatei}}">
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 book_site_main">
            <H3 ng-bind="y.Produkttitel"></H3>
            <ul>
                <b>Autorname:</b><li ng-bind="y.Autorname"></li>
                <b>Verlagsname:</b><li ng-bind="y.Verlagsname"></li>
                <b>ISBN-Nr.:</b><li ng-bind="y.VerlagsID"></li>
                <b>Preis:</b><li ng-bind="y.PreisBrutto + '€'"></li>

                <p></p>
                <?php if(isset($_SESSION['user_session_id'])!=""){ ?>
                <li>
                    <div class="input-group">

                          <button type="button" class="btn btn-danger btn-number" style="float: left" data-type="minus" ng-click="buecherAnzahlMinus(anzahlBuch)">
                            <span class="glyphicon glyphicon-minus"></span>
                          </button>

                        <input type="text" class="form-control" ng-value="anzahlBuch" min="1" max="100" style="width: 20%;float: left">

                          <button type="button" class="btn btn-success btn-number" style="float: left" data-type="plus" ng-click="buecherAnzahlPlus(anzahlBuch)">
                              <span class="glyphicon glyphicon-plus"></span>
                          </button>

                    </div>
                </li>
                <p></p>
                <button class="btn btn-primary btn-s" ng-click="addToSC(anzahlBuch);switchTo('start')">
                    <span class="glyphicon glyphicon-shopping-cart"></span> In den Warenkorb
                </button>
                <?php } ?>
            </ul>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 book_site_text">
            <H5>Kurzbeschreibung</H5><br>
            <article>
                <div class="well" style="background-color: #dff0d8">
                    <div show-more>
                        {{ y.Kurzinhalt }}
                    </div>
<!--                    <p ng-text-truncate="y.Kurzinhalt"-->
<!--                       ng-tt-chars-threshold="40"></p>-->
<!--                    <span ng-bind="y.Kurzinhalt"></span>-->
                </div>
            </article>
        </div>
    </main>
