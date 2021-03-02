<?php

namespace App\Helpers;

use RuntimeException;

class JsonHelper
{
    public static function jsonOrEmpty(String $string)
    {
        if (!isset($string) || empty($string)) {
            // throw new RuntimeException('Argument is not a string or is empty');
            return array();
        }
        $data = json_decode((string) $string, true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            // throw new RuntimeException('Unable to parse response body into JSON: ' . json_last_error());
            return array();
        }

        return $data === null ? array() : $data;
    }
}
