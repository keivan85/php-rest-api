<?php
require_once('../includes/Database.php');
require_once('../includes/Bcrypt.php');


//Class Users

class Users
{
    private $table = 'users';

    //users properties

    public $user_id;
    public $firstname;
    public $lastname;
    public $email;
    public $passwrod;
    public $status;

    public function __construct()
    {
    }

    //Validating user params
    public function validate_param($value)
    {
        if (!empty($value)) {
            return true;
        }
        return false;
    }

    //Check unique email
    public function check_unique_email()
    {
        global $database;

        $this->email = trim(htmlspecialchars(strip_tags($this->email)));

        $sql = "SELECT user_id FROM " . $this->table . " WHERE email = '" . $database->escape_value($this->email) . "'";

        $result = $database->query($sql);

        $UserInfo = $database->fetch_row($result);

        if (empty($UserInfo)) {
            return true;
        } else {
            return false;
        }
    }

    //Create user
    public function create_User()
    {
        //clean data
        $this->firstname = trim(htmlspecialchars(strip_tags($this->firstname)));
        $this->lastname = trim(htmlspecialchars(strip_tags($this->lastname)));
        $this->email = trim(htmlspecialchars(strip_tags($this->email)));
        $this->passwrod = trim(htmlspecialchars(strip_tags($this->passwrod)));


        //Hash the password using Bcrypt
        $hashed_password = Bcrypt::hashPassword($this->passwrod);

        global $database;

        $sql = "INSERT INTO $this->table (firstname, lastname, email, password)
            VALUES ('" . $database->escape_value($this->firstname) . "',
                    '" . $database->escape_value($this->lastname) . "',
                    '" . $database->escape_value($this->email) . "',
                    '" . $database->escape_value($hashed_password) . "')";



        try {
            $user_saved = $database->query($sql);
            return true;
        }
        //catch exception
        catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            return false;
        }
    }

    //Check user credentials

    public function check_user_credentials()
    {
        global $database;

        $this->email = trim(htmlspecialchars(strip_tags($this->email)));

        $sql = "SELECT user_id, email, password FROM" . $this->table .
            "WHERE email = '" . $database->escape_value($this->email) . "'";

        $result = $database->query($sql);
        $info = $database->fetch_row($result);

        if (!empty($info)) {
            $hashedPassword = $info['password'];

            $passwrod = trim(htmlspecialchars(strip_tags($this->passwrod)));

            $match_password = Bcrypt::checkPassword($passwrod, $hashedPassword);

            if ($match_password) {
                return $this->get_UserDetails();
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //Function to get user details
    public function get_UserDetails()
    {
        global $database;

        $this->email = trim(htmlspecialchars(strip_tags($this->email)));

        $sql = "SELECT user_id, firstname, lastname, email FROM" . $this->table .
            "WHERE email = '" . $database->escape_value($this->email) . "'";

        $result = $database->query($sql);
        $userInfo = $database->fetch_row($result);

        return $userInfo;
    }
}

$user = new Users();
