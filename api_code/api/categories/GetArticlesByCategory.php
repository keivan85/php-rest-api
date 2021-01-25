<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-type, Auth_key, Accept');

include_once '../../models/Apiusers.php';
include_once '../../models/Categories.php';


//Validate the request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Validate content type
    if ($_SERVER['CONTENT_TYPE'] === 'application/json') {

        //Get te auth key from the header
        $headers = apache_request_headers();
        $auth_key = $headers['auth_key'];

        $api_user->auth_key = $auth_key;

        //verify the Auth key
        $Verified = $api_user->verify_AuthKey();

        if ($Verified == TRUE) {

            $json = file_get_contents('php://input');
            $data = json_decode($json);

            $categories->category_id = $data->category_id;

            //GET Categories
            $category_articles = $categories->get_articles_by_category();

            echo json_encode($categories);

        } else {
            die(header('HTTP/1.1 401 Unauthorized key used'));
        }
    } else {
        die(header('HTTP/1.1 415 Content type invalid'));
    }
} else {
    die(header('HTTP/1.1 405 Request method is not allowed'));
}
