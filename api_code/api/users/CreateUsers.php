<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-type, Auth_key, Accept');

include_once '../../models/Apiusers.php';
include_once '../../models/Users.php';

//Validate the request

if ($_SERVER['REQUEST_METHOD'] === 'POST') {



    //Validate the content-type
    if ($_SERVER['CONTENT_TYPE'] === 'application/json') {


        //Get the auth_key from the header
        $headers = apache_request_headers();
        $auth_key = $headers['Auth_Key'];

        $api_user->auth_key = $auth_key;

        //Validate auth_key
        $Verified = $api_user->verify_AuthKey();

        if ($Verified == TRUE) {
            //Get file data
            $json = file_get_contents('php://input');
            $data = json_decode($json);

            //Validate the param
            if ($user->validate_param($data->firstname)) {
                $user->firstname = $data->firstname;
            } else {
                die('HTTP/1.1 402 firstname parameter is required');
            }

            if ($user->validate_param($data->lastname)) {
                $user->lastname = $data->lastname;
            } else {
                die('HTTP/1.1 402 lastname parameter is required');
            }

            if ($user->validate_param($data->email)) {
                $user->email = $data->email;
            } else {
                die('HTTP/1.1 402 email parameter is required');
            }

            if ($user->validate_param($data->password)) {
                $user->password = $data->password;
            } else {
                die('HTTP/1.1 402 password parameter is required');
            }

            //Check unique email
            if ($user->check_unique_email()) {

                //Create user
                if ($user->create_User()) {
                    echo json_encode(array('message' => 'User has been created'));
                } else {
                    echo json_encode(array('message' => 'User can not be created.'));
                }
            } else {
                echo json_encode(array('message' => 'This email is already in use'));
            }
        } else {
            die('HTTP/1.1 401 Unauthorized Key used');
        }
    } else {
        die('HTTP/1.1 415 Content type Invalid');
    }
} else {
    die(header('HTTP/1.1 405 Request Method is not Allowed'));
}
