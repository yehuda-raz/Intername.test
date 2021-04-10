<?php

include './_init.php'; 




 class FormException extends Exception {
	public $field;
	public function __construct( $errors = "", $message = "", $code = 0, Throwable $previous = null ) {
		parent::__construct( $message, $code, $previous );
		$this->errors = $errors;
	}
}


class InternamePostController {

	public function __construct() {

	}


	public function submitPost($name, $email, $title, $body) {
		$errors = $this->validateForm($name, $email, $title, $body);

		// var_dump(	$errors);
		if (count($errors) > 0) {
			throw new FormException($errors);
		}



		$userCtrl = new User();
		$userID = $userCtrl->create($name,$email);

		
		if(is_numeric ($userID)){
			$postCtrl = new Post();
			$postID = $postCtrl->create($userID, $title ,$body);
		}
 		
		
		
	}

	private function validateForm($name, $email, $title, $body){
        $errors = [];
        global $terms;
      
          
        if (!$this->validate($name, 'notempty')) $errors[] = ['name', sprintf($terms['text'],  'name')];
        if (!$this->validate($email, 'email')) $errors[] = ['email', $terms['email']];
        if (!$this->validate($title, 'notempty')) $errors[] = ['title', sprintf($terms['text'],  'title')];
        if (!$this->validate($body, 'notempty')) $errors[] = ['body', sprintf($terms['text'],  'body')];
       
		return $errors;
	}

	private function validate($data, $type) {
		switch ($type) {
			case 'email':
				return filter_var($data, FILTER_VALIDATE_EMAIL);
				break;
	
			case 'notempty':
				return (strlen($data) > 0);
				break;
		}
	}

}