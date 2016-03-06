angular.module('crud.add', [])

.controller('ctrlAdd', function($scope,$http,$routeParams,$window,genders,countries,skills){
  $scope.objuser = {};

  $scope.genders    = genders.all();   
  $scope.countries  = countries.all();   
  $scope.skills = skills.all(); 
    
  setTimeout(function(){
    // Initialize semantic ui dropdown ui
    $('.ui.dropdown').dropdown();
  },1);

  // Submit form 
  $('form').submit(function(event) {

    $http({
      method  : 'POST',
      url     : "API/users/add",
      data    : $scope.objuser, //forms user object
      headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
    })
    .success(function(response) {
      if(response.success){
        $scope.msgtitle = "Success!";
        $scope.msgtext  = response.msg;
        $window.location.href = '#/home';
      }else{
        $scope.msgtitle = "Error!";
        $scope.msgtext  = response.msg;
      }
    })
  });

  // On cancel button press go back
  $(".cancel").click(function(){
    window.history.back();
  })
    
});