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

//blog post query
	$result = $post->read();
	
//get row count
	$num = $result->rowCount();


//are there posts?
	if($num > 0){
		$posts_arr = array();
		$posts_arr['data'] = array();

		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			extract($row);

			$post_item = array(
				'id' => $id,
				// 'title' => $title,
				'content' => $body,
				// 'author' => $author,
				// 'is_published' => $is_published
			);

			//push to "data"
			array_push($posts_arr['data'], $post_item);
		}

		//turn to json
		echo json_encode($posts_arr); 

	}else{
		echo json_encode(
			array('empty' => 'no posts found')
		);
	}
	

?>