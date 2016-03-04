<?php
require '../config.php';
require '../libs/orm/idiorm.php';
require '../libs/slim/vendor/autoload.php';
$app = new \Slim\Slim();

/*** idiorm configuration ***/
ORM::configure('mysql:host='.$host.';dbname='.$db);
ORM::configure('username', $dbuser);
ORM::configure('password', $dbpass);
ORM::configure('return_result_sets', true);
// Set primary key columns names
ORM::configure('logging', true);
// ORM::configure('id_column_overrides', array(
//     'events'  => 'eventid'
// ));
 
$app->get('/', function() use($app) {
    $app->response->setStatus(200);
    echo "Welcome to CRUD API";
}); 

$app->get('/users', function() use($app) {
    $app->response->setStatus(200);
    $arr = array();

    $users = ORM::for_table('users')->find_many();
	if($users){
		// Convert to array
		foreach($users as $each)
		$arr[] = $each->as_array();
	}    
    echo json_encode($arr);
});

$app->get('/users/:id', function($id) use($app) {
	$app->response->setStatus(200);
	$arr = array();
	$users = ORM::for_table('users')->find_one($id)->as_array();
	echo json_encode($users);
}); 
 

$app->run();