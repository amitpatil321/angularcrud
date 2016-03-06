angular.module('crud.edit', [])

.controller('ctrlEdit', function($scope,$http,$routeParams,$window,genders,countries,skills){
  $scope.objuser = {};

  $scope.genders   = genders.all();   
  $scope.countries = countries.all();   
  $scope.skills    = skills.all(); 

  // Fetch used details from DB
  $http.get("API/users/"+$routeParams.id)
  .then(function(response){ 
    $scope.objuser = response.data; 
      
    setTimeout(function(){
      // Set users country
      $('.country').dropdown('set selected', $scope.objuser.country);
      // Set users gender
      $('.gender').dropdown('set selected', $scope.objuser.gender);
      // Set users skills
      skills = $scope.objuser.skills.split(",");
      $('.skills').dropdown('set selected', skills);
    },1);
    
    // Initialize semantic ui dropdown ui
    $('.ui.dropdown').dropdown();
  });

  // Submit form 
  $('form').submit(function(event) {

  $http({
      method  : 'POST',
      url     : "API/users/update",
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
    });
  });


  // On cancel button press go back
  $(".cancel").click(function(){
    window.history.back();
  })
    
});