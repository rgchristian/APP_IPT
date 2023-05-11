<?php
include('authentication.php');
include('includes/header.php');
?>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"">
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
                        <h4><i class="fa fa-user-circle-o">&nbsp;</i>My Profile</h4>
                    </div>
                    <div class="card-body">

                        <?php
                         if(isset($_SESSION['verified_user_id']))
                         {
                            $uid = $_SESSION['verified_user_id'];
                            $user = $auth->getUser($uid);
                            ?>

                            
                            <form action="code.php" method="POST" enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-md-8 border-end">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="">Display Name</label>
                                                    <input type="text" name="display_name" value="<?=$user->displayName;?>" required class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="">Phone Number (+63)</label>
                                                    <input type="text" name="phone" value="<?=$user->phoneNumber;?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="">Email Address</label>
                                                    <div class="form-control">
                                                        <?=$user->email;?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="">Role</label>
                                                    <div class="form-control">
                                                    <?php
                                                            $claims = $auth->getUser($user->uid)->customClaims;
                                                        if(isset($claims['admin']) == true)
                                                        {
                                                            echo "User Admin";
                                                        }
                                                        elseif($claims == null)
                                                        {
                                                            echo "No Role";
                                                        } 
                                                    ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="">Account Status</label>
                                                    <div class="form-control">
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group border mb-3">
                                            <?php
                                            if($user->photoUrl != NULL)
                                            {
                                                ?>
                                                <img src="<?=$user->photoUrl?>" class="w-100" alt="User Profile">
                                                <?php
                                            }
                                            else
                                            {
                                                echo "You currently don't have a profile picture; upload one.";
                                            }
                                            ?>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">Upload Profile Picture</label>
                                            <input type="file" name="profile" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                        <div class="form-group mb-3">
                                            <button type="submit" name="update_user_profile" class="btn btn-primary float-end"><i class="fa fa-check">&nbsp;</i>Save Changes</button>
                                        </div>
                                    </div>
                                </div>

                            </form>

                            <?php
                         }
                        ?>

                    </div>
                </div>

        </div>
    </div>
</div>


<?php
include('includes/footer.php');
?>