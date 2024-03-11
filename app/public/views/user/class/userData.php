<?php

use config\database;

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

        /**
         * @return array
         *
         * function to check the data
         */
        public function checkData()
        {
            $length = [255, 255, 255, 255];
            $fields = ["firstname", "lastname", "email", "password"];

            // check if the data is empty
            if (checkData::isEmpty($this->firstname) || checkData::isEmpty($this->lastname) || checkData::isEmpty($this->email) || checkData::isEmpty($this->password) || checkData::isEmpty($this->passwordConfirm)) {
                return ['success' => false, 'message' => 'Veuillez remplir tous les champs'];
            }

            // check if the length of the data are not too long
            for ($i = 0; $i < count($fields); $i++) {
                $field = $fields[$i];
                if (checkData::isTooLong($this->$field, $length[$i])) {
                    return ['success' => false, 'message' => 'Le champ ' . $fields[$i] . ' est trop long'];
                }
            }

            // check if the password and the password confirm are the same
            if (!checkData::isSame($this->password, $this->passwordConfirm)) {
                return ['success' => false, 'message' => 'Les mots de passe ne sont pas identiques'];
            }

            //check if the email is valid
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                return ['success' => false, 'message' => 'L\'email n\'est pas valide'];
            }

            // check if the email exist in the database
            if (checkData::emailExist($this->email)) {
                return ['success' => false, 'message' => 'L\'email existe déjà'];
            }
            return ['success' => true, 'message' => 'Inscription réussie'];
        }

        /**
         * @return void
         *
         * function to insert the data in the database
         */
        public function insertData()
        {
            $db = database::getInstance();
            $request = "INSERT INTO Users (permission_id, firstname, lastname, email, password, date_creation, date_last_connection) 
                        VALUES (:permission_id, :firstname, :lastname, :email, :password, :date_creation, :date_last_connection)";
            $parameters = [
                ':permission_id' => 1,
                ':firstname' => $this->firstname,
                ':lastname' => $this->lastname,
                ':email' => $this->email,
                ':password' => password_hash($this->password, PASSWORD_DEFAULT),
                ':date_creation' => date('Y-m-d H:i:s'),
                ':date_last_connection' => date('Y-m-d H:i:s')
            ];
            $db->modifyData($request, $parameters);
        }
    }


