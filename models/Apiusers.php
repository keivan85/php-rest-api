<?php

session_start();
//Directory separator
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..') . $ds;
require_once("{$base_dir}includes{$ds}Database.php");
require_once("{$base_dir}includes{$ds}Bcrypt.php");
require_once("{$base_dir}includes{$ds}Helper.php");


class Apiusers
{
    private $table = 'apiusers';

    //Apiuser properties
    public $apiuser_id;

    public $firstname;

    public $lastname;

    public $email;

    public $password;

    public $auth_key;

    public $status;

    public function __construct()
    {
    }

    //Check email uniqueness
    public function check_email()
    {
        global $database;
        var_dump($this->email);
die();
        $this->email = trim(htmlspecialchars(strip_tags($this->email)));
        $sql = "SELECT * FROM " . $this->table . " WHERE email = '" . $database->escape_value($this->email) . "'";

        $result = $database->query($sql);

        $info = $database->fetch_row($result);



        if (empty($info)) {
            return true;
        } else {
            return false;
        }
    }

    //Insert/create Apiuser
    public function create_ApiUser()
    {
        //Clear data
        $this->firstname = htmlspecialchars(strip_tags($this->firstname));

        $this->lastname = htmlspecialchars(strip_tags($this->lastname));

        $this->email = htmlspecialchars(strip_tags($this->email));

        $this->password = htmlspecialchars(strip_tags($this->password));

        //Hash the password
        $hashed_password = Bcrypt::hashPassword($this->password);

        //Create user Auth_key
        $normal_key = substr(md5(mt_rand()), 0, 7);

        //Hash the key
        $auth_key = Bcrypt::hashPassword($normal_key);

        global $database;

        $sql = "INSERT INTO $this->table (firstname, lastname, email, password, auth_key)
                VALUES ('" . $database->escape_value($this->firstname) . "',
                        '" . $database->escape_value($this->lastname) . "',
                        '" . $database->escape_value($this->email) . "',
                        '" . $database->escape_value($hashed_password) . "',
                        '" . $database->escape_value($auth_key) . "')";

var_dump($sql);
die();

        $user_saved = $database->query($sql);


        if ($user_saved) {
            global $helper;
            $helper->Message = 'Registration Successful Login Here';
            $helper->Location = 'login.php';
            $helper->set_flash_message();
        } else {
            die('Can not save the user register later ...');
        }
    }

    //Get the Apiuser details
    public function get_ApiuserDetails()
    {
        global $database;

        $this->apiuser_id = intval($this->apiuser_id);

        $sql = "SELECT apiuser_id, firstname, lastname, email, auth_key FROM" . $this->table . "
        WHERE apiuser_id = '. $this->apiuser_id. '";

        $result = $database->query($sql);
        $userinfo = $database->fetch_row($result);

        return $userinfo;
    }

    //Check user credentials
    public function check_user_credentials()
    {
        global $database;

        $this->email = trim(htmlspecialchars(strip_tags($this->email)));

        $sql = "SELECT apiuser_id, firstname, lastname, email, password FROM " . $this->table . "
        WHERE email = '" . $database->escape_value($this->email) . "'";

        $result = $database->query($sql);

        $user_info = $database->fetch_row($result);

        if (!empty($userinfo)) {
            //Match password
            $hashed_password = $user_info['password'];

            $password = trim(htmlspecialchars(strip_tags($this->password)));

            $match_password = Bcrypt::checkPassword($password, $hashed_password);

            if ($match_password) {
                return $user_info;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //verify Auth key of user
    public function verify_AuthKey()
    {
        global $database;
        $this->auth_key = trim(htmlspecialchars(strip_tags($this->auth_key)));

        $sql = "SELECT apiuser_id, firstname, lastname, email, auth_key FROM " . $this->table . "
        WHERE auth_key = '" . $database->escape_value($this->auth_key) . "'";

        $result = $database->query($sql);
        $ApiUserInfo = $database->fetch_row($result);

        if (empty($ApiUserInfo)) {
            return false;
        } else {
            return true;
        }
    }
}

//Instanciate the class Apiusers
$api_user = new Apiusers();
