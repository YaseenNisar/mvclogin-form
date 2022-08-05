<?php
sessiom_start();
$conn=new mysqli('localhost', 'root', '','');
if($conn->connect_errno){
	echo json_encode(['status'=>$conn->connect_error]);
	exit();
}

function register($name, $email, $password){
global $conn;
$verificatoion_code=generate_code();

$stmt = $conn->prepare("insert into users (name, email, password, verification_code) value(?, ?, ?, ?)");
$stmt->bind_param('ssss',$name, $email, $password, $verification_code);
$stmt->execute();
if($stmt->affected_rows>0)
$status=$verification_code;
else
$status= -1;
$stmt->close();
return $status;
}

function login($name, $password){
	global $conn;

	$stmt = $conn->prepare("select verification_status from users where name=? and password=?");
$stmt->bind_param('ss',$name, $password);
$stmt->execute();
$result=$stmt->get_result();
$stmmt->close();
if($result->num_rowss===1){
	$status=$result->fetch_assoc();

	//if user is regoster as well as verified
	if($status['verification_status']===1){
		$_SESSION['logged_user']-$name;
		return 1;
	}
	//if user is regoster but not verified
	else
		return 0;;
}
//if user is not registered
else 
return -1;
}

function verify($verification_code){
	global $conn;

	$stmt = $conn->prepare("update users set verification_status=1 where verificatoion_code=?");
$stmt->bind_param('s', $verification_code);
$stmt->execute();
if($stmt->affected_rows>1)
	$status =1;
	else 
		$status =0;
	$stmt->close();
	return $status;

}

//verification code generation function
function generate_code(){
	return bin2hex(openssl_random_pseudo_bytes(20));

}

function sendMail($email, $verification_code){
	
}




?>