<?php

// this class is used to check data
class checkData
{
    /**
     * This function is used to check if the data is empty
     * @param string $data
     * @return bool
     */
    public static function isEmpty($data):bool
    {
        return empty($data) ? true : false;
    }

    /**
     * this function is used to clear the data
     * @param string $data
     * @return string
     */
    public static function clearData($data):string
    {
        return htmlspecialchars($data);
    }

    /**
     * This function is to check if the length of data are bigger than the max length
     * @param string $data
     * @param int $length
     * @return bool
     */
    public static function isBiggerThan($data, $length):bool
    {
        return strlen($data) > $length;
    }
}