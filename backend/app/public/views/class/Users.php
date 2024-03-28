<?php

namespace class;

use Data;
use config\database;

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../class/Data.php';

class Users extends Data
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
    public function checkDataInscript(): array
    {
        $length = [255, 255, 255, 255];
        $fields = ["firstname", "lastname", "email", "password"];

        // check if the data is empty
        if (
            Data::isEmpty($this->firstname) ||
            Data::isEmpty($this->lastname) ||
            Data::isEmpty($this->email) ||
            Data::isEmpty($this->password) ||
            Data::isEmpty($this->passwordConfirm)
        )
        {
            return ['success' => false, 'message' => 'Veuillez remplir tous les champs'];
        }

        // check if the length of the data are not too long
        for ($i = 0; $i < count($fields); $i++)
        {
            $field = $fields[$i];
            if (Data::isTooLong($this->$field, $length[$i]))
            {
                return ['success' => false, 'message' => 'Le champ ' . $fields[$i] . ' est trop long'];
            }
        }

        // check if the password and the password confirm are the same
        if (!Data::isSame($this->password, $this->passwordConfirm))
        {
            return ['success' => false, 'message' => 'Les mots de passe ne sont pas identiques'];
        }

        //check if the email is valid
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL))
        {
            return ['success' => false, 'message' => 'L\'email n\'est pas valide'];
        }

        // check if the email exist in the database
        if (Data::emailExist($this->email))
        {
            return ['success' => false, 'message' => 'L\'email existe déjà'];
        }
        return ['success' => true, 'message' => 'Inscription réussie'];
    }

    /**
     * @return void
     *
     * function to insert the data in the database
     */
    public function insertData(): void
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

    /**
     * @return array
     * function to check the data connection
     */

    public function checkDataConnection(): array
    {
        if (Data::isEmpty($this->email) || Data::isEmpty($this->password))
        {
            return ['success' => false, 'message' => 'Veuillez remplir tous les champs'];
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL))
        {
            return ['success' => false, 'message' => 'L\'email n\'est pas valide'];
        }

        $db = database::getInstance();
        $request = $db->select("SELECT * FROM Users WHERE email = :email", ['email' => $this->email]);
        if (empty($request))
        {
            return ['success' => false, 'message' => 'L\'email n\'existe pas'];
        }

        if (!password_verify($this->password, $request[0]['password']))
        {
            return ['success' => false, 'message' => 'Le mot de passe est incorrect'];
        }

        return ['success' => true, 'message' => 'Connexion réussie'];
    }

    /**
     * @return void
     * function to set in session the user id
     */
    public function setSession(): void
    {
        $db = database::getInstance();
        session_start();
        $request = $db->select("SELECT * FROM Users WHERE email = :email", ['email' => $this->email]);
        $_SESSION['user_id'] = $request[0]['id'];
        $_SESSION['user_firstname'] = $request[0]['firstname'];
        $_SESSION['user_lastname'] = $request[0]['lastname'];
        $_SESSION['user_email'] = $request[0]['email'];
        $_SESSION['user_permission_id'] = $request[0]['permission_id'];
    }

    /**
     * @return void
     * function to unset the session
     */
    public function unsetSession(): void
    {
        session_start();
        session_unset();
        session_destroy();
    }

    /**
     * @return array
     * this function is used to get the data of the user
     */
    public function getUserInfo():array
    {
        session_start();
        $db = database::getInstance();
        $request = $db->select("SELECT * FROM Users WHERE id = :id", ['id' => $_SESSION['user_id']]);
        return [
            'user_id' => $request[0]['id'],
            'firstname' => $request[0]['firstname'],
            'lastname' => $request[0]['lastname'],
            'email' => $request[0]['email'],
            'user_permission_id' => $request[0]['permission_id']
        ];
    }

    /**
     * @return void
     * this function is used to delete the user
     */
    public function deleteUser():void
    {
        session_start();
        $db = database::getInstance();
        $request = "DELETE FROM Users WHERE id = :id";
        $parameters = [':id' => $_SESSION['user_id']];
        $db->modifyData($request, $parameters);
    }

    /**
     * @return void
     * this method is used to update the date of the last connection of the user
     */
    public function updateDateConnection(): void
    {
        $db = database::getInstance();
        $request = "UPDATE Users SET date_last_connection = :date WHERE id = :id";
        $parameters = [
            ':date' => date('Y-m-d H:i:s'),
            ':id' => $_SESSION['user_id']
        ];
        $db->modifyData($request, $parameters);
    }

    /**
     * @return array
     * this function is to check if data are correct to update the profile
     */
    public function checkDataUpdate(): array
    {
        $length = [255, 255, 255, 255];
        $fields = ["firstname", "lastname", "email", "password"];

        // check if the data is empty
        if (
            Data::isEmpty($this->firstname) ||
            Data::isEmpty($this->lastname) ||
            Data::isEmpty($this->email) ||
            Data::isEmpty($this->password) ||
            Data::isEmpty($this->passwordConfirm)
        )
        {
            return ['success' => false, 'message' => 'Veuillez remplir tous les champs'];
        }

        // check if the length of the data are not too long
        for ($i = 0; $i < count($fields); $i++)
        {
            $field = $fields[$i];
            if (Data::isTooLong($this->$field, $length[$i]))
            {
                return ['success' => false, 'message' => 'Le champ ' . $fields[$i] . ' est trop long'];
            }
        }

        //check if the email is valid
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL))
        {
            return ['success' => false, 'message' => 'L\'email n\'est pas valide'];
        }

        // check if the email exist in the database
        if (Data::emailExist($this->email) and $_SESSION['user_email'] !== $this->email)
        {
            return ['success' => false, 'message' => 'L\'email existe déjà'];
        }
        return ['success' => true, 'message' => 'Modification réussie'];
    }

    /**
     * @return void
     * this function is used to update the user data
     */
    public function updateData(): void
    {
        $db = database::getInstance();
        $request = "UPDATE Users SET firstname = :firstname, lastname = :lastname, email = :email, password = :password, date_last_connection = :date WHERE id = :id";
        $parameters = [
            ':firstname' => $this->firstname,
            ':lastname' => $this->lastname,
            ':email' => $this->email,
            ':password' => password_hash($this->password, PASSWORD_DEFAULT),
            ':date' => date('Y-m-d H:i:s'),
            ':id' => $_SESSION['user_id']
        ];
        $db->modifyData($request, $parameters);
    }


}


