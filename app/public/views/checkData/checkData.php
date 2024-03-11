<?php

use config\database;

require_once __DIR__  . '/../config/database.php';

// this class is used to check data
class checkData
{
    /**
     * This function is used to check if the data is empty
     * @param string $data
     * @return bool
     */
    public static function isEmpty(string $data):bool
    {
        return empty($data);
    }

    /**
     * this function is used to clear the data
     * @param string $data
     * @return string
     */
    public static function clearData(string $data):string
    {
        return htmlspecialchars($data);
    }

    /**
     * This function is to check if the length of data are not too long
     * @param string $data
     * @param int $length
     * @return bool
     */
    public static function isTooLong(string $data, int $length):bool
    {
        return strlen($data) > $length;
    }

    /**
     * This function is used to check if 2 informations are the same
     * @param string $data1
     * @param string $data2
     * @return bool
     */
    public static function isSame(string $data1, string $data2):bool
    {
        return $data1 === $data2;
    }


    /**
     * This function is used to check if the email exist in the database
     * @param string $email
     * @return bool
     */
    public static function emailExist(string $email):bool
    {
        $db = database::getInstance();
        $request = $db->select("SELECT * FROM Users WHERE email = :email", ['email' => $email]);
        return !empty($request);
    }
}