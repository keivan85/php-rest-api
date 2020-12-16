<?php
require_once('includes/Forms.php');
require_once('models/Apiusers.php');
require_once('includes/Helper.php');

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