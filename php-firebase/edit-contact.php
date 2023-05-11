<?php
include('includes/header.php');
?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>
                        <i class="fa fa-graduation-cap">&nbsp;</i>Edit Student Info
                            <a href="index.php" class="btn btn-danger float-end"><i class="fa fa-arrow-circle-left">&nbsp;</i>Back</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                            include('dbcon.php');

                            if(isset($_GET['id']))
                            {
                                $key_child = $_GET['id'];

                                $ref_table = 'user';
                                $getdata = $database->getReference($ref_table)->getChild($key_child)->getValue();

                                if($getdata > 0)
                            {
                        ?>
                                     
                        <form action="code.php" method="POST">

                            <input type="hidden" name="key" value="<?=$key_child;?>">
                            <div class="form-group mb-3">
                                <label for="">First Name</label>
                                <input type="text" name="first_name" value="<?=$getdata['fname'];?>" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Last Name</label>
                                <input type="text" name="last_name" value="<?=$getdata['lname'];?>" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Email Address</label>
                                <input type="email" name="email" value="<?=$getdata['email'];?>" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Phone Number</label>
                                <input type="number" name="phone" value="<?=$getdata['phone'];?>" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="update_contact" class="btn btn-primary"><i class="fa fa-check-circle">&nbsp;</i>Save Changes</button>
                            </div>

                        </form>
                    <?php
                            }
                            else
                            {
                                $_SESSION['status'] = "Invalid";
                                header('Location: index.php');
                                exit();
                            }
                        }
                            else
                            {
                                $_SESSION['status'] = "No record found";
                                header('Location: index.php');
                                exit();
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
    