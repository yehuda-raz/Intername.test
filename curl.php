<?php


include '_init.php'; 



function getData($url){
	//  Initiate curl
	$ch = curl_init();
	// Will return the response, if false it print the response
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// Set the url
	curl_setopt($ch, CURLOPT_URL,$url);
	// Execute
	$result=curl_exec($ch);
	// Closing
	curl_close($ch);

	return json_decode($result, true);

}



$users_json = getData('https://jsonplaceholder.typicode.com/users');
$posts_json = getData('https://jsonplaceholder.typicode.com/posts');



$users_data =[];
foreach ($users_json as $users => $user) {
	$sanitize = [
		'id' =>$user['id'],
		'name' =>$user['name'],
		'email' =>$user['email'],
	];
	array_push($users_data, $sanitize);
}



$userCtrl = new User();
foreach ($users_data as $users => $user) {
	echo  $user['id'] .' '.$user['name'] .' '. $user['email'].'<br> ';
	$ans = $userCtrl->create($user['name'],$user['email'] ,$user['id']);
	echo  $ans;
	echo "<br></br>";
}



$postCtrl = new Post();
foreach ($posts_json as $posts => $post) {

	echo  $post['id'] .' '.$post['userId'] .' '. $post['title'].' '. $post['body'].'<br> ';
	$ans = $postCtrl->create($post['userId'],$post['title'],$post['body'],$post['id']);
	echo  $ans;
	echo "<br></br>";
}



?>




