<div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                    <h2>Sort:</h2>                      
                                    <div class="panel-body">
                                        <select class="form-control" id="sort">
                                            <option value="0">Choose...</option>
                                            <?php

                                            $options = [
                                                [
                                                "value" => 1,
                                                "text"=> "Name - Ascending"
                                                ],
                                                [
                                                "value" => 2,
                                                "text" => "Name - Descending"
                                                ],
                                                [
                                                "value" => 3,
                                                "text" => "Post Date - Ascending"
                                                ],
                                                [
                                                "value" => 4,
                                                "text" => "Post Date - Descending"
                                                ]
                                            ];

                                            foreach($options as $option):
                                            ?>
                                            
                                            <option value="<?= $option['value'] ?>">
                                                <?= $option['text'] ?>
                                            </option>

                                            <?php endforeach; ?>

                                        </select>
                                    </div>
                                    <div class="panel-body">
                                    <form method="POST">
                                    <input type="text" class="form-control" name="search" id="search" placeholder="Search..."/>
                                    </form>
                                    </div>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
                                 
            <div class="row" id="photos">

            <?php
                
                $limit =  isset($_GET['limit'])? $_GET['limit'] : 0;
                $photos = get_posts_with_photo($limit);

                foreach($photos as $photo):
                include "views/partials/photo.php";
                endforeach; 
            ?> 

                
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div id="dataTables-example_paginate">
                        <ul class="pagination" id="pagination">
                            <?php
                                $num_of_photos = get_pagination_count();
                                if(isset($_POST['search'])){
                                $nid=$_POST['search'];
                                }
                                for($i = 0; $i < $num_of_photos; $i++):
                            ?>
                            <li class="paginate_button" aria-controls="dataTables-example" tabindex="0">
                                <a href="#" class="photo-pagination" data-limit="<?= $i ?>" data-id="<?= $nid ?>"><?= $i+1 ?></a>
                            </li>
                            <?php endfor; ?>
                        </ul>
                    </div>
                </div>
            </div>

    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>