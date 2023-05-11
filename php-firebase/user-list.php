<?php
include('admin_auth.php'); 
include('includes/header.php');
?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <?php
                if(isset($_SESSION['status']))
                {
                    echo "<h5 class='alert alert-success'>".$_SESSION['status']."</h5>";
                    unset($_SESSION['status']);
                }
                ?>

                <div class="card">
                    <div class="card-header">
                        <h4>
                        <i class="fa fa-list">&nbsp;</i>List of users
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID Number</th>
                                    <th>Display Name</th>
                                    <th>Phone Number</th>
                                    <th>Email Address</th>
                                    <th>User Role</th>
                                    <th>Disable/Enable</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include('dbcon.php');
                                $users = $auth->listUsers();

                                $i=101030302055;
                                foreach ($users as $user) 
                                {
                                    ?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td><?=$user->displayName ?></td>
                                        <td><?=$user->phoneNumber ?></td>
                                        <td><?=$user->email ?></td>
                                        <td>
                                            <span class="border">
                                                <?php
                                                    $claims = $auth->getUser($user->uid)->customClaims;
                                                    if(isset($claims['admin']) == true)
                                                    {
                                                        echo "Admin";
                                                    }
                                                    elseif($claims == null)
                                                    {
                                                        echo "No Role";
                                                    } 
                                                ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php
                                                if($user->disabled)
                                                {
                                                    echo "Disabled";
                                                }
                                                else
                                                {
                                                    echo "Enabled";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="user-edit.php?id=<?=$user->uid;?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil">&nbsp;</i>Edit</a>
                                        </td>
                                        <td>
                                            <form action="code.php" method="POST">
                                                <button type="submit" name="reg_user_delete_btn" value="<?=$user->uid;?>" class="btn btn-danger btn-sm"><i class="fa fa-trash">&nbsp;</i>Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include('includes/footer.php');
?>
    