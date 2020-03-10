<?php
session_start();
	if(isset($_POST['add'])){

        require_once "../../config/connection.php";
        require_once "functions.php";

        $title = $_POST['title'];
        $desc = $_POST['desc'];

        $file_name = $_FILES['photo']['name'];
        $file_tmp = $_FILES['photo']['tmp_name'];
        $file_type = $_FILES['photo']['type'];
        $file_size = $_FILES['photo']['size'];
    
        $date = date('d-m-Y H:i:s');

        $regTitle = "/^[A-Za-z\s?]+$/";
        $oktype = ['image/jpg', 'image/jpeg', 'image/png'];

		$errors = [];

        if(isset($_SESSION['user'])){
        
        $userid=$_SESSION['user']->useid;

        }else{
            $errors[] = "No user logged in";
        }

		if(!preg_match($regTitle, $title)){
			$errors[] = "Title name is invalid";
		}
        if($_FILES['photo']['size'] == 0){
            $errors[] = "No Photo selected";
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

        $newWidth = 300;
        $newHeight = 200;
        if($width<$newWidth){
            $newWidth=$width;
        }
        if($height<$newHeight){
            $newHeight=$height;
        }
        
        
        $medWidth = 1000;
        if($width<$medWidth){
            $medWidth=$width;
        }
        $medHeight = ($medWidth/$width) * $height;

        $newPhoto = imagecreatetruecolor($newWidth, $newHeight);
        $medPhoto = imagecreatetruecolor($medWidth, $medHeight);

        imagecopyresampled($newPhoto, $currentPhoto, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        imagecopyresampled($medPhoto, $currentPhoto, 0, 0, 0, 0, $medWidth, $medHeight, $width, $height);

        $pname = time().$file_name;

        $pathnewPhoto = 'assets/images/posts/new_'.$pname;
        $pathmedPhoto = 'assets/images/posts/med_'.$pname;

        switch($file_type){
            case 'image/jpg':
                imagejpg($newPhoto, '../../'.$pathnewPhoto, 75);
                imagejpg($medPhoto, '../../'.$pathmedPhoto, 75);
                break;
            case 'image/jpeg':
                imagejpeg($newPhoto, '../../'.$pathnewPhoto, 75);
                imagejpeg($medPhoto, '../../'.$pathmedPhoto, 75);
                break;
            case 'image/png':
                imagepng($newPhoto, '../../'.$pathnewPhoto, 75);
                imagepng($medPhoto, '../../'.$pathmedPhoto, 75);
                break;
        }

        $pathcurrentPhoto = 'assets/images/posts/'.$pname;
    
        }

        if(count($errors)>0){
            $_SESSION['error']=$errors;
            header("Location: ../../index.php?page=insert");
		} else {
                if($_FILES['photo']['size'] == 0){
                    $errors[] = "No Photo selected";
                }else{

                if(move_uploaded_file($file_tmp, '../../'.$pathcurrentPhoto)){
                    echo "Photo is uploaded";
        
                    try {
                        $isInserted = insert($pathcurrentPhoto, $pathnewPhoto, $pathmedPhoto);
        
                        if($isInserted){
                            echo "Path to photo is uploaded";
                        }
                        
                    } catch(PDOException $ex){
                        echo $ex->getMessage();
                    }
                }
                
                $pic=$conn->lastInsertId();

                imagedestroy($currentPhoto);
                imagedestroy($newPhoto);
                imagedestroy($medPhoto);

                }
				$result = $conn->prepare("INSERT INTO posts VALUES('',?, ?, ?, ?, ?)");
				$result->bindParam("1", $title);
				$result->bindParam("2", $desc);
                $result->bindParam("3", $date);
                $result->bindParam("4", $pic);
                $result->bindParam("5", $userid);

				$done = $result->execute();
				var_dump($done);
				if($done){
					echo "User added";
					header("Location: ../../index.php?page=home");
				} else {
					$_SESSION['error']="error";
			        header("Location: ../../index.php?page=insert");
				}

		}
	}
?>