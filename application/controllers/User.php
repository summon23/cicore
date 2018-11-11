<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    private $tableName = 'users';

    function __construct() 
    {
        parent::__construct($this->tableName);
    }

    function index() {
        $this->view->genView('user/index');
    }

    function ajaxRequest($invoke = "") 
    {
        /**
         * Add Validation for API request only
         */
        if ($invoke === "") return "Invocation Type Required";
        $invokeType = strtolower($invoke);
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $table = $this->tableName;
        // echo $invokeType;
        switch ($invokeType) {
            case 'getuser':
            
                $user = $this->db->query("SELECT * from $table");
                $data = array();

                foreach($user->result() as $r) {
                    $data[] = array(
                         $r->email,
                         $r->username,
                         $r->password
                    );
               }
     
                $output = array(
                    'data' => $data,
                    "recordsTotal" => $user->num_rows(),
                    "recordsFiltered" => $user->num_rows()
                );
                // debug($output);
                echo json_encode($output);
                exit();
                break;
            /**
             * Add New Case To Register New Query Invocation
             */
            default:
                return "Invocation Type Not Registered";
                break;
        }

        // return $this->DataTables->getRequest();
    }

}