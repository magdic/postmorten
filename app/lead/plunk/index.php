<!-- 
<!DOCTYPE html>
<html lang="en" ng-app="demo">
<head>
  <meta charset="utf-8">
  <title>AngularJS ui-select</title> -->

  <!--
    IE8 support, see AngularJS Internet Explorer Compatibility http://docs.angularjs.org/guide/ie
    For Firefox 3.6, you will also need to include jQuery and ECMAScript 5 shim
  -->
  <!--[if lt IE 9]>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/es5-shim/2.2.0/es5-shim.js"></script>
    <script>
      document.createElement('ui-select');
      document.createElement('match');
      document.createElement('choices');
    </script>
  <![endif]-->

  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular-sanitize.js"></script>
  <!-- <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.css"> -->

  <!-- ui-select files -->
  <script src="select.js"></script>
  <link rel="stylesheet" href="select.css">

  <!--  IT'S THE SAME THAT YOU CALL AN EXTERNAL SCRIPT <script src="demo.js"></script> -->
  <?php include("demojs.php"); ?>

  <!-- Select2 theme -->
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/select2/3.4.5/select2.css">

  <!--
    Selectize theme
    Less versions are available at https://github.com/brianreavis/selectize.js/tree/master/dist/less
  -->
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.8.5/css/selectize.default.css">
  <!-- <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.8.5/css/selectize.bootstrap2.css"> -->
  <!-- <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.8.5/css/selectize.bootstrap3.css"> -->

  <!-- <style>
    body {
      padding: 15px;
    }

    .select2 > .select2-choice.ui-select-match {
      /* Because of the inclusion of Bootstrap */
      height: 29px;
    }

    .selectize-control > .selectize-dropdown {
      top: 36px;
    }
  </style>
</head> -->

<div ng-controller="DemoCtrl">
  <!-- <script src="demo.js"></script> -->

<!--   <button class="btn btn-default btn-xs" ng-click="enable()">Enable ui-select</button>
  <button class="btn btn-default btn-xs" ng-click="disable()">Disable ui-select</button>
  <button class="btn btn-default btn-xs" ng-click="clear()">Clear ng-model</button> -->

<!--   <h3>Bootstrap theme</h3>
  <p>Selected: {{address.selected.formatted_address}}</p>
  <ui-select ng-model="address.selected"
             theme="bootstrap"
             ng-disabled="disabled"
             reset-search-input="false"
             style="width: 300px;">
    <match placeholder="Enter an address...">{{$select.selected.formatted_address}}</match>
    <choices repeat="address in addresses track by $index"
             refresh="refreshAddresses($select.search)"
             refresh-delay="0">
      <div ng-bind-html="address.formatted_address | highlight: $select.search"></div>
    </choices>
  </ui-select> -->

<!--   <h3>Selecta Project</h3>
  <ui-select ng-model="project.selected" theme="projects" ng-disabled="disabled" style="width: 300px;">
    <match placeholder="Select a project...">{{$select.selected.name}}</match>
    <choices repeat="project in projects | propsFilter: {name: $select.search, id: $select.search}">
    <div ng-bind-html="project.name | highlight: $select.search"></div>
      <small>
      </small>
    </choices>
  </ui-select>
 -->
<!--     <h3>Select Users</h3>
  <ui-select ng-model="user.selected" theme="users" ng-disabled="disabled" style="width: 300px;">
    <match placeholder="Select a project...">{{$select.selected.name}}</match>
    <choices repeat="user in users | propsFilter: {name: $select.search, id: $select.search}">
    <div ng-bind-html="user.name | highlight: $select.search"></div>
      <small>
      </small>
    </choices>
  </ui-select> -->

  <h3>Select Project</h3>  <ui-select name="idProjectJO" ng-model="project.selected" theme="projects" ng-disabled="disabled" style="width: 300px;">
    <match placeholder="Select or search a country in the list...">{{$select.selected.name}}</match>
    <choices repeat="project in projects | filter: $select.search">
      <span ng-bind-html="project.name | highlight: $select.search"></span>
      <small ng-bind-html="project.code | highlight: $select.search"></small>
    </choices>
  </ui-select>

  <h3>User for the Project</h3>  <ui-select name="idProjectJO" ng-model="user.selected" theme="selectize" ng-disabled="disabled" style="width: 300px;">
    <match name="idUsernmaeJO" placeholder="Select or search a country in the list...">{{$select.selected.name}}</match>
    <choices name="idUsernmaeJO" repeat="user in users | filter: $select.search">
      <span name="idUsernmaeJO" ng-bind-html="user.name | highlight: $select.search"></span>
      <small ng-bind-html="user.code | highlight: $select.search"></small>
    </choices>
  </ui-select>
</div>
<!-- </html> -->
