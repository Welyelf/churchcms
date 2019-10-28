<?php defined('BASEPATH') OR exit('No direct script access allowed');

function string_max_length($string, $max_length)
{
    if (!is_string($string)) {
        log_message('debug', 'No string provided.');
        return "";
    }
    if (!is_int($max_length) || $max_length < 3) {
        $max_length = 50;
        log_message('debug', 'No length provided for string_max_length function when trimming {$string}. Defaulted to max length of 50.');
    }
    if (strlen($string) > $max_length) {
        return mb_strimwidth($string, 0, $max_length - 2, '...');
    } else {
        return $string;
    }
}