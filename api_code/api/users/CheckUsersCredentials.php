<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-type, Auth_key, Accept');

include_once '../../models/Apiusers.php';
include_once '../../models/Users.php';

//validate request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
        //Get the auth_key from the header
        $headers = apache_request_headers();
        $auth_key = $headers['Auth_Key'];

        $api_user->auth_key = $auth_key;

        //Validate auth_key
        $Verified = $api_user->verify_AuthKey();

        if ($Verified == TRUE) {
            //Get file content
            $json = file_get_contents('php://input');

            $data = json_decode($json);

            //validate params
            if ($user->validate_param($data->email)) {
                $user->email = $data->email;
            } else {
                die(header('HTTP/1.1 402 Email Parameter is required'));
            }
            if ($user->validate_param($data->password)) {
                $user->passwrod = $data->password;
            } else {
                die(header('HTTP/1.1 402 Password Parameter is required'));
            }

            //Check user credential
            if ($info = $user->check_user_credentials()) {
                echo json_encode($info);
            } else {
                echo json_encode(array('message' => 'invalid email or password'));
            }
        } else {
            die(header('HTTP/1.1 401 Unauthorized Key used'));
        }
    } else {
        die(header('HTTP/1.1 415 Content type Invalid'));
    }
} else {
    die(header('HTTP/1.1 405 Request is not Allowed'));
}
