<div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="card-title">Users</h2>
                        <a href="index.php?page=register" class="btn btn-primary">Add User</a>

                    <table class="table table-hover">

                        <thead class="text-warning">
                            <th>ID</th>
                            <th>Name and Surname</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>

                        <tbody id="usus">


                          <?php
                            require_once "models/users/functions.php";
                            $datas = getUsers();

                            foreach($datas as $data):
                          ?>

                          <tr>
                            <td><?= $data->id ?></td>
                            <td><?= $data->uname ?></td>
                            <td><?= $data->username ?></td>
                            <td><?= $data->email ?></td>
                            <td><?= $data->role_id ?></td>
                            <td>
                              <a href="index.php?page=register&id=<?= $data->id ?>">Edit</a>
                            </td>
                            <td>
                              <a href="#" data-id="<?=$data->id?>" class="del" >Delete</a>
                            </td>
                          </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                    <table class="table table-hover">
                    <h2 class="card-title">Logs</h2>
                        <thead class="text-warning">
                            <th>ID</th>
                            <th>Access page</th>
                            <th>Time</th>
                            <th>Address</th>
                        </thead>

                        <tbody id="logtable">
                          <?php
                            $open = fopen("data/log.txt", "r");
                            $logdata = file("data/log.txt");
                            fclose($open);

                            foreach($logdata as $key=> $value):
                              $log = explode(SEPARATOR, $value);
                          ?>
                          <tr>
                            <td><?= $key+1 ?></td>
                            <td><?= $log[0] ?></td>
                            <td><?= $log[1] ?></td>
                            <td><?= $log[2] ?></td>
                          </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>