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

    
}
?>