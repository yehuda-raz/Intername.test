<?php



class Post  {

  	private $dao;
    private $mysqli;


    public function __construct(){
        $this->dao = MySQL_dbCON::getInstance();
        $this->mysqli = $this->dao->connection;

    }
	

	 public function create( $user_id, $title ,$body,$id=null){

		  $id ? $query = "INSERT INTO posts (id,user_id ,title, body) VALUES ('$id', '$user_id', '$title' ,'$body')" : $query = "INSERT INTO posts (user_id ,title, body) VALUES ('$user_id', '$title' ,'$body')";
       
      if($this->mysqli->query($query)) {
            return $this->mysqli->insert_id;
      } else {
            return $error =  'Problem DB:'.$this->mysqli->error;
      }

    } 

    public function searchByUserId($user_id){
        $query = "SELECT * FROM posts WHERE user_id = ".$user_id;
   
        if($this->mysqli->query($query)) {
            return $this->mysqli->query($query);
        }
       
    }


    public function searchById($post_id){
        $query = "SELECT * FROM posts WHERE id = ".$post_id;
   
        if($this->mysqli->query($query)) {
              return $this->mysqli->query($query);
          }
    }

    public function searchByContent($string){

      $query = "SELECT *  FROM `posts` WHERE `title` LIKE '%$string%' OR `body` LIKE '%$string%'";
        if($this->mysqli->query($query)) {
              return $this->mysqli->query($query);
        }
  

    }

}

?>
