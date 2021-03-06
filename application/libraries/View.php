<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View {
	public function genView($view = '', $params = array(), $singlePage = false)
	{
		$CI =& get_instance();
		if ($singlePage) {
			return $CI->load->view('themes/'.THEME.'/'.$view, $params);
		} else {
			$menu = self::getMenu();
			// debug($params);
			$data['activemenu'] = array_key_exists('activemenu', $params) ? $params['activemenu'] : 'Dashboard';
			$data['viewname'] = $view;
			$data['params'] = $params;
			$data['menu'] = $menu;
			return $CI->load->view('themes/'.THEME.'/index', $data);
		}				
	}

	public static function getMenu()
	{
		$CI =& get_instance();
		$menu = array();
		$getMenu = $CI->db->query('SELECT * from menu')->result(); //put is active
		foreach ($getMenu as $key => $value) {
			
			$getSubmenu = $CI->db->query('SELECT * from submenu where id_menu='.$value->id)->result();
			$submenu = array();
			foreach ($getSubmenu as $k => $v) {
				array_push($submenu, $v);
			}
			$value->submenu = $submenu;
			array_push($menu, $value);
		}

		return $menu;
	}

    public function genView2($view='',$data = array())
	{	
		$CI =& get_instance();
		// $data['menuGrant'] = DataHandler::selectData('up.`id_menu`,up.`id_submenu`,m.`menu_name`,sm.`submenu_name`,m.`image`,m.`content`','`user_priviledge` AS up JOIN menu AS m ON m.`id` = up.`id_menu` JOIN sub_menu AS sm ON sm.`id` = up.`id_submenu` ','id_user ='.$CI->session->userdata('id'),'m.sort_position asc','up.id_menu');
		// $data['subMenuGrant'] = DataHandler::selectData('up.`id_menu`,up.`id_submenu`,m.`menu_name`,sm.`submenu_name`,m.`image`,m.`content`','`user_priviledge` AS up JOIN menu AS m ON m.`id` = up.`id_menu` JOIN sub_menu AS sm ON sm.`id` = up.`id_submenu` ','id_user ='.$CI->session->userdata('id'),'sm.sort_position asc','up.id_submenu');
		// $getFoto = DataHandler::selectData('foto,name,group_name','users as u join user_group as ug on u.user_group = ug.id ','u.id='.$CI->session->userdata('id'));
		// $data['foto'] = $getFoto[0]->foto;
		// $data['name'] = $getFoto[0]->name;
		// $data['userGroup'] = $getFoto[0]->group_name;
		// if ($view=="") {
			// $view = "dashboard/dashboard";
		// }
		// $webSetttings = DataHandler::selectData('value','web_settings');
		// if (!(isset($data['title']))) {
			// $data['title'] = $webSetttings[0]->value;
		// }
		// $data['year'] = $webSetttings[1]->value;
		// $data['version'] = $webSetttings[2]->value;
		
		$CI->load->view('themes/'.THEME.'/layout/header',$data);
		$CI->load->view('themes/'.THEME.'/layout/sidebar',$data);
		$CI->load->view('themes/'.THEME.'/'.$view,$data);
		$CI->load->view('themes/'.THEME.'/layout/footer',$data);
    }
    
    public function throwError()
    {
		return $this->genView('default/error');
	}

    public function throwForbidden()
    {
		return $this->genView('default/error');
	}

	public function returnJSON($response)
	{
		$CI =& get_instance();
		$CI->load->library('output');
		$json = json_encode($response);
		return $CI->output->set_content_type('application/json')->set_output($json);
	}
}