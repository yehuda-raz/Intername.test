<?php

include 'actionForm.php';

$string = file_get_contents('./assets/terms.json');
$terms = json_decode($string, true);


$data = [
    'name' => isset($_POST['name']) ? trim ($_POST['name']) : '',
    'email' => isset($_POST['email']) ? trim ($_POST['email']) : '',
    'title' => isset($_POST['title']) ? trim ($_POST['title']) : '',
    'body' => isset($_POST['body']) ? trim ($_POST['body']) : '',
   
];


function draw_massage($add_post_massage, $fieldName ) {
    global $add_post_massage;
    global $terms;
    if (!$add_post_massage) {
        return false;
    }
   
    $errorArr = [
    	'valid' => 'is-valid',
    	'feedback' =>'valid-feedback',
    	'msg' =>  $terms['confirmed']
    ];
    foreach ($add_post_massage as $error) {
        if ($error[0] == $fieldName) {
           		$errorArr['valid'] = 'is-invalid';
				$errorArr['feedback'] = 'invalid-feedback';
				$errorArr['msg'] = $error[1];
        }
    }

    return	$errorArr;
}

global $add_post_massage;


if( isset($_POST['name'])||isset($_POST['email'])||isset($_POST['title'])||isset($_POST['body'])){

	try { 
    		$addPost = new InternamePostController();
           	$addPost->submitPost ($data['name'], $data['email'], $data['title'],$data['body']);


          
            intername_setCookie('send' , $_POST['name']);


            $data = [
                'name' => '',
                'email' =>  '',
                'title' =>  '',
                'body' =>  '',
               
            ];
            echo("<meta http-equiv='refresh' content='1'>");
        } catch (FormException $e) {
            $add_post_massage = $e->errors;
            // $confirm_message =false;
        }



}


