angular.module('crud.factory', [])

.factory('genders',function(){
  var genders = {"1":"Male", "2":"Female"};
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

.factory('skills',function(){
  var skills = ["PHP","Node.js","Mongodb","Ruby on Rails","Python","Perl"];
  return {
    all : function (){
      return skills;
    }
  };
});
