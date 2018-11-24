<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Load External Function on Core Directory
 */
require_once(APPPATH.'core/autoload.php');

class Setting extends ModelController {

    public function __construct() 
    {
        $options = array(
            'modulename' => 'User',
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

}