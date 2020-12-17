<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article hub | Login</title>
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>

<body>
    <!-- Navigation starts -->
    <?php
    include 'elements/navigation.php';
    ?>
    <!-- Navigation ends -->

    <div class="container">
        <div class="col-md-8">
            <?php
            //Displaying the success session flash message
            if (isset($_SESSION['flash_message']['success'])) {

            ?>
                <div class="alert alert-success alert-dismissable m-top-50">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong><?php echo $_SESSION['flash_message']['success']; ?>
                </div>
            <?php
                //Unset session flash message
                unset($_SESSION['flash_message']['success']);
            }
            ?>
            <!-- App login form starts -->

            <div class="app_form m-top-50">
                <h2 class="display-5">Login here ...!</h2>
            </div>
            <!-- App login form ends -->

        </div>
    </div>


    <!-- Footer starts -->
    <footer class="footer">
        <div class="container">
            <span class="text-muted">Rest API development Tutorial</span>
        </div>
    </footer>
    <!-- Footer ends -->

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/popper.min.js"></script>

</body>

</html>