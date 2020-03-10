<div id="page-wrapper" >
            <div id="page-inner">
                <?php
                  require_once "models/photos/functions.php";
                  $photo = get_one_post_with_photo_and_user($_GET['id']);
                  if($photo):
                ?>
                <div class="row">
                <div class="col-md-12">
                <div class="panel-body">
                    <ul class="nav nav-pills">
                    <?= $photo->title ?>
                    </ul>
                </div>
                <div class="jumbotron">
                    <img src="<?= $photo->medium ?>">
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Posted by
                    </div>
                    <div class="panel-body">
                    <?= $photo->user->username ?>                   
                    </div>
                    <div class="panel-heading">
                        Post date
                    </div>
                    <div class="panel-body">
                    <?= date( $photo->post_time ) ?>                   
                    </div>
                    <div class="panel-heading">
                        Description
                    </div>
                    <div class="panel-body">
                    <?= $photo->descriptions ?>                   
                    </div>
                </div>
                </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
                 <?php endif; ?> 
    </div>
             <!-- /. PAGE INNER  -->
            </div>