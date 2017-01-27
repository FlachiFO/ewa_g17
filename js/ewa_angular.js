/**
 * Created by maria on 25.01.2017.
 */

/**
 * Created by maria on 18.01.2017.
 */


var myApp = angular.module('myApp', []);
myApp.controller('myController', function($scope, $http) {

    $scope.quantity = 5;
    $scope.hideVariable = true;

    $scope.products =
        [{title:"tada",detail:"ahoi"},{title:"schön",detail:"nu"}];

    $scope.books = function(book){
        $http.get("./admin/sql_query_search.php").success(function(data) {
            $scope.resultSearch = data;
        });
    };

    $scope.callBook = function(book){
        $http.get("./admin/sql_query_search_live.php",  {
            params: {
                name: book}}).success(function(data) {
            $scope.resultSearch = data;
                });
    };

    $scope.addItem = function () {
        $scope.errortext = "";
        if (!$scope.addMe) {return;}
        if ($scope.products.indexOf($scope.addMe) == -1) {
            $scope.products.push($scope.addMe);
        } else {
            $scope.errortext = "The item is already in your shopping list.";
        }
    };

    $scope.removeItem = function (x) {
        $scope.errortext = "";
        $scope.products.splice(x, 1);
    };

    $scope.newObject = function(title, detail){

        $scope.newProduct = {
            title: title,
            detail: detail
        };

        $scope.products.push($scope.newProduct);
    };

});








myApp.directive('selectWatcher', function ($timeout) {
    return {
        link: function (scope, element, attr) {
            var last = attr.last;
            if (last === "true") {
                $timeout(function () {
                    $(element).parent().selectpicker('refresh');
                    $(element).parent().selectpicker('val', 'any');
                    $(element).parent().selectpicker('refresh');
                });
            }
        }
    };
});

function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}