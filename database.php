<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['email']) && isset($_POST['password'])){

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$email = validate($_POST['email']);
	$pass = validate($_POST['password']);

	$user_data = 'email='. $email;


	if (empty($email)) {
		$response = array('status' => 'error', 'message' => 'Password is required');
		echo json_encode($response);
	    exit();
	}else if(empty($pass)){
        $response = array('status' => 'error', 'message' => 'Password is required');
		echo json_encode($response);
	    exit();
	}

	else{

	    $sql = "SELECT * FROM registration WHERE email='$email' ";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			$response = array('status' => 'error', 'message' => 'The email is taken try another');
			echo json_encode($response);
	        exit();
		}else {
           $sql2 = "INSERT INTO registration(email, password) VALUES('$email', '$pass')";
           $result2 = mysqli_query($conn, $sql2);
           if ($result2) {
				$response = array('status' => 'success', 'message' => 'Your account has been created');
				echo json_encode($response);
	         exit();
           }else {
				$response = array('status' => 'error', 'message' => 'An unknown error occurred');
				echo json_encode($response);
		        exit();
           }
		}
	}

}else{
	header("Location: Fotoshoot.php");
	exit();
}





