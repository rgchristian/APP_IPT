<?php
include('includes/header.php');
?>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            <i class="fa fa-graduation-cap">&nbsp;</i>Add Student
                            <a href="index.php" class="btn btn-danger float-end"><i class="fa fa-arrow-circle-left">&nbsp;</i>Back</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <form action="code.php" method="POST">

                            <div class="form-group mb-3">
                                <label for="">First Name</label>
                                <input type="text" name="first_name" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Last Name</label>
                                <input type="text" name="last_name" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Email Address</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Phone Number</label>
                                <input type="text" name="phone" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="save_contact" class="btn btn-primary"><i class="fa fa-check-circle">&nbsp;</i>Save</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include('includes/footer.php');
?>
    