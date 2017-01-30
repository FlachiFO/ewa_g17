 <div id="main" class="container main_content well" ng-init="allBooks()">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="book_list col-xs-12 col-sm-4 col-md-3 col-lg-3 col-xl-3" ng-repeat="sha in test">
                        <a ng-href="#" ng-click="chooseBook(sha.ProduktID)">
                            <img class="book_img_shop" ng-src="{{sha.LinkGrafikdatei}}">
                        </a>
                    </div>
                </div>
            </div>
 </div>