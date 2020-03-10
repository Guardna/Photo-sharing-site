<div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                    <?php
                        $id = "";
                        $post ="";

                        $isUpdate = false;

                        if(isset($_GET['id'])){
                            $id = $_GET['id'];
                            $isUpdate = true; 

                            require_once "models/photos/functions.php";

                            $post = get_one_post_with_photo_and_user($id);
                        }

                    ?>
                    <h2><?= ($isUpdate)? 'Update Post' : 'Add Post' ?></h2>                           
                    <form role="form" id="form" action="<?= ($isUpdate)? "models/photos/change.php" : "models/photos/insert.php"?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= ($isUpdate)? $id : '' ?>"/>
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" class="form-control" name="title" id="title" value="<?= ($isUpdate)? $post->title : '' ?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Photo input</label>
                                            <input type="file" name="photo" value="<?= ($isUpdate)? $post->original : '' ?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Text area</label>
                                            <textarea class="form-control" rows="3" name="desc"><?= ($isUpdate)? $post->descriptions : '' ?></textarea>
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
                                        <button type="submit" class="btn btn-primary" name="add"><?= ($isUpdate)? 'Update Post' : 'Submit Post' ?></button>
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