<?php
session_start();
	if(isset($_POST['register'])){

        require_once "../../config/connection.php";
        require_once "functions.php";

        $name = $_POST['namesurname'];
        $username = $_POST['username'];
		$email = $_POST['email'];
        $password = $_POST['password'];

        $file_name = $_FILES['photo']['name'];
        $file_tmp = $_FILES['photo']['tmp_name'];
        $file_type = $_FILES['photo']['type'];
        $file_size = $_FILES['photo']['size'];
    
        
		if(isset($_SESSION['user'])){
            if($_SESSION['user']->role_id=="1"){
                $type=$_POST['roleid'];
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

		if(!preg_match($regPassword, $password)){
			$errors[] = "Password is invalid";
        }

        if($_FILES['photo']['size'] == 0){
            $pic=1;
        } else{

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
            header("Location: ../../index.php?page=register");
		} else {
            $password = md5($password);

            $result_1 = $conn->prepare("SELECT * FROM users WHERE email = ?");
            $result_1->execute([$email]);
            $result_2 = $conn->prepare("SELECT * FROM users WHERE username = ?");
            $result_2->execute([$username]);
            $r1 = $result_1->fetch();
            $r2 = $result_2->fetch();

			if($r1 != null || $r2 != null) {
                $errors[] = "That user already exists";
                $_SESSION['error']=$errors;
                header("Location: ../../index.php?page=register");
			} else {

                if($_FILES['photo']['size'] == 0){
                    $pic=1;
                }else{

                if(move_uploaded_file($file_tmp, '../../'.$pathcurrentPhoto)){
                    $errors[] = "Photo is Uploaded";
                    $_SESSION['error']=$errors;
                    header("Location: ../../index.php?page=register");
        
                    try {
                        $isInserted = insertt($pathcurrentPhoto, $pathnewPhoto);
        
                        if($isInserted){
                            $errors[] = "Photo path is Uploaded";
                            $_SESSION['error']=$errors;
                            header("Location: ../../index.php?page=register");
                        }
                        
                    } catch(PDOException $ex){
                        echo $ex->getMessage();
                    }
                }
                
                $pic=$conn->lastInsertId();

                imagedestroy($currentPhoto);
                imagedestroy($newPhoto);

                }
				$result = $conn->prepare("INSERT INTO users VALUES('',?, ?, ?, ?, ?,?)");
				$result->bindParam("1", $name);
				$result->bindParam("2", $username);
				$result->bindParam("3", $email);
                $result->bindParam("4", $password);
                $result->bindParam("5", $pic);
				$result->bindParam("6", $type);

				$done = $result->execute();
				var_dump($done);
				if($done){
					$errors[] = "User added";
                    $_SESSION['error']=$errors;
					header("Location: ../../index.php?page=register");
				} else {
					$_SESSION['error']="error";
			        header("Location: ../../index.php?page=register");
				}
			}

		}
	}
?>