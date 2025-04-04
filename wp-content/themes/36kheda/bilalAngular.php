<?php
/*
Template Name: Angular Filter

*/
get_header();
?>

<div ng-app="bilalHssn" ng-controller="bilalsCtrl">
<p><input id="txtbilalis" type="text" ng-model="testing" placeholder="type here"></p>
<ul id="customDataB">
  <li ng-hide="true" ng-repeat="x in names | filter:testing">
    <a href="{{ x.link }}">{{ x.name }}</a>
  </li>
</ul>

</div>

<script type="text/javascript">
	
	angular.module('bilalHssn', []).controller('bilalsCtrl', function($scope, $http) {
    $http.get("http://36kheda.com/wp-json/wp/v2/categories")
   .then(function (response) {
   	//$scope.names = response.data;
   	console.log(response)
   	})
});


</script>

<?
get_footer();
?>