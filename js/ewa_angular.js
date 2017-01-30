/**
 * Created by maria on 25.01.2017.
 */

/**
 * Created by maria on 18.01.2017.
 */


var myApp = angular.module('myApp', ['ngSanitize','ngStorage']);

myApp.directive('angular', function () {
    return {
        restrict: 'E',
        scope: true,
        templateUrl: 'AngularPrakt.php'
    };
});

myApp.directive('start', function () {
    return {
        restrict: 'E',
        scope: true,
        templateUrl: 'start.php'
    };
});

myApp.directive('bookSite', function () {
    return {
        restrict: 'E',
        scope: true,
        templateUrl: 'book_site.php'
    };
});

myApp.directive('shopingCart', function () {
    return {
        restrict: 'E',
        scope: true,
        templateUrl: 'shopingCart.php'
    };
});

myApp.directive('contactUs', function () {
    return {
        restrict: 'E',
        scope: true,
        templateUrl: 'contactUs.php'
    };
});

myApp.controller('myController',function($scope, $timeout, $http, $localStorage) {

    // variablen initialisierung

    $scope.quantity = 5;
    $scope.hideVariable = false;
    $scope.emptySC = true;
    $scope.actToDo = [];
    $scope.shopingCartContent = [];
    $scope.SCCTotal = 0;
    $scope.presentMode = 0;
    $scope.anzahlBuch = 1;
    $scope.showSHortText = false;

    $scope.url = window.location;
    $scope.bookIndex = $scope.url.search;
    $scope.bookIndex= $scope.bookIndex.split("=")[1];

    $scope.loremIpsum = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';

    $scope.toDoList =
        [{id: 0,title:"Aufräumen",details:"Küche",checked: false},{id: 1,title:"Gassi gehen",details:"Hund",checked: false},{id: 2,title:'Werkstatt', details:'Polo 6N',checked: false}];

    // index Funktionen

    $scope.switchTo = function (tableType) {
        switch (tableType) {
            case 'start':
                $scope.presentMode = '0';
                $scope.start = true;
                $scope.angular = !$scope.start;
                $scope.bookSite = !$scope.start;
                $scope.shopingCart = !$scope.start;
                break;
            case 'angular':
                $scope.presentMode = '1';
                $scope.angular = true;
                $scope.start = !$scope.angular;
                $scope.bookSite = !$scope.angular;
                $scope.shopingCart = !$scope.angular;
                break;
            case 'bookSite':
                $scope.presentMode = '2';
                $scope.bookSite = true;
                $scope.start = !$scope.bookSite;
                $scope.angular = !$scope.bookSite;
                $scope.shopingCart = !$scope.bookSite;
                break;
            case 'shopingCart':
                $scope.presentMode = '3';
                $scope.shopingCart = true;
                $scope.start = !$scope.shopingCart;
                $scope.angular = !$scope.shopingCart;
                $scope.bookSite = !$scope.shopingCart;
                break;
            case 'contactUs':
                $scope.presentMode = '4';
                $scope.contactUs = true;
                $scope.start = !$scope.contactUs;
                $scope.angular = !$scope.contactUs;
                $scope.bookSite = !$scope.contactUs;
                $scope.shopingCart = !$scope.contactUs;
                break;
            default:
        }
    };

    $scope.books = function(book){
        $http.get("./admin/sql_query_search.php").success(function(data) {
            $scope.resultSearch = data;
        });
    };

    $scope.allBooks = function(){
        $http.get("./admin/sql_query_search.php").success(function(data) {
            $scope.test = data;
        });
    };

    $scope.callBook = function(book){
        $http.get("./admin/sql_query_search_live.php",  {
            params: {
                name: book}}).success(function(data) {
            $scope.resultSearch = data;
        });
    };

    // Angular App

    $scope.addItem = function (title,details) {

        $scope.newProduct = {
            id: $scope.toDoList.length,
            title: title,
            detail: details
        };

        $scope.toDoList.push($scope.newProduct);
        console.log($scope.toDoList);

    };

    $scope.save = function(){
        $http.post("/ewa/saveToDo_json.php", JSON.stringify($scope.toDoList)).success(function(data) {
            $scope.hello = data;
        });

    };

    $scope.removeItem = function (x) {
        $scope.errortext = "";
        $scope.products.splice(x, 1);
    };

    $scope.showDetails = function(check,id){
        for(i = 0; i < $scope.toDoList.length; i++){
            if(id == $scope.toDoList[i].id){
                $scope.toDoList[i].checked = check;
            }
        }
    };

    $scope.editToDo = function(x){
        $scope.actToDo = x;
    };

    $scope.refactor = function(title,details){
        for(i = 0;i < $scope.toDoList.length; i++){
            if($scope.toDoList[i].id == $scope.actToDo.id){
                if(title) {
                    $scope.toDoList[i].title = title;
                }
                if(details) {
                    $scope.toDoList[i].details = details;
                }
            }
        }
    }

    // BS Funktionen

    $scope.buecherAnzahlMinus = function(anzahl){
        if(anzahl > 1) {
            $scope.anzahlBuch = anzahl;
            $scope.anzahlBuch -= 1;
        }
    };

    $scope.buecherAnzahlPlus = function(anzahl){
        if(anzahl < 100) {
            $scope.anzahlBuch = anzahl;
            $scope.anzahlBuch += 1;
        }
    };

    $scope.chooseBook = function(index){
        $http.get("./admin/book_for_shoping_cart.php",  {
            params: {
                id: index}}).success(function(data) {
            $scope.singleBook = data;
            $scope.switchTo('bookSite');

        });


    };

    $scope.addToSC = function(anzahl){
        $scope.emptySC = false;
        var kosten = $scope.singleBook[0].PreisBrutto * anzahl;
        $scope.SCContent = {
            ID: $scope.singleBook[0].ProduktID,
            Name: $scope.singleBook[0].Produkttitel,
            Picture: $scope.singleBook[0].LinkGrafikdatei,
            ISBN: $scope.singleBook[0].VerlagsID,
            Quantity: anzahl,
            Stock: $scope.singleBook[0].Lagerbestand,
            Cost: $scope.singleBook[0].PreisBrutto,
            Total: kosten
        };
        $scope.shopingCartContent.push($scope.SCContent);
        $scope.anzahlBuch = 1;
};

    // SC Funktionen

    $scope.countSCTotal = function(){
        if($localStorage.cookieSC != null){
            $scope.shopingCartContent = $localStorage.cookieSC;
            $scope.emptySC = false;
        }

        $scope.SCCTotal = 0;
        var Total = 0;

          for(i=0;i < $scope.shopingCartContent.length;i++){
              Total = $scope.shopingCartContent[i].Total;
              $scope.SCCTotal += Total;
          }
        };

    $scope.removeItem = function(index) {
        $scope.shopingCartContent.splice(index, 1);
        $scope.countSCTotal();
    };

    $scope.finalSC = function(){
        $scope.finalSCContent = $scope.shopingCartContent;
        $localStorage.cookieSC = $scope.finalSCContent;

    };

    $scope.saveSC = function(){

    };

    $scope.loadSC = function(){
        $scope.loadedSC = $localStorage.cookieSC;
    };

    // IV Funktionen

    $scope.invoice = function(){
        console.log($scope.finalSCContent);
        var SOAArray = $scope.finalSCContent;
        var SOATotal = $scope.SCCTotal;
        // for(i=0; i < $scope.finalSCContent.length; i++){
        //     SOAObject = {
        //
        //     };
        // };
        // var SOAdata = [$scope.SCCTotal;]
        $http.get("./soa/soa_client.php",  {
            params: {
                SOAArray: JSON.stringify($scope.finalSCContent),
                SOATotal: SOATotal}}).success(function(data) {
            $scope.SOAresult = data;
        });
        //
        $scope.SCCTotal = 0;
        $scope.shopingCartContent = [];
        $scope.finalSCContent = null;
        $localStorage.cookieSC = null;
    };

    $scope.checkBLZ = function(blz){
        console.log(blz);
        $http.get("./getBLZ.php",  {
            params: {
                blz: blz}}).success(function(data) {
            $scope.yourBank = data;
            console.log($scope.yourBank);
        });
    };

    $scope.checkCreditCard = function(number) {
        var isValid = luhn.check(number);
        console.log(isValid);
    };
});

myApp.directive('showMore', function() {
    return {
        restrict: 'A',
        transclude: true,
        template: [
            '<div class="show-more-container"><ng-transclude></ng-transclude></div>',
            '<a href="#" class="show-more-expand">More</a>',
            '<a href="#" class="show-more-collapse">Less</a>',
        ].join(''),
        link: function(scope, element, attrs, controller) {
            var maxHeight = 60;
            var initialized = null;
            var containerDom = element.children()[0];
            var $showMore = angular.element(element.children()[1]);
            var $showLess = angular.element(element.children()[2]);

            scope.$watch(function () {
                // Watch for any change in the innerHTML. The container may start off empty or small,
                // and then grow as data is added.
                return containerDom.innerHTML;
            }, function () {
                if (null !== initialized) {
                    // This collapse has already been initialized.
                    return;
                }

                if (containerDom.clientHeight <= maxHeight) {
                    // Don't initialize collapse unless the content container is too tall.
                    return;
                }

                $showMore.on('click', function () {
                    element.removeClass('show-more-collapsed');
                    element.addClass('show-more-expanded');
                    containerDom.style.height = null;
                });

                $showLess.on('click', function () {
                    element.removeClass('show-more-expanded');
                    element.addClass('show-more-collapsed');
                    containerDom.style.height = maxHeight + 'px';
                });

                initialized = true;
                $showLess.triggerHandler('click');
            });
        },
    };
});

myApp.filter('setDecimal', function ($filter) {
    return function (input, places) {
        if (isNaN(input)) return input;
        // If we want 1 decimal place, we want to mult/div by 10
        // If we want 2 decimal places, we want to mult/div by 100, etc
        // So use the following to create that factor
        var factor = "1" + Array(+(places > 0 && places + 1)).join("0");
        return Math.round(input * factor) / factor;
    };
});

function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}


