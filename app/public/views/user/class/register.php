<?php

use config\database;

require_once __DIR__ . '/../../check/dataCheck.php';
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/checkDataUser.php';

class registerUser extends checkDataUser
{
    private int $permission;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $password;
    private string $passwordConfirm;
    private string $date_created;
    
    public function __construct(string $firstName, string $lastName, string $email, string $password, string $passwordConfirm)
    {
        $this->permission = 1;
        $this->firstName = self::clearText($firstName);
        $this->lastName = self::clearText($lastName);
        $this->email = self::clearText($email);
        $this->password = self::clearText($password);
        $this->passwordConfirm = self::clearText($passwordConfirm);
        $this->date_created = date('Y-m-d');
    }
    
    /**
     * @return string
     *
     * function to get email
     */
    public function getEmail(): string
    {
        return $this->email;
    }
    
    /**
     * @return string
     *
     * function to get password
     */
    public function getPassword(): string
    {
        return $this->password;
    }
    
    /**
     * @param string $password
     *
     * @return void
     *
     * function to update password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
    
    /**
     * @return bool|string
     *
     * function to check if data are correct
     */
    public function checkData(): bool|string
    {
        // check if data are empty
        if (
            self::isEmpty($this->firstName) ||
            self::isEmpty($this->lastName) ||
            self::isEmpty($this->email) ||
            self::isEmpty($this->password) ||
            self::isEmpty($this->passwordConfirm)
        )
        {
            return "Tous les champs doivent être remplis";
        }
        
        // check if email is valid
        if (!self::checkEmail($this->email))
        {
            return "L'adresse email n'est pas valide";
        }
        
        // check if password and password confirm are the same
        if (!self::checkPassword($this->password, $this->passwordConfirm))
        {
            return "Les mots de passe ne sont pas identiques";
        }
        
        // check if the length of fields aren't too long
        $field = ["firstName","lastName","email","password"];
        $length = [127, 127, 255, 255];
        for ($i = 0; $i < count($field); $i++)
        {
            if (self::checkLength($this->$field[$i], $length[$i]))
            {
                return "Le champ " . $field[$i] . " est trop long";
            }
        }
        
        return true;
    }
    
    /**
     * @return void
     *
     * function to register a new user
     */
    public function register():void
    {
        $db = database::getInstance();
        $request = "INSERT INTO users (permission, first_name, last_name, email, password, date_created, date_last_connection)
                                VALUES (:permission, :first_name, :last_name, :email, :password, :date_created, :date_last_connection)";
        $parameters = [
            "permission" => $this->permission,
            "first_name" => $this->firstName,
            "last_name" => $this->lastName,
            "email" => $this->email,
            "password" => self::securePassword($this->password),
            "date_created" => $this->date_created,
            "date_last_connection" => $this->date_created
        ];
        $db->modifyData($request, $parameters);
    }
    
    
}