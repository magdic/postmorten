var app = angular.module('myApp', ['ui.bootstrap']);

// CATCT THE ID FROM URL ACCORDING TO THE PROJECT ID
function getUrlVariable(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split("=");
        if (pair[0] == variable) {
            return pair[1];
        }


    }
    return (false);
}

var idProject = getUrlVariable("id");

app.filter('startFrom', function() {
    return function(input, start) {
        if (input) {
            start = +start; //parse to int
            return input.slice(start);
        }
        return [];
    }
});


// var TooltipDemoCtrl = function($scope) {
//     $scope.dynamicTooltip = 'Hello, World!';
//     $scope.dynamicTooltipText = 'dynamic';
//     $scope.htmlTooltip = '<img src="http://www.yorokobu.es/wp-content/uploads/harlem.jpg">';
// };



app.controller('timelinesCtrl', function($scope, $http, $timeout) {
    $http.get('ajax/getTimelines.php?id=' + idProject).success(function(data) {
        $scope.list = data;
        $scope.currentPage = 1; //current page
        $scope.entryLimit = 10; //max no of items to display in a page
        $scope.filteredItems = $scope.list.length; //Initially for no filter  
        $scope.totalItems = $scope.list.length;
    });
    $scope.setPage = function(pageNo) {
        $scope.currentPage = pageNo;
    };
    $scope.filter = function() {
        $timeout(function() {
            $scope.filteredItems = $scope.filtered.length;
        }, 10);
    };
    $scope.sort_by = function(predicate) {
        $scope.predicate = predicate;
        $scope.reverse = !$scope.reverse;
    };
});