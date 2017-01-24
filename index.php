<?php  
error_reporting(E_ALL); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html ng-app="crud">
 <head>
  <title>CRUD with Angularjs</title>
  <!-- Angular -->
  <script type="text/javascript" src="assets/libs/angular.min.js"></script>	
  <script type="text/javascript" src="assets/libs/angular-route.js"></script>	
  <!-- Semantic ui-->
  <script type="text/javascript" src="assets/libs/jquery-1.11.1.js"></script>	
  <script type="text/javascript" src="assets/libs/Semantic/semantic.js"></script>	
  <link rel="stylesheet" type="text/css" href="assets/libs/Semantic/semantic.css">
  <!-- Custom files -->
   <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <script src="assets/js/app.js"></script>
  <script src="assets/js/list.js"></script>
  <script src="assets/js/add.js"></script>
  <script src="assets/js/edit.js"></script>
  <script src="assets/js/factory.js"></script>
 </head>
 <body>
   <h1>Users</h1>
   <div ng-view></div>
 </body>
</html>
  