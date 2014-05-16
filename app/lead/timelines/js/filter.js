var timelineApp = angular.module("timelineFilter", ['infinite-scroll']);
timelineApp.controller("timelineCtrl", function($scope) {
  Object.defineProperty($scope, "queryFilter", {
      get: function() {
          var out = {};
          out[$scope.queryBy || "$"] = $scope.query;
          return out;
      }
  });


  $scope.timelines = [{
      "book": "Nissan",
      "autor": "Robin Dixon",
      "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.",
      "image": "img/js-3rd.jpg"
  }, {
      "book": "Godaddy",
      "autor": "Ian Pouncey and Richard York",
      "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.",
      "image": "img/css.jpg"
  }, {
      "book": "Citi",
      "autor": "Robin Dixon",
      "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.",
      "image": "img/php.jpg"
  }, {
      "book": "Citi Mortgage",
      "autor": "Eric Rowell",
      "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.",
      "image": "img/html5.jpg"
  }, {
      "book": "Jerry Site",
      "autor": "Krishna Shasankar V",
      "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.",
      "image": "img/zend.jpg"
  }, {
      "book": "Anansi",
      "autor": "Lou Franco, Eitan Mendelowitz",
      "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.",
      "image": "img/hello-ios.jpg"
  }, {
      "book": "HP",
      "autor": "Addy Osmani",
      "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.",
      "image": "img/backbone.jpg"
  },  {
      "book": "Mine",
      "autor": "Addy Osmani",
      "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.",
      "image": "img/backbone.jpg"
  },  {
      "book": "Toshiba",
      "autor": "Addy Osmani",
      "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.",
      "image": "img/backbone.jpg"
  },  {
      "book": "Joya",
      "autor": "Addy Osmani",
      "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.",
      "image": "img/backbone.jpg"
  },  {
      "book": "Domain",
      "autor": "Addy Osmani",
      "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.",
      "image": "img/backbone.jpg"
  },  {
      "book": "Christmas",
      "autor": "Addy Osmani",
      "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.",
      "image": "img/backbone.jpg"
  }, {
      "book": "Postmorten App",
      "autor": "Don Nguyen",
      "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.",
      "image": "img/start-nodejs.jpg"
  }];





});





