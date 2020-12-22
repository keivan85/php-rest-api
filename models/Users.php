<?php
require_once('../includes/Database.php');
require_once('../includes/Bcrypt.php');


//Class Users

class Users {
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
    public function validate_param($value) {
        if (!empty($value)) {
            return true;
        }
        return false;
    }

    //Check unique email
    public function check_unique_email() {
        global $database;

        $this->email = trim(htmlspecialchars(strip_tags($this->email)));

        $sql = "SELECT user_id FROM ".$this->table." WHERE email = '".$database->escape_value($this->email)."'";

        $result = $database->query($sql);

        $UserInfo = $database->fetch_row($result);

        if (empty($UserInfo)) {
            return true;
        } else {
            return false;
        }
    }

}

$user = new Users();
?>