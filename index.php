<?php
  session_start();
  require_once "config/connection.php";
  
  include "views/fixed/head.php";
  include "views/fixed/header.php";
  include "views/fixed/sidebar.php";

  if(isset($_GET['page'])){
    switch($_GET['page'])
    {
      case 'home': 
        include "views/pages/home.php";
        break;
      case 'admin':
        if(isset($_SESSION['user'])){
          if($_SESSION['user']->role_id=="1"){
            include "views/pages/admin.php";
          }else{
            include "views/pages/home.php";
          }
        }else{
          include "views/pages/home.php";
        }
        break;  
      case 'insert':
        if(isset($_SESSION['user'])){
        include "views/pages/insert_post.php";
        }else {
        include "views/pages/home.php";
        }
        break;
      case 'register': 
        include "views/pages/register.php";
        break;    
      case 'login': 
        include "views/pages/login.php";
        break;
      case 'author': 
        include "views/pages/author.php";
        break;        
      case 'post':
        if(isset($_GET['id'])){
          include "views/pages/one_photo.php";
        } else {
          include "views/pages/404.php";
        }
        break;
      default:
        include "views/pages/404.php";
    }
  } else {
    include "views/pages/home.php";
  }
  include "views/fixed/footer.php";
?>
