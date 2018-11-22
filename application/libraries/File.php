<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File {
    public function upload($options = array())
    {
        $CI =& get_instance();

        try {
            if (!array_key_exists('path', $options) ||
            !array_key_exists('filetoupload', $options))
                throw new Exception('Options Failure, Please check all options requirment');
            }

            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 100;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;

            $CI->load->library('upload', $config);

            if (!$this->upload->do_upload('filetoupload')){
                $error = array('error' => $this->upload->display_errors());
                throw new Exception($error);
            }
            $data = array('upload_data' => $this->upload->data());
            $this->load->view('upload_success', $data);
            return $data;    
        } catch (Exception $e) {
            throw $e;
        }
       
    }

    public function download($options = array())
    {
        
    }
}