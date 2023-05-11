<?php
include('admin_auth.php');
include('dbcon.php');
include('includes/header.php');
?>
    
    <div class="container">
                <?php
                if(isset($_SESSION['status']))
                {
                    echo "<h5 class='alert alert-success'>".$_SESSION['status']."</h5>";
                    unset($_SESSION['status']);
                }
                ?>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>
                        <i class="fa fa-edit">&nbsp;</i>Edit User Data
                        </h4>
                    </div>
                    <div class="card-body">

                        <form action="code.php" method="POST">

                            <?php
                                include('dbcon.php');

                                if(isset($_GET['id']))
                                {
                                    $uid = $_GET['id'];

                                    try {
                                        $user = $auth->getUser($uid);
                                        ?>
                                            <input type="hidden" name="user_id" value="<?=$uid;?>">
                                            <div class="form-group mb-3">
                                                <label for="">Display Name</label>
                                                <input type="text" name="display_name" value="<?=$user->displayName;?>" class="form-control">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="">Phone Number</label>
                                                <input type="number" name="phone" value="<?=$user->phoneNumber;?>" class="form-control">
                                            </div>

                                            <div class="form-group mb-3">
                                                <button type="submit" name="update_user_btn" class="btn btn-primary"><i class="fa fa-check-circle">&nbsp;</i>Save Changes</button>
                                            </div>
                                        <?php
    
                                    } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
                                        echo $e->getMessage();
                                    }
                                }
                            ?>

                        </form>

                    </div>
                </div>              
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>
                        <i class="fa fa-toggle-on">&nbsp;</i>Disable or Enable User
                            <a href="user-list.php" class="btn btn-danger float-end"><i class="fa fa-arrow-circle-left">&nbsp;</i>Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST">

                            <?php
                            if(isset($_GET['id']))
                            {
                                $uid = $_GET['id'];
                                try {
                                    $user = $auth->getUser($uid);
                                    ?>
                            <input type="hidden" name="ena_dis_user_id" value="<?= $_GET['id']; ?>">
                            <div class="input-group mb-3">
                                <select name="select_enable_disable" class="form-control" required>
                                    <option value="">Select Option</option>
                                    <option value="disable">Disable</option>
                                    <option value="enable">Enable</option>
                                </select>
                                <button type="submit" name="enable_disable_user_acc" class="input-group-text btn btn-primary"><i class="fa fa-check-circle">&nbsp;</i>Done</button>
                            </div>
                            <?php
                                } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
                                    echo $e->getMessage();
                                }
                            }
                            else
                            {
                                echo "No user found";
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                
            </div>
            <div class="col-md-6">
                <div class="card mt-4">
                    <div class="card-header">
                        <h4><i class="fa fa-lock">&nbsp;</i>Change Password</h4>
                    </div>
                    <div class="card-body">

                            <form action="code.php" method="POST">

                                <?php
                                if(isset($_GET['id']))
                                {
                                    $uid = $_GET['id'];
                                    try {
                                        $user = $auth->getUser($uid);
                                    ?>
                                    <input type="hidden" name="change_pwd_user_id" value="<?=$uid; ?>">
                                    <div class="form-group mb-3">
                                        <label for="">New Password</label> 
                                        <input type="text" name="new_passord" required class="form-control">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="">Re-type New Password</label> 
                                        <input type="text" name="retype_passord" required class="form-control">
                                    </div>

                                    <div class="form-group mb-3">
                                        <button type="submit" name="change_password_btn" class="btn btn-primary"><i class="fa fa-check-circle">&nbsp;</i>Save Changes</button>
                                    </div>
                                    <?php

                                    } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
                                        echo $e->getMessage();
                                    }
                                }
                                else
                                {
                                    echo "No id found";
                                }
                                ?>
                            </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mt-4">
                    <div class="card-header">
                        <h4><i class="fa fa-user-circle-o">&nbsp;</i>User Claims</h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST">

                            <?php
                                if(isset($_GET['id']))
                                {
                                    $uid = $_GET['id'];
                            ?>
                                    
                                    <input type="hidden" name="claims_user_id" value=<?=$uid;?>>
                                    <div class="form-group mb-3">
                                        <select name="role_as" class="form-control" required>
                                            <option value="">Select Roles</option>
                                            <option value="admin">Admin</option>
                                            <option value="norole">No Role</option>
                                        </select>
                                    </div>
                                    <label for="">Current user role</label> 
                                    <h4 class="border p-1">

                                        <?php
                                            $claims = $auth->getUser($uid)->customClaims;
                                            if(isset($claims['admin']) == true)
                                            {
                                                echo "Admin";
                                            }elseif($claims == null)
                                            {
                                                echo "No Role";
                                            } 
                                        ?>
                                    </h4>
                                    <div class="form-group mb-3">
                                        <button type="submit" name="user_claims_btn" class="btn btn-primary"><i class="fa fa-check-circle">&nbsp;</i>Save Changes</button>
                                    </div>
                            <?php
                                }
                            ?> 
                        </form>
                    </div>
                </div>
            </div> 
        </div>
    </div>


<?php
include('includes/footer.php');
?>
    
   