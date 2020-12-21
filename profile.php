<?php
require_once('models/Apiusers.php');
require_once('includes/Helper.php');


if (!isset($_SESSION['userdata']['islogged_in'])) {
  global $helper;

  $helper->Message = 'Please login';
  $helper->Location = 'login';
  $helper->set_flash_message_Warn();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Article hub | Profile</title>
  <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>

<body>
  <!-- Navigation starts -->
  <?php
  include 'elements/navigation.php';
  ?>
  <!-- Navigation ends -->

  <!-- Contain user data starts -->
  <div class="container m-top-50">
<div class="col-mad-9">
<h2>User profile</h2>
<?php
$api_user->apiuser_id = $_SESSION['userdata']['apiuser_id'];
$user_info = $api_user->get_ApiuserDetails();
?>

<p><strong>Name: </strong><?= $user_info['firstname'] . ' ' . $user_info['lastname']?></p>
<p><strong>Email: </strong> <?= $user_info['email']; ?></p>
<p><strong>Tampered Auth_key: </strong><?= preg_replace('/\D/', '-', $user_info['auth_key']); ?></p>
<p><strong>Auth_key: </strong><?= $user_info['auth_key'] ?></p>

</div>
  </div>
  <!-- Contain user data ends -->


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