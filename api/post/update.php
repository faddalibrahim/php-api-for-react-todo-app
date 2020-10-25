<?php 

	//headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: PUT');
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

	//set ID to update and data to replace with
	$post->id = $data->idToUpdate;
	$post->body = $data->newContent;

	//create post
	if($post->update()){
		echo json_encode(
			array('message' => 'Post Updated')
		);
	}else{
		echo json_encode(
			array('message' => 'There was an error updating the post')
		);
	}
 ?>