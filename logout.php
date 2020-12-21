<?php
session_start();
require_once('includes/Helper.php');

if (!isset($_SESSION['userdata']['islogged_in'])) {
    global $helper;

    $helper->Message = 'Please login.';
    $helper->Location = 'login';
    $helper->set_flash_message_Warn();
} else {
    session_destroy();

    $helper->Message = 'Logout Successfully';
    $helper->Location = 'login';
    $helper->set_flash_message();
}

?>