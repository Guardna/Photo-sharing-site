<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Photogram</a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;">
<?php	
	if(isset($_SESSION['user']))
		{
            echo "User: ".$_SESSION['user']->username;
?>
 &nbsp; 
<a href="models/users/logout.php" class="btn btn-danger square-btn-adjust">Logout</a>
<?php
    if($_SESSION['user']->role_id!=1){
        ?>
        <a href="index.php?page=register&id=<?= $_SESSION['user']->useid ?>" class="btn btn-warning square-btn-adjust">Edit Profile</a>
        <?php
    }
		}
?>
<?php
	if(!isset($_SESSION['user']))
	{
?>
 &nbsp; 
<a href="index.php?page=login" class="btn btn-primary square-btn-adjust">Login</a>&nbsp;
<a href="index.php?page=register" class="btn btn-info square-btn-adjust">Register</a>
<?php
	}
?>
</div>
        </nav> 