<div id="page-wrapper" >
            <div id="page-inner">
                <?php
                  require_once "models/users/functions.php";
                  $photo = getOneUser(1);
                  if($photo):
                ?>
                <div class="row">
                <div class="col-md-12">
                <div class="panel-body">
                    <ul class="nav nav-pills">
                    <?= $photo->uname ?>
                    <a href="models/users/exportword.php" class="btn btn-danger square-btn-adjust">Download as word</a>
                    <a href="models/photos/exportexcel.php" class="btn btn-warning square-btn-adjust">Export Excel</a>
                    <a href="documentation.pdf" class="btn btn-primary square-btn-adjust">Documentation</a>
                    </ul>
                </div>
                <div class="jumbotron">
                    <img src="<?= $photo->original ?>">
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Posted by
                    </div>
                    <div class="panel-body">
                    <?= $photo->username ?>                   
                    </div>
                    <div class="panel-heading">
                        Email
                    </div>
                    <div class="panel-body">
                    <?= $photo->email ?>                   
                    </div>
                    <div class="panel-heading">
                        Index
                    </div>
                    <div class="panel-body">
                    328/15                 
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