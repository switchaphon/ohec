<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if( !function_exists('convert_to_yyyy-mm-dd') ) {
    function convert_to_yyyymmdd($input = null) {
        $format = 'Y-m-d';
        $ts = strtotime($input);
        return date($format,$ts);
    }
}