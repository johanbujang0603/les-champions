<?php

if (! function_exists('get_string')) {
    function get_string(string $string) : string
    {
        return is_string(__($string)) ? __($string) : $string;
    }
}
