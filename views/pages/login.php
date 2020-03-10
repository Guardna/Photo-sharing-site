<div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                    <h2>Login</h2>                        
                    <form role="form" action="models/users/login.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="email" id="email" />
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password" id="password" />
                                            <p>If you forgot your password just enter your email above and hit the Recover button</p>
                                            <?php if(isset($_SESSION['error'])):
                                                echo '<p>';
                                                $errors=$_SESSION['error'];
                                                foreach($errors as $error) {
                                                    echo $error.'<br>';
                                                }
                                                echo '</p>';
				                                unset($_SESSION['error']);
				                            endif;?>
                                        </div>                           
                                        <button type="submit" class="btn btn-primary" name="login" >Login</button>
                                        <button type="submit" class="btn btn-default" name="recover" >Recover Password</button>
                    </form>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />                               
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>