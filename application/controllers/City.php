<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Load External Function on Core Directory
 */
require_once(APPPATH.'core/autoload.php');

class City extends ModelController {

    protected $options = array(
        'modulename' => 'City',
        'route' => 'city',
        'tablename' => 'master_city',       
        'modelfield' => array(
            'id' => array(
                'type' => 'hidden',
                'name' => 'id',
                'fieldname' => 'ID'
            ),
            'nama' => array(
                'type' => 'text',
                'name' => 'nama',
                'fieldname' => 'City Name'
            ),
            'initial' => array(
                'type' => 'text',
                'name' => 'initial',
                'fieldname' => 'initial'
            ),
            'status' => array(
                'type' => 'text',
                'name' => 'status',
                'fieldname' => 'status'
            )
        )
    );

    public function __construct() 
    {        
        parent::__construct($this->options);
    }

    function ajaxRequest($invoke = "get") 
    {
        /**
         * Add Validation for API request only
         */
        if ($invoke === "") return "Invocation Type Required";
        $invokeType = strtolower($invoke);
        $params = $this->input->get();
        $query = $this->datatables->getQuery($params);
        $model = $this->options;
        extract($query);
        $where = 1;
        $order = '';

        $column = array();
        foreach ($model['modelfield'] as $key => $value) {
            if ($value['type'] != 'hidden') array_push($column, $key);
        }

        if (array_key_exists('filter', $query)) {
            $key = $query['filter'];
            $condition = array();
            foreach ($this->options['modelfield'] as $k => $v) {
                array_push($condition, $k.' like "%'.$key.'%" ');
            }
            $where = ' ('.join(" OR ", $condition).') ';
        }

        if (array_key_exists('sortcolumn', $query)) {
            if ($query['sortcolumn'] != 0) {
                $order = ' ORDER BY '.$column[$query['sortcolumn'] -1].' '.$query['sortdir'];
            }
        }

        $table = $model['tablename'];
        switch ($invokeType) {
            case 'get':
                $sql = "SELECT * FROM $table WHERE `is_delete` = 0 AND $where $order";
                $allData = $this->db->query($sql)->num_rows();
                $sql .= " LIMIT $limit OFFSET $offset";
                $user = $this->db->query($sql);
                $limitData = $user->num_rows();
                
                $data = array();
                $no = $offset + 1;
                foreach($user->result() as $r) {
                    $res = array($no);
                    foreach ($column as $key => $value) {
                        array_push($res, $r->$value);
                    }
                    array_push($res, $r->id);
                    $data[] = $res;
                    $no++;
               }
     
                $output = array(
                    'data' => $data,
                    'draw' => $draw,
                    "recordsTotal" => $allData,
                    "recordsFiltered" => $allData,
                );
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
    }

}