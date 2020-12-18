<?php
require_once('includes/Forms.php');
require_once('models/Apiusers.php');
require_once('includes/Helper.php');


//Regsiter Apiuser process
if (isset($_POST['Register'])) {
  $form->StickyData = $_POST;
  $form->checkEmpty('firstname');
  $form->checkEmpty('lastname');
  $form->checkEmpty('email');
  $form->checkEmpty('password');
  $form->checkEmpty('confirmpassword');

  $form->compare('password', 'confirmpassword');

  //Check for unique email
 
  $EmailAvailable = $api_user->check_email();

  if ($EmailAvailable == FALSE) {
    $form->raiseCustomError('email', 'Email is already in use ...!');
  }

  if ($form->valid == TRUE) {
    //Checking if the registration form is free of errors
    $api_user->firstname = $_POST['firstname'];
    $api_user->lastname = $_POST['lastname'];
    $api_user->email = $_POST['email'];
    $api_user->password = $_POST['password'];


    if ($api_user->check_email() != FALSE) {

      try {
        //Insert user into database

        $api_user->create_ApiUser();

      } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
      }
    } else {
      $form->raiseCustomError('email', 'The email is already in use ...');
    }
  }
}

//Making register form
$form->form_open('register', 'register_form');
$form->makeInput('First Name', 'firstname');
$form->makeInput('Last Name', 'lastname');
$form->makeInputEmail('Your email', 'email');
$form->makePassword('Enter password', 'password');
$form->makePassword('Confirm password', 'confirmpassword');

$form->makeSubmit('Register');
//Making register form

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Article hub | Register</title>
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
      <!-- App register form starts -->

      <div class="app_form m-top-50">
        <h2 class="display-5">Register here ...!</h2>
        <?php
        //Displaying Register form
        echo $form->HTML;
        ?>
      </div>
      <!-- App register form ends -->

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