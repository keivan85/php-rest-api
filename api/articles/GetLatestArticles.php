<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-Headers: Origin, Content-type, Auth_key, Accept');

include_once '../../models/Apiusers.php';
include_once '../../models/Articles.php';


//Validate the request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    //Validate content type
    if ($_SERVER['REQUEST_TYPE'] === 'application/json') {

        //Get te auth key from the header
        $headers = apache_request_headers();
        $auth_key = $headers['auth_key'];

        $api_user->auth_key = $auth_key;

        //verify the Auth key
        $Verified = $api_user->verify_AuthKey();

        if ($Verified == TRUE) {

            //Get latest article
            $latest_articles = $articles->get_latest_articles();

            echo json_decode($latest_articles);
        } else {
            die(header('HTTP/1.1 401 Unauthorized key used'));
        }
    } else {
        die(header('HTTP/1.1 415 Content type invalid'));
    }
} else {
    die(header('HTTP/1.1 405 Request method is not allowed'));
}
