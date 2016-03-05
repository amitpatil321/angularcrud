angular.module('crud.factory', [])

.factory('genders',function(){
  var genders = {"1":"Male", "0":"Female"};
  return {
    all : function (){
      return genders;
    }
  };
})

.factory('countries',function(){
  var countries = ["India","Shrilanka","US","UK","Singapore","Malaysia","Australia","Russia"];
  return {
    all : function (){
      return countries;
    }
  };
})

.factory('interests',function(){
  var interests = ["PHP","Node.js","Mongodb","Ruby on Rails","Python","Perl"];
  return {
    all : function (){
      return interests;
    }
  };
})

.factory('helper',function(){
  var interests = ["PHP","Node.js","Mongodb","Ruby on Rails","Python","Perl"];
  return {
    msgsuccess : function (msg){
      return '<div class="ui positive message"><i class="close icon"></i><div class="header">Success!</div><p>'+msg+'</p></div>';
    },    
    msgerror : function (msg){
      return '<div class="ui negative message"><i class="close icon"></i><div class="header">Error!</div><p>'+msg+'</p></div>';
    }
  };
})
