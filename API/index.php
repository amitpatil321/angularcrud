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

$app->post('/users/add', function () use ($app) {    
	$app->response->setStatus(200);

	// Get form post data
   	$request = $app->request();
    $body = $request->getBody();
    $input = json_decode($body); 

	$results = ORM::for_table('users')->create();
	if($results){
		$results->id  		= '';
		$results->fullname  = $input->fullname;
		$results->email     = $input->email;
		$results->country   = $input->country;
		$results->gender    = $input->gender;
		$results->interests = implode(",",$input->interests);
		$results->address   = $input->address;
		if($results->save())
			echo json_encode(array("success" => 1));
		else
			echo json_encode(array("success" => 0));
	}else
		echo json_encode(array("success" => 0));
}); 

$app->post('/users/update', function () use ($app) {    
	$app->response->setStatus(200);

	// Get form post data
   	$request = $app->request();
    $body = $request->getBody();
    $input = json_decode($body); 

	$results = ORM::for_table('users')->find_one($input->id);
	if($results){
		$results->fullname  = $input->fullname;
		$results->email     = $input->email;
		$results->country   = $input->country;
		$results->gender    = $input->gender;
		$results->interests = implode(",",$input->interests);
		$results->address   = $input->address;
		if($results->save())
			echo json_encode(array("success" => 1));
		else
			echo json_encode(array("success" => 0));
	}else
		echo json_encode(array("success" => 0));
}); 
 

$app->run();