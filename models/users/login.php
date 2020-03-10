<?php
session_start();
if(isset($_POST['login'])){
    require_once "../../config/connection.php";

	$email = $_POST['email'];
    $password = $_POST['password'];
	
	$errors=[];
	$regEmail = "/^[a-z0-9]+(\.[a-z0-9]+)*\@[a-z]+(\.[a-z]+)+$/";
	$regPassword = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/";
	
	if(!preg_match($regEmail,$email)){
		$errors[]="Email invalid";
	}
	if(!preg_match($regPassword,$password)){
		$errors[]="Password invalid";
	}
	if(count($errors)>0){
        $_SESSION['error']=$errors;
        header("Location: ../../index.php?page=login");
	}else{		
		if(strlen($password)<32){
			$password = md5($password);
		}
		$stmt=$conn->prepare("SELECT *, u.id AS useid FROM users u INNER JOIN roles r ON u.role_id=r.id INNER JOIN userphoto up ON u.pic_id=up.id WHERE email=? AND pass=?");
		$stmt->bindParam("1",$email);
		$stmt->bindParam("2",$password);
		
		$stmt->execute();
		$user=$stmt->fetch();

		if($user){
			$_SESSION['user']=$user;
			header("Location: ../../index.php?page=home");
		}else{
			$errors[]="Wrong email or password";
			$_SESSION['error']=$errors;
			header("Location: ../../index.php?page=login");
		}
	}
}
if(isset($_POST['recover'])){
    require_once "../../config/connection.php";

	$email = $_POST['email'];
	
	$errors=[];
	$regEmail = "/^[a-z0-9]+(\.[a-z0-9]+)*\@[a-z]+(\.[a-z]+)+$/";
	
	if(!preg_match($regEmail,$email)){
		$errors[]="Email invalid";
	}

	if(count($errors)>0){
        $_SESSION['error']=$errors;
        header("Location: ../../index.php?page=login");
	}else{		
		$stmt=$conn->prepare("SELECT * FROM users WHERE email=?");
		$stmt->bindParam("1",$email);
		
		$stmt->execute();
		$user=$stmt->fetch();
		if($user){
		
		$password=$user->pass;

		$subject = "Your Recovered Password";
 
		$message = "Please use this password to login " . $password;
		$headers = "From : admin@gmail.com";

		if(mail($email, $subject, $message, $headers)){
			$errors[]="Your Password has been sent to your email id";
			$_SESSION['error']=$errors;
			header("Location: ../../index.php?page=login");
		}else{
			$errors[]="Failed to Recover your password, try again";
			$_SESSION['error']=$errors;
			header("Location: ../../index.php?page=login");
		}
		}else{
			$errors[]="That email isn't registered on our site!";
			$_SESSION['error']=$errors;
			header("Location: ../../index.php?page=login");
		}
	}
}