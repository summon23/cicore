<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// use PHPExcel;
// use PHPExcel_IOFactory;
// use PHPExcel_Style_Alignment;

class Home extends CI_Controller {
	public function excel()
	{
		// $this->load->library('excel');
		$excel = $this->excel->getContext();
		
		//activate worksheet number 1
		$excel->setActiveSheetIndex(0);
		//name the worksheet
		$excel->getActiveSheet()->setTitle('test worksheet');
		//set cell A1 content with some text
		$excel->getActiveSheet()->setCellValue('A1', 'This is just some text value');
		//change the font size
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
		//make the font become bold
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		//merge cell A1 until D1
		$excel->getActiveSheet()->mergeCells('A1:D1');
		//set aligment to center for that merged cell (A1 to D1)
		// $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$options = array(
			'filename' => 'just_some_random_name.xls'
		);
		return $this->excel->writeExcel($excel, $options);							
	}
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
		return $this->view->genView('dashboard');
		// return $this->view->genView('dashboard/home');
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
