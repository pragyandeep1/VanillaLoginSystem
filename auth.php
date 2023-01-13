<?php 

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json; charset=UTF-8');

$data = json_decode(file_get_contents('php://input'));

$username = '';
$password = '';

if (isset($data)) {
	$username = $data -> username;
	$password = $data -> password;
	/*$this -> username = $data*/

http_response_code(200);

if ($username && $password) {
	$json = $users -> auth($username,$password);
	if ($json) {
		echo $json;
	}
	else{
		http_response_code(400);
		echo json_encode([
			'error'		=> true,
			'message'	=> 'User account is not found.'
		]);
	}
}
else{
	echo json_encode([
		'error'		=> true,
		'message'	=> 'Information is missing.'
	]);
}

exit();
?>