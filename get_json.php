<?php 


include '_init.php'; 

$data = new \stdClass();
$data->status = "Invalid params";


function initialize_data($result ,$data){
	if(is_null($result) ){	
		return;
	}

	$resultArray=[];
	while ($row = $result -> fetch_assoc()) {
		array_push($resultArray,$row);
	}

	$data->status ="ok";
	$data->data =$resultArray;
}




if(isset($_GET['post_id'])):

	$postCtrl = new Post();
 	$result = $postCtrl->searchById($_GET['post_id']);
 	initialize_data($result ,$data );
 	
endif;





if(isset($_GET['user_id'])):

	$postCtrl = new Post();
	$result =$postCtrl->searchByUserId($_GET['user_id']);
	initialize_data($result ,$data );

endif;


if(isset($_GET['content'])):

	$postCtrl = new Post();
	$result =$postCtrl->searchByContent($_GET['content']);
	initialize_data($result ,$data );

	
endif;



$json = json_encode($data);
if ($json === false) {
    // Avoid echo of empty string (which is invalid JSON), and
    // JSONify the error message instead:
    $json = json_encode(["jsonError" => json_last_error_msg()]);
    if ($json === false) {
        // This should not happen, but we go all the way now:
        $json = '{"jsonError":"unknown"}';
    }
    // Set HTTP response status code to: 500 - Internal Server Error
    http_response_code(500);
}
echo $json;
