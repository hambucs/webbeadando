<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['email']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$email = validate($_POST['email']);
	$pass = validate($_POST['password']);

	if (empty($email)) {
		$response = array('status' => 'error', 'message' => 'Email or password is incorrect');
		echo json_encode($response);
	    exit();
	}else if(empty($pass)){
        $response = array('status' => 'error', 'message' => 'Password is requied');
		echo json_encode($response);
	    exit();
	}else{
		$sql = "SELECT * FROM registration WHERE email='$email' AND password='$pass'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['email'] === $email && $row['password'] === $pass) {
				$_SESSION['email'] = $row['email'];
				$response = array('status' => 'success');
				echo json_encode($response);
            }else{
				$response = array('status' => 'error', 'message' => 'Email or password is incorrect');
				echo json_encode($response);
			}
		}else{
			$response = array('status' => 'error', 'message' => 'Email or password is incorrect');
			echo json_encode($response);
		}
	}
	
}else{
	header("Location: Fotoshoot.php");
	exit();
}