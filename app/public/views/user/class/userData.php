<?php

    require_once __DIR__  . '/../../config/database.php';
    require_once __DIR__  . '/../../checkData/checkData.php';

    class users extends checkData
    {
        private $firstname;
        private $lastname;
        private $email;
        private $password;
        private $passwordConfirm;

        public function __construct($firstname, $lastname, $email, $password, $passwordConfirm)
        {
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->email = $email;
            $this->password = $password;
            $this->passwordConfirm = $passwordConfirm;
        }
    }


