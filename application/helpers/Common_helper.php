<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('commonfunction'))
{
    function commonfunction($params)
    {
        //Your code here
    }
}

if (!function_exists('validateDate'))
{
    function validateDate($params)
    {
        if (stripos($date,":")) {
            $d = DateTime::createFromFormat('Y-m-d H:i:s', $date);
            $format = "Y-m-d H:i:s";
        } else {
            $d = DateTime::createFromFormat('Y-m-d', $date);
            $format = "Y-m-d";
        }
        return $d && ($d->format($format) === $date) ;          
    }
}

if (!function_exists('debug'))
{
    function debug($data){
    	echo "<pre>";
        print_r($data);
        echo "</pre>";
    	die();
    }
}

if (!function_exists('checkSession'))
{
    function checkSession($id) {
        $CI =& get_instance();
        if ($CI->session->userdata($id)) return true;
        return false;
    }
}

if (!function_exists('setAlert'))
{
    /**
     * @param type String enum warning, default, danger, info, success
     * @param message String 
     */
    function setAlert($type, $message) {
        $CI =& get_instance();
        $CI->session->set_flashdata('alert', true);
        $CI->session->set_flashdata('alerttype', $type);
        $CI->session->set_flashdata('alertmessage', $message);
    }
}