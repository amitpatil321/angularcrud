angular.module('crud.edit', [])

.controller('ctrlEdit', function($scope,$http,$routeParams){
  $scope.objuser;
  $http.get("API/users/"+$routeParams.id)
  .then(function(response){ 
    $scope.objuser = response.data; 
    $('.ui.dropdown').dropdown();    
  });

});