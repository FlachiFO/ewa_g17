/**
 * Created by maria on 25.01.2017.
 */

/**
 * Created by maria on 18.01.2017.
 */


var myApp = angular.module('myApp', []);
myApp.controller('myController', function($scope, $http) {



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