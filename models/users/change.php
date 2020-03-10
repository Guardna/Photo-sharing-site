<?php
session_start();
	if(isset($_POST['register'])){

        require_once "../../config/connection.php";
        require_once "functions.php";

        $name = $_POST['namesurname'];
        $username = $_POST['username'];
		$email = $_POST['email'];
        $password = $_POST['password'];
        $picid=$_POST['id'];

        $file_name = $_FILES['photo']['name'];
        $file_tmp = $_FILES['photo']['tmp_name'];
        $file_type = $_FILES['photo']['type'];
        $file_size = $_FILES['photo']['size'];
    
        if(isset($_SESSION['user'])){
            if($_SESSION['user']->role_id=="1"){
                $type=$_POST['roleid'];
            }else{
                $type = 2;
            }
        }else{
            $type = 2;
        }
        
		

        $regName = "/^[A-Z]{1}[a-z]{2,9}(\s[A-Z]{1}[a-z]{2,9})+$/";
        $regEmail = "/^[a-z0-9]+(\.[a-z0-9]+)*\@[a-z]+(\.[a-z]+)+$/";
        $regUser = "/^[A-Z]{1}[a-z0-9]{2,9}$/";
        $regPassword = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/";
        $oktype = ['image/jpg', 'image/jpeg', 'image/png'];

		$errors = [];

		if(!preg_match($regName, $name)){
			$errors[] = "Name and Surname is invalid";
		}

		if(!preg_match($regUser, $username)){
			$errors[] = "Username is invalid";
        }
        
		if(!preg_match($regEmail, $email)){
			$errors[] = "Email is invalid";
		}
        if(strlen($password)<32){
		if(!preg_match($regPassword, $password)){
			$errors[] = "Password is invalid";
        }
        }
        if($_FILES['photo']['size'] != 0){

        if(!in_array($file_type, $oktype)){
            $errors[] = "Photo type is invalid";
        }
        if($file_size > 3000000){
            $errors[] = "Max photo size is 3mb";
        }

        list($width, $height) = getimagesize($file_tmp);

        $currentPhoto = null;
        switch($file_type){
            case 'image/jpg':
                $currentPhoto = imagecreatefromjpg($file_tmp);
                break;
            case 'image/jpeg':
                $currentPhoto = imagecreatefromjpeg($file_tmp);
                break;
            case 'image/png':
                $currentPhoto = imagecreatefrompng($file_tmp);
                break;
        }

        $newWidth = 128;
        $newHeight = ($newWidth/$width) * $height;

        $newPhoto = imagecreatetruecolor($newWidth, $newHeight);

        imagecopyresampled($newPhoto, $currentPhoto, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        $pname = time().$file_name;
        $pathnewPhoto = 'assets/images/users/new_'.$pname;

        switch($file_type){
            case 'image/jpg':
                imagejpg($newPhoto, '../../'.$pathnewPhoto, 75);
                break;
            case 'image/jpeg':
                imagejpeg($newPhoto, '../../'.$pathnewPhoto, 75);
                break;
            case 'image/png':
                imagepng($newPhoto, '../../'.$pathnewPhoto);
                break;
        }

        $pathcurrentPhoto = 'assets/images/users/'.$pname;
    
        }

        if(count($errors)>0){
            $_SESSION['error']=$errors;
            header("Location: ../../index.php?page=register&id=$picid");
		} else {

            if(strlen($password)<32){
                $password = md5($password);
            }

                if($_FILES['photo']['size'] == 0){
                    $pic=getOneUser($picid)->pic_id;  
                }else{

                $pic=getOneUser($picid)->pic_id;    

                if(move_uploaded_file($file_tmp, '../../'.$pathcurrentPhoto)){
                    $errors[] = "Photo is Updated";
                    $_SESSION['error']=$errors;
                    header("Location: ../../index.php?page=register");
        
                    try {
                        $isInserted = updatett($pathcurrentPhoto, $pathnewPhoto,$pic);
        
                        if($isInserted){
                            $errors[] = "Photo path is Updated";
                            $_SESSION['error']=$errors;
                            header("Location: ../../index.php?page=register");
                        }
                        
                    } catch(PDOException $ex){
                        echo $ex->getMessage();
                    }
                }
                

                imagedestroy($currentPhoto);
                imagedestroy($newPhoto);

                }
				$result = $conn->prepare("UPDATE users SET uname=?,username=?,email=?,pass=?,pic_id=?,role_id=? WHERE id=?");
				$result->bindParam("1", $name);
				$result->bindParam("2", $username);
				$result->bindParam("3", $email);
                $result->bindParam("4", $password);
                $result->bindParam("5", $pic);
                $result->bindParam("6", $type);
                $result->bindParam("7", $picid);

				$done = $result->execute();
				var_dump($done);
				if($done){
					$errors[] = "User updated";
                    $_SESSION['error']=$errors;
					header("Location: ../../index.php?page=register");
				} else {
					$_SESSION['error']="error";
			        header("Location: ../../index.php?page=register");
				}

		}
	}
?>