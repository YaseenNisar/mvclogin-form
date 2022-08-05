<?php
require 'model.php';


//register request
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['register'])){
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];


//calling method (register) from model file
$verificatoion_code=register($name, $email, $password);
if($verificatoion_code===-1){
	echo jason_encode(['status'=>'Something wrong, Try again later'])
}
else{
	sendMail($email, $verification_code);
	echo json_encode(['status'=>'Welcome You have been succesfully logged in'])
}


}

//login request
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['login'])){

	
	$name = $_POST['name'];
    $password = $_POST['password'];
    $status= login($name, $password);
    if($status===1){
    	echo json_encode(['status'=>"Welcome .$name You have been succesfully logged in"]);

    }
    	elseif(status===0){ 
    				echo json_encode(['status'=>"You have not verified email yet"])
    	}
    		else{
    			echo json_encode(['status'=>"You are not registered with us"])
    		}
    		exit();
}

if($_SERVER['REQUEST_METHOD'])==='GET'{

	$code=$_GET['code'];
	$status=verify($code);
	if($status===1){
		header('Location: http://localhost:8080/showverificationStatus.html?status=verified');
	}
	else{
				header('Location: http://localhost:8080/showverificationStatus.html?status=unsuccesful');

	}
	exit();
}

}





?>