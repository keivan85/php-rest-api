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
}
