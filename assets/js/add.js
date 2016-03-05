angular.module('crud.add', [])

.controller('ctrlAdd', function($scope,$http,$routeParams,$window,genders,countries,interests,helper){
  $scope.objuser = {};

  $scope.genders    = genders.all();   
  $scope.countries  = countries.all();   
  $scope.uinterests = interests.all(); 
    
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
        $(".ui.form").prepend(helper.msgsuccess('User updated!'));
        $window.location.href = '#/home';
      }else
        $(".ui.form").prepend(helper.msgerr('Unexpected error'));
    })
    .error(function(){

    });
  });

  // On cancel button press go back
  $(".cancel").click(function(){
    window.history.back();
  })
    
});