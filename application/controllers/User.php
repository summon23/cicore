<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Load External Function on Core Directory
 */
require_once(APPPATH.'core/autoload.php');

class User extends ModelController {

    public function __construct() 
    {
        $options = array(
            'modulename' => 'User',
            'route' => 'user',
            'tablename' => 'users',       
            'modelfield' => array(
                'id' => array(
                    'type' => 'hidden',
                    'name' => 'id',
                    'fieldname' => 'ID'
                ),
                'name' => array(
                    'type' => 'text',
                    'name' => 'name',
                    'fieldname' => 'User'
                ),
                'email' => array(
                    'type' => 'email',
                    'name' => 'email',
                    'fieldname' => 'Email Address'
                )
            )
        );
        parent::__construct($options);
    }

    // function view($params = array()) {
    //     $params = array(
    //         'activemenu' => 'User',
    //         'pagetitle' => 'User',
    //         'route' => 'user'
    //     );
    //     $this->view->genView('user/index', $params);
    // }

    function ajaxRequest($invoke = "") 
    {
        /**
         * Add Validation for API request only
         */
        if ($invoke === "") return "Invocation Type Required";
        $invokeType = strtolower($invoke);
        $params = $this->input->get();
        $where = 1;
        // debug($where);
        if (array_key_exists('search', $params)) {
            $key = $params['search']['value'];
            $where = ' (name like "%'.$key.'%" or email like "%'.$key.'%")';
        }
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        // debug($this->datatables->getQuery($params));
        $table = 'users';
        // echo $invokeType;
        switch ($invokeType) {
            case 'get':
            
                $user = $this->db->query("SELECT * from $table where is_delete = 0 and $where");
                $data = array();

                $no = $start + 1;
                foreach($user->result() as $r) {
                    $data[] = array(
                         $no,
                         $r->email,
                         $r->name,
                         $r->password,
                         $r->id
                    );
                    $no++;
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