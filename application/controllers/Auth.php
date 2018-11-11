<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public $dashboardController = '/home';

    public function __construct() {
        parent::__construct();

    }

    public function index()
    {
        if ($this->session->userdata('authLogin')) {
            redirect($dashboardController, 'refresh');
        } else {
            return $this->view->genView('login');
        }
    }
    
    public function doAuth()
    {
        $userdata = $this->input->post(NULL);
        
        // form validation
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[4]');
        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('warning', 'Username tidak valid');
            redirect('/auth', 'refresh');
        }

        // get data
        $getUserData = $this->db->where('email', $userdata['username'])
                                // ->where('password', md5($userdata['password']))
                                ->get('users')
                                ->result();        
             
        if (empty($getUserData)) {
            $this->session->set_flashdata('warning', 'Username atau Password salah');
            return redirect('/auth', 'refresh');
        }

        if ($getUserData[0]->status === 0) {
            $this->session->set_flashdata('warning', 'User tidak aktif');
            return redirect('/auth', 'refresh');
        }

        if (count($getUserData)) {
            $userSession = array(
                'id' => $getUserData[0]->id,
                'username' => $getUserData[0]->username,
                'authLogin' => true                
            );
            $this->session->set_userdata($userSession);
            return redirect($dashboardController);
        }
    }

    public function doLogout()
    {
        $this->session->sess_destroy();
        return redirect('/auth');
    }
    
}
