angular.module('crud.list', [])

.controller('ctrlList', function($scope,$http, $window){
  // Fetch records from database
  $http({
  	method: "GET", 
  	url: "API/users", 
  }).
    then(function(response) {
      $scope.data = response.data;
    }, function(response) {
      $scope.data = response.data || "Request failed";
  });

  $scope.delete = function(id){
    // Show confirm modal 
    $('.ui.modal')
      .modal({
        closable  : false,
        blurring: true,
        onDeny    : function(){
          return true;
        },
        onApprove : function() {
          $http({
            method  : 'POST',
            url     : "API/users/delete",
            data    : JSON.stringify({"id":id}),
            headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
          })
          .success(function(response) {
            if(response.success){
              $scope.msgtitle = "Success!";
              $scope.msgtext  = response.msg;
              // Remove row from table
              angular.element(document.querySelector('tr[id="'+id+'"]')).remove();
            }else{
              $scope.msgtitle = "Error!";
              $scope.error    = response.msg;
            }            
          });
          return true;
        }
      })
      .modal('show');

    }
});