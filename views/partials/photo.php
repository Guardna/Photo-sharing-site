<div class="col-md-4 col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        <?= $photo->title ?>
                        </div>
                        <div class="panel-body">
                        <img src="<?= $photo->small ?>">
                        </div>
                        <div class="panel-footer">
                        <a href="index.php?page=post&id=<?= $photo->post_id ?>" class="btn btn-primary" >View post</a>
                        <?php
                        if(isset($_SESSION['user'])){
                        ?>
                        <?php
                            if($_SESSION['user']->useid==$photo->user_ids){
                        ?> 
                        <a href="index.php?page=insert&id=<?= $photo->post_id ?>" class="btn btn-warning">Edit</a>
						<a href="models/photos/delete.php?id=<?= $photo->post_id ?>" class="btn btn-danger">Delete</a>
                        <?php
                        }
                        ?> 
                        <?php
                        }
                        ?>
                        </div>
                    </div>
</div>