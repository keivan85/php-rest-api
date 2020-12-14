<?php

// class Forms
class Forms
{

    // Create html
    protected $HTML;

    //Array for Sticky data
    protected $StickyData;

    //Array for checkign array
    protected $ValidationError;

    public function __construct()
    {
        $this->StickyData = [];
        $this->ValidationError = [];
    }

    //Create form_open
    public function form_open($Action, $id)
    {
        $this->HTML = '<form action="' . htmlspecialchars($Action) . '" method="post" id="' . $id . '" enctype="multipart/form-data">';
    }

    //Create input field
    public function makeInput($LabelText, $ControlName)
    {
        //The stickyData is empty at the begining
        $StickyValue = "";

        if (isset($this->StickyData[$ControlName])) {
            $StickyData = $this->StickyData[$ControlName];
        }

        //Error message will be empty in the begining
        $ErrorMessage = "";

        if (isset($this->ValidationError[$ControlName])) {
            $ErrorMessage = $this->ValidationError[$ControlName];
        }

        //Create html
        $this->HTML .= '<div class="form-group"> 
        <label for="' . $ControlName . '">' . $LabelText . '</label>
        <input type = "text" name="' . $ControlName . '"class="form-control value"' . $StickyValue . '" placeholder = "Enter ' . $ControlName . '">
        <div id="errorMessage">' . $ErrorMessage . '</div>
        </div>';
    }

    //Create Email
    public function makeInputEmail($LabelText, $ControlName)
    {
        //The stickyData is empty at the begining
        $StickyValue = "";

        if (isset($this->StickyData[$ControlName])) {
            $StickyData = $this->StickyData[$ControlName];
        }

        //Error message will be empty in the begining
        $ErrorMessage = "";

        if (isset($this->ValidationError[$ControlName])) {
            $ErrorMessage = $this->ValidationError[$ControlName];
        }

        //Create html
        $this->HTML .= '<div class="form-group"> 
        <label for="' . $ControlName . '">' . $LabelText . '</label>
        <input type = "email" name="' . $ControlName . '"class="form-control value"' . $StickyValue . '" placeholder = "Enter ' . $ControlName . '">
        <div id="errorMessage">' . $ErrorMessage . '</div>
        </div>';
    }

    //Create Password
    public function makePassword($LabelText, $ControlName)
    {
        //The stickyData is empty at the begining
        $StickyValue = "";

        if (isset($this->StickyData[$ControlName])) {
            $StickyData = $this->StickyData[$ControlName];
        }

        //Error message will be empty in the begining
        $ErrorMessage = "";

        if (isset($this->ValidationError[$ControlName])) {
            $ErrorMessage = $this->ValidationError[$ControlName];
        }

        //Create html
        $this->HTML .= '<div class="form-group"> 
            <label for="' . $ControlName . '">' . $LabelText . '</label>
            <input type = "password" name="' . $ControlName . '"class="form-control value"' . $StickyValue . '" placeholder = "Enter ' . $ControlName . '">
            <div id="errorMessage">' . $ErrorMessage . '</div>
            </div>';
    }

    //Create submit
    public function makeSubmit($ControlName)
    {

        $this->HTML .= '<input type="submit" class="btn btn-primary" name="' . $ControlName . '" value="' . $ControlName . '">';
    }

    //Validation methods
    public function checkEmpty($ControlName)
    {

        $Value = "";
        if (isset($this->StickyData[$ControlName]) == TRUE) {
            $Value = $this->StickyData[$ControlName];
        } else {
            $this->ValidationError[$ControlName] = 'Must not be empty';
        }
    }

    //Compare two values
    public function compare($Control1, $Control2)
    {

        if ($this->StickyData[$Control1] != $this->StickyData[$Control2]) {

            $this->ValidationError[$Control2] = 'Values are not equal';
        }
    }

    //Check email has valid format
    public function checkEmail($ControlName)
    {

        $Value = '';
        if (isset($this->StickyData[$ControlName]) == TRUE) {
            $Value = $this->StickyData[$ControlName];
        }

        if (!filter_var($Value, FILTER_VALIDATE_EMAIL)) {
            $this->ValidationError[$ControlName] = 'The meail format is not valid';
        }
    }

    //Raise custom errors
    public function raiseCustomError($Control, $ErrorMessage)
    {
        $this->ValidationError[$Control] = $ErrorMessage;
    }

    //Methods to access the private attribues
    public function __get($key)
    {
        switch ($key) {
            case 'HTML':
                return $this->HTML . '</form>';
                break;

            case 'valid':
                if (count($this->ValidationError) == 0) {
                    return true;
                } else {
                    return false;
                }
                break;

            default:
                die("Accessing the getter attribute {$key} that does not exist. \n");
        }
    }

    //Method to set attribute
    public function __set($key, $value)
    {
        switch ($key) {
            case 'StickyData':
                $this->StickyData = $value;
                break;

            default:
                die("Accessing the getter attribute {$key} that does not exist. \n");
        }
    }
}

//Instanciate the Class
$form = new Forms();
