angular.module('crud', [
 'ngRoute',	
 'crud.list',
 'crud.edit'
])

.config(function($routeProvider) {
	
	$routeProvider.when("/add",{
		templateUrl : "templates/add.html"
	});	

	$routeProvider.when("/edit/:id",{
		templateUrl : "templates/edit.html",
		controller  : "ctrlEdit"
	});	
	
	$routeProvider.otherwise({
		templateUrl : "templates/home.html",
		controller  : "ctrlList"
	});

})