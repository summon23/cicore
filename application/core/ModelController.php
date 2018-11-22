<?php
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class ModelController extends CI_Controller {

    protected $tableName;
    protected $modelField;   
    protected $modelName;
    
    public function __construct($options)
    {
        // Check Options Class Validation
        $this->tableName = $options['tablename'];
        $this->modelField = $options['modelfield'];
        $this->modelName = $options['modulename'];
        parent::__construct();
    }

    public function index($params = array())
    {
        $this->view($params);
    }


    /**
     * Redirect to Main View Page 
     * @param params Array
     */
    public function view($params = array())
    {        
        $this->view->genView('model/view', $params);
    }

    /**
     * Redirect to Detail Page
     * @param id String
     */
    public function detail($id)
    {
        $params = array();
        $getDetailData = $this->db->query("SELECT * from ".$this->tableName);
        $params['pagetitle'] = 'Detail '.$this->modelName;
        $params['data'] = $getDetailData->result();
        $params['modelfield'] = $this->modelField;

        // debug($getDetailData->result());
        return $this->view->genView('model/detail', $params);
    }

    /**
     * Action Method
     * @param actionMode String
     */
    public function action($actionMode)
    {
        switch ($actionMode) {
            case 'save':
                # code...
                break;
            case 'edit':
                # code...
                break;
            case 'delete':
                # code...
                break;
            default:
                # code...
                break;
        }
    }
}