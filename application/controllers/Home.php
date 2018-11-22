<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		return $this->view->genView('dashboard/home');
	}

	public function dashboard()
	{
		// return $this->load->view('themes/metronic/index');
		return $this->view->genView('dashboard2');
		// return $this->view->genView('dashboard');
	}

	public function emptypage()
	{
		return $this->view->genView('empty');
	}

	public function sendMail()
	{			
		$body = '';
		try {
			$config = array(
				'to' => 'andreymahdison@gmail.com',
				'name' => 'Andry Mahdison',
				'subject' => 'This is dummy email',
				'body' => $body
			);
			$s = $this->emailservice->sendMail($config);
			return true;
		} catch (Exception $e) {
			return $e->getMessage();
		}	
	}	
}
