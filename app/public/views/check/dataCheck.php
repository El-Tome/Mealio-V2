<?php
/**
 * class to check data
 */
class dataCheck
{
    /**
     * @param string $field
     *
     * @return bool
     *
     * function to check if the field is empty
     */
    public function isEmpty(string $field): bool
    {
        return empty($field);
    }
    
    /**
     * @param string $field
     *
     * @return string
     *
     * function to clear text
     */
    public function clearText(string $field): string
    {
        return htmlspecialchars($field);
    }
    
    /**
     * @param string $field
     * @param int $length
     *
     * @return bool
     *
     * function to check the length of the field
     */
    public function checkLength(string $field, int $length): bool
    {
        return strlen($field) > $length;
    }
    
}