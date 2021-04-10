<?php

class User   {

    private $dao;
    private $mysqli;

    public function __construct(){
        $this->dao = MySQL_dbCON::getInstance();
        $this->mysqli = $this->dao->connection;

    }
	
    
    public function create( $name, $email,$id =null){
    

        $exists_user_id=$this->getUserId($email);
        if($exists_user_id){
            return $exists_user_id['id'];
        }

        $id ? $query = "INSERT INTO users (id,name, email) VALUES ('$id', '$name', '$email')" : $query = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
       
        if($this->mysqli->query($query)) {
            return $this->mysqli->insert_id;
        } else {
            return $error =  'Problem DB:'.$this->mysqli->error;
        }

    } 

    private function getUserId($email){
        $query = "SELECT id FROM users WHERE email = ". $email ;
   
        if($this->mysqli->query($query)) { 
            return $this->mysqli->query($query)-> fetch_assoc();
        }
        
    }

    
    
}

?>


