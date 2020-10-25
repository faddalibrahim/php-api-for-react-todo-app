<?php 

//headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: applicatiion/json');

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


//get post single
	$post->read_single();



//create array
	$post_arr = array(
		'id' => $post->id,
		'title' => $post->title,
		'body' => $post->body,
		'author' => $post->author,
		'is_published' => $post->is_published
	);

//make json
	print_r(json_encode($post_arr));

 ?>