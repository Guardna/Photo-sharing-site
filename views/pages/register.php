<div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                    <?php
                        $id = "";
                        $user ="";

                        $isUpdate = false;

                        if(isset($_GET['id'])){
                            $id = $_GET['id'];
                            $isUpdate = true; 

                            require_once "models/users/functions.php";

                            $user = getOneUser($id);
                        }

                    ?>   
                    <h2><?= ($isUpdate)? 'Update' : 'Register' ?></h2>                     
                    <form role="form" id="form" action="<?= ($isUpdate)? "models/users/change.php" : "models/users/register.php"?>" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?= ($isUpdate)? $id : '' ?>"/>
                                        <div class="form-group">
                                            <label>Name and Surname</label>
                                            <input type="text" class="form-control" name="namesurname" id="namesurname" value="<?= ($isUpdate)? $user->uname : '' ?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" class="form-control" name="username" id="username" value="<?= ($isUpdate)? $user->username : '' ?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="email" id="email" value="<?= ($isUpdate)? $user->email : '' ?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password" id="password" value="<?= ($isUpdate)? $user->pass : '' ?>"/>
                                        </div>
                                        <div class="form-group">  
                                        <?php
                                            if(isset($_SESSION['user'])):
                                                if($_SESSION['user']->role_id=="1"):
                                                    ?>  
                                                        <label>Role</label>
                                                        <select class="form-control" name="roleid">
                                                            <option value="2">Choose...</option>
                                                            <?php
                                                                $roles=executeQuery("SELECT * FROM roles");
                                                                foreach($roles as $role):
                                                            ?>
                                                            <option value="<?= $role->id ?>">
                                                                <?= $role->role ?>
                                                            </option>

                                                            <?php endforeach; ?>
                                                            </select>
                                                <?php endif; ?>
                                            
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Profile Photo</label>
                                            <input type="file" name="photo" value="<?= ($isUpdate)? $user->original : '' ?>"/>
                                            <p>If you don't choose a photo you will be assigned a default one.</p>
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
                                        <button type="submit" class="btn btn-primary" name="register" ><?= ($isUpdate)? 'Update' : 'Register' ?></button>
                                        <button type="reset" class="btn btn-default">Reset</button>
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