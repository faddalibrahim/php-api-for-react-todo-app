<?php 

	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: DELETE');
	header('Allow-Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

	include_once '../../config/Database.php';
	include_once '../../class/Post.class.php';

//instantiate DB and Connection
	$database = new Database();
	$db = $database->connect();

//instantiate blog post object
	$post = new Post($db);


//validating ID
	if(isset($_GET['id'])){
		if(empty($_GET['id']) or !is_numeric($_GET['id'])){
			die("invalid ID");
		}
	}else{
		die("ID not set");
	}


//get id from url
	$post->id = isset($_GET['id']) ? htmlspecialchars(strip_tags($_GET['id'])) : die();


//delete post single
	$post->delete();

//create array
	$post_arr = array(
		"success" => "item was successfully deleted"
	);

//make json
	print_r(json_encode($post_arr));

 ?>