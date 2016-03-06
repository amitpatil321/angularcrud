<?php
// Load database configuration
require '../config.php';
// Load ORM library
// We are using idiorm
require '../libs/orm/idiorm.php';
// Load dependencies with composer
// We are using 
// 1) Respect validation
// 2) Slim framework
require '../libs/vendor/autoload.php';
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


/*** Respect validation config ***/
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;
// Set validation rules in global variable
global $validator;
$validator  = v::key('fullname', v::stringType()->notEmpty())
            ->key('email', v::notEmpty()->email())
            ->key('country', v::stringType()->notEmpty())
            ->key('address', v::stringType()->notEmpty())
            ->key('skills', v::notEmpty())
            ->key('gender', v::notEmpty());

 
$app->get('/', function() use($app) {
    $app->response->setStatus(200);
    echo "Welcome to CRUD API";
}); 

// Get list of all users
$app->get('/users', function() use($app) {
	// Set headers to json with response code 200
	$app->response->headers->set('Content-Type', 'application/json');
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

// Get single users info
$app->get('/users/:id', function($id) use($app) {
	// Set headers to json with response code 200
	$app->response->headers->set('Content-Type', 'application/json');
	$app->response->setStatus(200);

	$arr = array();
	$users = ORM::for_table('users')->find_one($id);
	if($users)
		echo json_encode($users->as_array());
	else
		echo json_encode(array("success" => 0,"msg" => "User not found"));
});

// Add new user
$app->post('/users/add', function () use ($app) {
	global $validator;

	// Set headers to json with response code 200
	$app->response->headers->set('Content-Type', 'application/json');
	$app->response->setStatus(200);
	
	// Get form post data
	$request   = $app->request();
	$body      = $request->getBody();
	$input     = json_decode($body); 
	// Convert skills array to comma seperated string
	if(is_array($input->skills))
		$input->skills = implode(",",$input->skills);

	// Convert POST object as array for validation test
	$input_arr = json_decode($body, true);

    // Check for validation errors
    $errors = array();
    try{
        $validator->assert($input_arr);

        // Insert record to database
		$results = ORM::for_table('users')->create();
		if($results){
			$results->id  		= '';
			$results->fullname  = $input->fullname;
			$results->email     = $input->email;
			$results->country   = $input->country;
			$results->gender    = $input->gender;
			$results->skills 	= $input->skills;
			$results->address   = $input->address;
			if($results->save())
				echo json_encode(array("success" => 1,"msg" => "User added"));
			else
				echo json_encode(array("success" => 0,"msg" => "Query failed"));
		}else
			echo json_encode(array("success" => 0,"msg" => "Query failed"));

    } catch (\InvalidArgumentException $e) {   	
		echo json_encode(array("success" => 0, "msg" => $e->getMessages()));
    }
}); 

// Update user info
$app->post('/users/update', function () use ($app) {    
	global $validator;

	// Set headers to json with response code 200
	$app->response->headers->set('Content-Type', 'application/json');
	$app->response->setStatus(200);

	// Get form post data
	$request   = $app->request();
	$body      = $request->getBody();
	$input     = json_decode($body); 
	// Convert skills array to comma seperated string
	if(is_array($input->skills))
		$input->skills = implode(",",$input->skills);

	// Convert POST object as array for validation test
	$input_arr = json_decode($body, true);

    try{
    	// Validate input data
        $validator->assert($input_arr);

        // Update record
		$results = ORM::for_table('users')->find_one($input->id);
		if($results){
			$results->fullname  = $input->fullname;
			$results->email     = $input->email;
			$results->country   = $input->country;
			$results->gender    = $input->gender;
			$results->skills 	= $input->skills;
			$results->address   = $input->address;
			if($results->save())
				echo json_encode(array("success" => 1,"msg" => "User information updated"));
			else
				echo json_encode(array("success" => 0,"msg" => "Query failed"));
		}else
			echo json_encode(array("success" => 0,"msg" => "Query failed"));
	}catch (\InvalidArgumentException $e) {   	
		echo json_encode(array("success" => 0, "msg" => $e->getMessages()));
    }
}); 

/* Delete user from database*/

$app->post('/users/delete', function () use ($app) {
	// Set headers to json with response code 200
	$app->response->headers->set('Content-Type', 'application/json');
	$app->response->setStatus(200);

	// Get form post data
	$request   = $app->request();
	$body      = $request->getBody();
	$input     = json_decode($body); 
	$user 	   = ORM::for_table('users')->find_one($input->id);
	if($user){
		if($user->delete())
			echo json_encode(array("success" => 1, "msg" => "User deleted"));
		else
			echo json_encode(array("success" => 0, "msg" => "Operation failed"));		
	}else	
		echo json_encode(array("success" => 0, "msg" => "User not found"));		
});

$app->run();







