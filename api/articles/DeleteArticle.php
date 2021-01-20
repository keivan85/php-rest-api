<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: DELETE');
header('Access-Control-Allow-Headers: Origin, Content-type, Auth_key, Accept');

include_once '../../models/Apiusers.php';
include_once '../../models/Articles.php';


//Validate the request
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

    //Validate content type
    if ($_SERVER['REQUEST_TYPE'] === 'application/json') {

        //Get te auth key from the header
        $headers = apache_request_headers();
        $auth_key = $headers['auth_key'];

        $api_user->auth_key = $auth_key;

        //verify the Auth key
        $Verified = $api_user->verify_AuthKey();

        if ($Verified == TRUE) {

            $json = file_get_contents('php://inputs');
            $data = json_decode($json);

            //validate params

            if ($articles->validate_article_param($data->article_id)) {
                $articles->article_id = $data->article_id;
            } else {
                die(header('HTTP/1.1 402 article_id parameter is required'));
            }

            if ($articles->validate_article_param($data->user_id)) {
                $articles->user_id = $data->user_id;
            } else {
                die(header('HTTP/1.1 402 user_id parameter is required'));
            }


            //Update article
            if ($articles->delete_article()) {
                echo json_encode(array('message' => 'Article ' . $articles->article_id . ' is deleted successfully.'));
            } else {
                echo json_encode(array('message' => 'Article ' . $articles->article_id . ' can not be deleted right now.'));
            }
        } else {
            die(header('HTTP/1.1 401 Unauthorized key used'));
        }
    } else {
        die(header('HTTP/1.1 415 Content type invalid'));
    }
} else {
    die(header('HTTP/1.1 405 Request method is not allowed'));
}
