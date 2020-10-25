<?php 

	//headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: POST');
	header('Allow-Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

	include_once '../../config/Database.php';
	include_once '../../class/Post.class.php';

	//instantiate DB and Connection
	$database = new Database();
	$db = $database->connect();

	// Instantiate post object
	$post = new Post($db);

	 // Get raw posted data
	$data = json_decode(file_get_contents("php://input"));

	// print_r(json_encode($data->content)); return;

	$post->body = $data->content;

	//create post
	if($post->create()){
		echo json_encode(
			array('message' => 'Post Created')
		);
	}else{
		echo json_encode(
			array('message' => 'There was an error creating the post')
		);
	}
 ?>