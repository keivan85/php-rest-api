<?php
require_once('includes/Forms.php');
require_once('models/Apiusers.php');
require_once('includes/Helper.php');




//login Apiuser process

if (isset($_POST['login'])) {
    $form->StickyData = $_POST;
    $form->checkEmpty('email');
    $form->checkEmpty('password');

    if ($form->valid == TRUE) {
        $api_user->email = $_POST['email'];
        $api_user->password = $_POST['password'];
    }

    //var_dump($api_user->check_user_credentials());
    //die();
    //Check login
    if ($user_info = $api_user->check_user_credentials()) {

        //Setting logged in user data in session
        $_SESSION['userdata']['islogged_in'] = 1; //Initializing islogged_in variable
        $_SESSION['userdata']['apiuser_id'] = $user_info['apiuser_id'];

        //user helper class for setting flash messages
        //Redirect the user to profile view

        global $helper;
        $helper->Location = 'profile';
        $helper->Message = 'You have successfully logged in';

        $helper->set_flash_message();

        exit;
    } else {
        $form->raiseCustomError('email', 'Invalid username or password');
    }
}



//Building the login form

$form->form_open('login', 'login');

$form->makeInputEmail('Your email address', 'email');
$form->makePassword('Your password', 'password');
$form->makeSubmit('login');
?>

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
                    <strong>Success! </strong><?php echo $_SESSION['flash_message']['success']; ?>
                </div>
            <?php
                //Unset session flash message
                unset($_SESSION['flash_message']['success']);
            }
            ?>
            <!-- App login form starts -->

            <div class="app_form m-top-50">
                <h2 class="display-5">Login here ...!</h2>
                <?php
                //Display the login form
                echo $form->HTML;
                ?>
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