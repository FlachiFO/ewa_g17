<?php

session_start();

?>
<script src="js/creditcardcheck.js"></script>
<h2>Shopping Cart</h2>
<table class="table">
    <tr>
        <th>Picture</th>
        <th></th>
        <th>Quantity</th>
        <th></th>
        <th>Cost</th>
        <th>Total</th>
        <th></th>
    </tr>
    <tr ng-repeat="item in shopingCartContent">
       <td>
<!--           <div class="book_list col-xs-12 col-sm-4 col-md-3 col-lg-3 col-xl-3">-->
                <img style="height: 200px" ng-src="{{item.Picture}}">
<!--           </div>-->
       </td>
        <td>
            <button type="button" class="btn" ng-click="">
                <span class="glyphicon glyphicon-minus"></span>
            </button>
        </td>
        <td><input type="number" ng-model="item.Quantity" class="input-mini"/></td>
        <td>
            <button type="button" class="btn" ng-click="">
                <span class="glyphicon glyphicon-plus"></span>
            </button>
        </td>
        <td ng-bind="item.Cost + '€'" class="input-mini"></td>
        <td ng-bind="(item.Total | setDecimal:2) + '€'"></td>
        <td>[<a href ng-click="removeItem($index)">X</a>]</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td ng-bind="(SCCTotal | setDecimal:2) + '€'" class="input-mini"></td>
        <td>
            <button ng-hide="emptySC" class="btn btn-primary btn-s" data-toggle="modal" data-target="#invoice" ng-click="finalSC()">Jetzt bestellen</button>
        </td>
    </tr>
</table>
<div class="modal fade" id="invoice" role="dialog">
    <div class="modal-dialog" style="z-index: 99999;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Bezahlvorgang</h4>
            </div>
            <div class="modal-body">
                <div class="well" style="padding-top: 0">
                    <h2>Lieferadresse</h2>
                    <?php if(isset($_SESSION['user_session_id'])!=""){ ?>
                        <?php echo $_SESSION['user_session_anrede']; ?><br>
                        <?php echo $_SESSION['user_session_name']; ?><br>
                        <?php echo $_SESSION['user_session_plz']; ?>
                        <?php echo $_SESSION['user_session_ort']; ?><br>
                        <?php echo $_SESSION['user_session_address']; ?><br>
                        <?php echo $_SESSION['user_session_country']; ?><br>
                    <?php } ?>
                </div>
                <div class="well" style="padding-top: 0">
                    <h2>Invoice</h2>
                    <div>
                        <span><b>Buch</b></span><span style="float: right"><b>Anzahl</b></span>
                    </div>
                    <div ng-repeat="cont in finalSCContent">
                        <span ng-bind="cont.Name"></span><span ng-bind="cont.Quantity" style="float: right"></span>
                    </div>
                    <hr style="border: solid #000000 1px;">
                    <div>
                        <span>Gesamtkosten:</span><span ng-bind="SCCTotal + '€'" style="float: right"></span>
                    </div>
                    <div>
                        <input type="text" name="BLZ" ng-model="BLZ" placeholder="Check BLZ">
                        <button ng-click="checkBLZ(BLZ)">Check</button>
                    </div>
                    <form id="credit-card-entry-form" method="POST">
                        <input type="text" name="credit-card-number" placeholder="Enter your credit card number here" />
                        <input type="submit" value="Submit" />
                    </form>
                </div>
                <button class="btn btn-primary btn-s" style="float: right" ng-click="invoice()" data-dismiss="modal">Bezahlen</button>
            </div>
        </div>
    </div>
</div>