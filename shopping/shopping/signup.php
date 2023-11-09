<?php session_start();
include_once('includes/config.php');
error_reporting(0);
if (isset($_POST['submit'])) {
    $name = $_POST['fullname'];
    $email = $_POST['emailid'];
    $contactno = $_POST['contactnumber'];
    $password = md5($_POST['inputuserpwd']);
    $sql = mysqli_query($con, "select id from users where email='$email'");
    $count = mysqli_num_rows($sql);
    if ($count == 0) {
        $query = mysqli_query($con, "insert into users(name,email,contactno,password) values('$name','$email','$contactno','$password')");
        if ($query) {
            echo "<script>alert('You are successfully register');</script>";
            echo "<script type='text/javascript'> document.location ='login.php'; </script>";
        } else {
            echo "<script>alert('Not register something went worng');</script>";
            echo "<script type='text/javascript'> document.location ='signup.php'; </script>";
        }
    } else {
        echo "<script>alert('Email id already registered with another accout. Please try  with another email id.');</script>";
        echo "<script type='text/javascript'> document.location ='signup.php'; </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shopping | User Sign up</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <script src="js/jquery.min.js"></script>
    <!--  <link href="css/bootstrap.min.css" rel="stylesheet" /> -->
</head>
<script>
    function emailAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "check_availability.php",
            data: 'email=' + $("#emailid").val(),
            type: "POST",
            success: function (data) {
                $("#user-email-status").html(data);
                $("#loaderIcon").hide();
            },
            error: function () { }
        });
    }
</script>
<style type="text/css"></style>

<body>
    <?php include_once('includes/header.php'); ?>
    <!-- Header-->
    <header class="bg-dark py-1"> <!-- Decreased the vertical padding to py-3 -->
        <div class="container px-3 px-lg-4 my-2">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">User Signup</h1>
                <p class="lead fw-normal text-white-50 mb-0">One Time Registration is Required for Shopping</p>
            </div>
        </div>
    </header>
    <!-- Section-->

    <body>
        <section class="py-5">
            <div class="container px-4 mt-5 ">

                <form method="post" name="signup">
                    <div class="row">
                        <div class="col-md-2">Full Name</div>
                        <div class="col-md-6"><input type="text" name="fullname" class="form-control" required></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-2">Email Id</div>
                        <div class="col-md-6">
                            <input type="email" name="emailid" id="emailid" class="form-control"
                                onBlur="emailAvailability()" required>
                            <span id="user-email-status" style="font-size: 12px;"></span>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-2">Contact Number</div>
                        <div class="col-md-6">
                            <input type="text" name="contactnumber" pattern="[0-9]{10}"
                                title="10 numeric characters only" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-2">Password</div>
                        <div class="col-md-6">
                            <input type="password" name="inputuserpwd" class="form-control" required
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{6,}"
                                title="Password must be 6 characters long, with at least 1 lowercase letter, 1 uppercase letter, 1 number (0-9), and 1 special character (!@#$%^&*()_-+=).">
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-md-4">&nbsp;</div>
                        <div class="col-md-6"><input type="submit" name="submit" id="submit" class="btn btn-primary"
                                required></div>
                    </div>
                </form>

            </div>
        </section>

        <!-- Footer-->
        <?php include_once('includes/footer.php'); ?>
        <!-- Bootstrap core JS-->
        <script src="js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>

</html>