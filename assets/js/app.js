angular.module('crud', [
 'ngRoute',	
 'crud.list',
 'crud.add',
 'crud.edit',
 'crud.factory'
])

.config(function($routeProvider) {
	
	$routeProvider.when("/add",{
		templateUrl : "templates/add.html",
		controller  : "ctrlAdd"
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