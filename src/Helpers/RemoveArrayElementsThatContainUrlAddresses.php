<?php

namespace FourOver\Helpers;

class RemoveArrayElementsThatContainUrlAddresses
{
    /**
     * @param mixed $value
     * @return boolean
     */
    private static function isUrl($value) {
        // Use a regular expression to check if the value is a URL
        return preg_match('/^https?:\/\/[^\s]+$/', $value);
    }
    
    /**
     * @param array Reference to an array
     * @return void
     */
    public static function removeUrlsFromArray(array &$array) : void {
        foreach ($array as $key => $value) {
            if(is_array($value)) {
                // If the value is an array, recursively call the function
                self::removeUrlsFromArray($array[$key]);
            } elseif (self::isUrl($value)) {
                // If the value is a URL, remove it from the array
                unset($array[$key]);
            }
        }
    }
}