<?php
include('authentication.php');
include('includes/header.php');
?>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"">
    <div class="container">
        <div class="row">

            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5><i class="fa fa-info-circle">&nbsp;</i>Number of students:

                            <?php
                                include('dbcon.php');
                                $ref_table = 'user';
                                $totalrec_count = $database->getReference($ref_table)->getSnapshot()->numChildren();
                                echo $totalrec_count;
                            ?>

                        </h5>
                    </div>
                </div>
            </div>
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
                        <i class="fa fa-list">&nbsp;</i>List of students
                            <a href="add-contact.php" class="btn btn-primary float-end"><i class="fa fa-plus-circle">&nbsp;</i>Add Student</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID Number</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email Address</th>
                                    <th>Phone Number</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include('dbcon.php');

                                    $ref_table = 'user';
                                    $fetchdata = $database->getReference($ref_table)->getValue();

                                    if ($fetchdata > 0)
                                    {
                                        $i=2020301045;
                                        foreach($fetchdata as $key => $row)
                                        {
                                            ?>
                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?=$row['fname'];?></td>
                                                <td><?=$row['lname'];?></td>
                                                <td><?=$row['email'];?></td>
                                                <td><?=$row['phone'];?></td>
                                                <td>
                                                    <a href="edit-contact.php?id=<?=$key;?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil">&nbsp;</i>Edit</a>
                                                </td>
                                                <td>
                                                    <form action="code.php" method="POST">
                                                        <button type="submit" name="delete_btn" value=<?=$key?> class="btn btn-danger btn-sm"><i class="fa fa-trash">&nbsp;</i>Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                            <tr>
                                                <td colspan="7">No Record Found</td>
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
    