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

 // Get raw posted data
	$data = json_decode(file_get_contents("php://input"));

	echo $data;


	//set ID to delete
	// $post->id = $data->data->id;
	// echo json_encode($data);

	//delete post
	// if($post->delete()){
	// 	echo json_encode(
	// 		array('message' => 'Post Deleted')
	// 	);
	// }else{
	// 	echo json_encode(
	// 		array('message' => 'There was an error creating the post')
	// 	);
	// }

 ?>