<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Security {
    public function checkPermission($userId)
    {
    
    }

    public function cleanupData($data)
    {
        $CI =& get_instance();
        $CI->load->library('security');
        $data = $this->security->xss_clean($data);
        return $data;
    }
}