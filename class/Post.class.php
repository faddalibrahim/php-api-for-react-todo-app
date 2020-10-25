<?php 

	/**
	 * 
	 */
	class Post{
		//DB Stuff
		private $conn;
		private $table = 'posts';

		//Post properties
		public $id;
		public $title;
		public $body;
		public $author;
		public $is_published;

		//constructor
		public function __construct($db){
			$this->conn = $db;
		}

		//GET posts
		public function read(){
			$sql = "SELECT * FROM .$this->table ORDER BY created_at ASC";

			$stmt = $this->conn->prepare($sql);

			$stmt->execute();

			return $stmt;
		}

		public function read_single(){
			// $sql = 'SELECT * FROM '.$this->table.' WHERE id = ?';
			$sql = "SELECT * FROM $this->table WHERE id = ?";
			// $sql = "SELECT * FROM $this->table WHERE id = :id";

			$stmt = $this->conn->prepare($sql);

			//bind ID
			$stmt->bindParam(1, $this->id);
			// $stmt->bindParam(':id', $this->id);

			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			if($row){
				//SET PROPERTIES
				$this->title = $row['title'];
				$this->body = $row['body'];
				$this->author = $row['author'];
				$this->is_published = $row['is_published'];
			}else{
				die("no such field exists");
			}

		}

		public function delete(){
			$sql = "DELETE FROM $this->table WHERE id = ?";
			$stmt =  $this->conn->prepare($sql);

			//clean data
			$this->id = htmlspecialchars(strip_tags($this->id));

			//bind ID
			$stmt->bindParam(1, $this->id);

			//execute query
			if($stmt->execute()){
				return true;
			}

			//print error if something goes wrong
			echo "Error: $stmt->error";
			return false;
		}

		public function create(){
			$sql = "INSERT INTO $this->table(body) VALUES(:body)";
			$stmt = $this->conn->prepare($sql);

			//clean data
			$this->body = htmlspecialchars(strip_tags($this->body));

			//bind data
			$stmt->bindParam(':body', $this->body);

			//execute query
			if($stmt->execute()){
				return true;
			}

			//print error if something goes wrong
			echo "Error: $stmt->error";
			return false;
		}

		public function update(){
			$sql = "UPDATE $this->table SET body = :body WHERE id = :id";
			$stmt = $this->conn->prepare($sql);

			//clean data
			$this->body = htmlspecialchars(strip_tags($this->body));
			$this->id = htmlspecialchars(strip_tags($this->id));

			//bind data
			$stmt->bindParam(':body', $this->body);
			$stmt->bindParam(':id', $this->id);

			//execute query
			if($stmt->execute()){
				return true;
			}

			//print error if something goes wrong
			echo "Error: $stmt->error";
			return false;
		}
		
	}

 ?>