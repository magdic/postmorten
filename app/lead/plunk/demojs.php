<?php //connect to the database so we can check, edit, or insert data to our users table
include('../../../config/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../../../config/functions.php"; ?>

<script type="text/javascript">
'use strict';

var app = angular.module('demo', ['ngSanitize', 'ui.select', 'ui.bootstrap']);

/**
 * AngularJS default filter with the following expression:
 * "person in people | filter: {name: $select.search, age: $select.search}"
 * performs a AND between 'name: $select.search' and 'age: $select.search'.
 * We want to perform a OR.
 */
app.filter('propsFilter', function() {
  return function(items, props) {
    var out = [];

    if (angular.isArray(items)) {
      items.forEach(function(item) {
        var itemMatches = false;

        var keys = Object.keys(props);
        for (var i = 0; i < keys.length; i++) {
          var prop = keys[i];
          var text = props[prop].toLowerCase();
          if (item[prop].toString().toLowerCase().indexOf(text) !== -1) {
            itemMatches = true;
            break;
          }
        }

        if (itemMatches) {
          out.push(item);
        }
      });
    } else {
      // Let the output be the input untouched
      out = items;
    }

    return out;
  }
});

app.controller('DemoCtrl', function($scope, $http) {
  $scope.disabled = undefined;

  $scope.enable = function() {
    $scope.disabled = false;
  };

  $scope.disable = function() {
    $scope.disabled = true;
  };

  $scope.clear = function() {
    $scope.project.selected = undefined;
    $scope.address.selected = undefined;
    $scope.country.selected = undefined;
  };

  $scope.project = {};
  $scope.projects = [
    <?php 
		$test = mysql_query("SELECT * FROM timeProject");
		//split all fields fom the correct row into an associative array
		while($rowie = mysql_fetch_array($test)) {
			echo '{name:\''.$rowie['headlineP'].'\', id:\''.$rowie['idtimeLine'].'\'},';
 		}
	?>
  ];

  $scope.user = {};
  $scope.users = [ // Taken from https://gist.github.com/unceus/6501985
    <?php 
		$users = mysql_query("SELECT * FROM users");
		//split all fields fom the correct row into an associative array
		while($rowU = mysql_fetch_array($users)) {
			echo '{name:\''.$rowU['name'].' '.$rowU['lastname'].'\', id:\''.$rowU['id'].'\'},';
 		}
	?>
  ];
});





app.filter('startFrom', function() {
    return function(input, start) {
        if(input) {
            start = +start; //parse to int
            return input.slice(start);
        }
        return [];
    }
});
app.controller('customersCrtl', function ($scope, $http, $timeout) {
    $http.get('ajax/getProjects.php').success(function(data){
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

</script>