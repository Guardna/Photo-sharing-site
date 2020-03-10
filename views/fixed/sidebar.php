<nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                <?php
                if(isset($_SESSION['user']))
				{
			    ?>
				<li class="text-center">
                    <img src="<?=$_SESSION['user']->small?>" class="user-image img-responsive"/>
					</li>
                <?php
					}
				?>
					<?php
                        include "models/photos/functions.php";

                        $menu=menu();

                                     
                        if(isset($_SESSION['user'])){

                            ?>
                            <?php
                            if($_SESSION['user']->role_id=="1"){
                                ?>
                                <li>
                                    <a  href="index.php?page=admin"/>Admin Panel</a>
                                </li>
                                <?php
                                    }
                                ?>                               
                                <li>
                                    <a  href="index.php?page=insert"/>Add Post</a>
                                </li>

                                <?php
                        }
                        ?>
                        <?php foreach($menu as $menus):
                        ?>
                            <li>
                                <a  href="index.php?page=<?=$menus->path?>"/><?=$menus->mname?></a>
                            </li>
                        <?php
                        endforeach;
                        ?>
                </ul>
               
            </div>
            
        </nav>  