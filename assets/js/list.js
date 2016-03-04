angular.module('crud.list', [])

.controller('ctrlList', function($scope,$http){
  // Fetch records from database

  $http({
  	method: "GET", 
  	url: "API/users", 
  }).
    then(function(response) {
      $scope.status = response.status;
      $scope.data = response.data;
    }, function(response) {
      $scope.data = response.data || "Request failed";
      $scope.status = response.status;
  });	
});