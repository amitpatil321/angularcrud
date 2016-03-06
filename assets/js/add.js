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
      $scope.msgtext  = "";
      $scope.errors   = "";
      if(response.success){
        // Reset form data 
        $scope.objuser = {};
        $scope.msgtext  = response.msg;
        setTimeout(function(){          
          $window.location.href = '#/home';
        },200);
      }else{
        $scope.errors   = response.msg;
      }
    })
  });

  // On cancel button press go back
  $(".cancel").click(function(){
    window.history.back();
  })
    
});