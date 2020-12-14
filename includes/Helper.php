<?php

//Class Helper

class Helper
{
    protected $Message;

    protected $Location;

    public function __construct()
    {
        $this->Message = '';
        $this->Location = '';
    }

    public function redirect()
    {
        header('Location: ' . $this->Location);
    }

    //Set flash Message for success
    public function set_flash_message()
    {
        $_SESSION['flash_message']['success'] = $this->Message;
        header('Location: ' . $this->Location);
    }

    //Set flash Message for warning
    public function set_flash_message_Warn()
    {
        $_SESSION['flash_message']['warning'] = $this->Message;
        header('Location: ' . $this->Location);
    }

    //Set flash Message for error
    public function set_flash_message_Error()
    {
        $_SESSION['flash_message']['error'] = $this->Message;
        header('Location: ' . $this->Location);
    }

    //Methods to access private attributes
    public function __get($key)
    {
        switch ($key) {
            case 'Message':
                return $this->Message;
                break;

            case 'Location':
                return $this->Location;
                break;

            default:
                die("Accessing the getter attribute {$key} that does not exist. \n");
        }
    }

    public function __set($key, $value)
    {
        switch ($key) {
            case 'Message':
                $this->Message = $value;
                break;

            case 'Location':
                $this->Location = $value;
                break;

            default:
                die("Accessing the getter attribute {$key} that does not exist. \n");
        }
    }
}


//Initiate the Helper class

$helper = new Helper();