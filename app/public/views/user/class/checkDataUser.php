<?php

use config\database;

require_once __DIR__ . '/../../check/dataCheck.php';
require_once __DIR__ . '/../../config/database.php';

/**
 * class to check data send by user
 */
class checkDataUser extends dataCheck
{
    /**
     * @param string $email
     *
     * @return bool
     *
     * function to check if the email is valid
     */
    public static function checkEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
    /**
     * @param string $password
     * @param string $passwordConfirm
     *
     * @return bool
     *
     * function to check if the password and the password confirm are the same
     */
    public static function checkPassword(string $password, string $passwordConfirm): bool
    {
        return $password === $passwordConfirm;
    }
    
    /**
     * @param string $password
     *
     * @return string
     *
     * function to secure the password
     */
    public static function securePassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    
    /**
     * @param string $email
     * @return bool
     *
     * function to check if the email is already used
     */
    public static function checkEmailExist(string $email):bool
    {
        $db = database::getInstance();
        $request = "SELECT email FROM users WHERE email = :email";
        $parameters = ["email" => $email];
        $response = $db->select($request, $parameters);
        if (!empty($response))
        {
            return true;
        }
        return false;
    }
    
    /**
     * @param string $email
     * @return array
     *
     * function to get information of user
     */
    public static function getUser(string $email):array
    {
        $db = database::getInstance();
        $request = "SELECT * FROM users WHERE email = :email";
        $parameters = ["email" => $email];
        return $db->select($request, $parameters);
    }
    
    /**
     * @param array $infoUser
     * @return void
     *
     * function to create session
     */
    public static function createSession(array $infoUser):void
    {
        session_start();
        $_SESSION["id"] = $infoUser[0]["id"];
        $_SESSION["firstname"] = $infoUser[0]["firstname"];
        $_SESSION["lastname"] = $infoUser[0]["lastname"];
        $_SESSION["email"] = $infoUser[0]["email"];
        $_SESSION["permission"] = $infoUser[0]["permission"];
        
    }
    
    /**
     * @return void
     *
     * function to destroy session
     */
    public static function destroySession():void
    {
        session_start();
        session_destroy();
    }
}
