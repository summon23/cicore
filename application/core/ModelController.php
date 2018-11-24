<?php
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class ModelController extends CI_Controller {

    protected $modelOptions;
    
    /**
     * Contruct with options class
     * @param options Array
     */
    public function __construct($options)
    {

        // Check Options Class Validation
        extract($options);
        if (!isset($modulename)
            || !isset($route)
            || !isset($tablename)
        ) {
            throw New Exception('Check Model Requirement');
        }

        $this->modelOptions = $options;        
        parent::__construct();
    }

    /**
     * Redirect index to view method
     * @param params Array
     */
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
        extract($this->modelOptions);
        $params['route'] = $route;
        $params['activemenu'] = $modulename;
        $params['pagetitle'] = $modulename;
        $params['modelfield'] = $modelfield;
        // debug($this->modelField);
        $this->view->genView('model/view', $params);
    }

    /**
     * Redirect to Create Page
     * @param params Array
     */
    public function create($params = array())
    {
        // extract($this->modelOptions);
        $model = $this->modelOptions;
        // debug($this->modelOptions)
        
        $params['modeloptions'] = $this->modelOptions;
        // $params['route'] = $route;
        $params['activemenu'] = $model['modulename'];
        $params['pagetitle'] = $model['modulename'];
        // $params['modelfield'] = $modelfield;
        $this->view->genView('model/create', $params);
    }

    /**
     * Redirect to Detail Page
     * @param id String
     */
    public function detail($id, $readonly = true)
    {
        // extract($this->modelOptions);
        $model = $this->modelOptions;
        $getDetailData = $this->db->query("SELECT * from ".$model['tablename']." where id =".$id)->result_array();
        if (empty($getDetailData)) {
            // throw not found
        }

        $params = array();        
        $params['modeloptions'] = $this->modelOptions;
        $params['activemenu'] = $model['modulename'];
        $params['pagetitle'] = 'Detail '.$model['modulename'];
        $params['data'] = array_shift($getDetailData);
        // $params['modelfield'] = $modelfield;  
        $params['readonly'] = $readonly;
        return $this->view->genView('model/detail', $params);
    }

    /**
     * Redirect to Edit Page
     * @param id String
     */
    public function update($id)
    {
        $this->detail($id, false);
    }

    /**
     * Redirect to Delete Action
     * @param id String
     */
    public function delete($id)
    {        
        $this->action('delete', array('id' => $id));
    }

    /**
     * Action Method
     * @param actionMode String
     */
    public function action($actionMode, $params = array())
    {
        $model = $this->modelOptions;
        $payload = $this->input->post();
        try {
            switch ($actionMode) {
                case 'save':
                    // Check Access
                    $this->db->insert($model['tablename'], $payload);
                    $insertedId = $this->db->insert_id();
                    setAlert('success', $model['modulename'].' Created');   
                    break;
                case 'edit':
                    // Check Access
                    $this->db->where('id', $payload['id']);
                    $this->db->update($model['tablename'], $payload);
                    setAlert('success', $model['modulename'].' Updated');
                    break;
                case 'delete':
                    // Check Access
                    $this->db->where('id', $params['id']);
                    $this->db->update($model['tablename'], array(
                        'is_delete' => 1
                    ));
                    setAlert('success', $model['modulename'].' Deleted');
                    break;
                default:
                    # code...
                    break;
            }
            redirect($model['route'].'/view');
        } catch (Exception $err) {
            setAlert('warning', 'Action Failure');
            redirect($_SERVER['HTTP_REFERER']);
        }        
    }
}