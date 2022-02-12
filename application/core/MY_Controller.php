<?php 

class MY_Controller extends CI_Controller
{
	var $title='';
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');		
		$this->load->model('Globalmodel');	
		$this->title = "অভিযোগ";	
	}
}

class Admin_Controller extends MY_Controller 
{
	var $permission = array();
	public function __construct() 
	{
		parent::__construct();	
		$userdtls=$this->session->userdata('userdtls');

		//echo '<pre>';
		//print_r(unserialize($userdtls[0]->ug_permission));
		
		if(!empty($userdtls))
		{
			if(!$userdtls[0]->logged_in) {			
				redirect('Login', 'refresh');
			}
			else
			{
				$this->data['user_permission'] = unserialize($userdtls[0]->ug_permission);
				$this->permission = unserialize($userdtls[0]->ug_permission);
				//echo '<pre>';
				//print_r($userdtls);						
			}
		}
		else{
			redirect('Login', 'refresh');
		}
		
	}

	public function render_template($page = null, $data = array())
	{
		//`al_description`, `al_ip`, `al_flag`, `al_date_time`, `al_userid
		/*$acitvity=array('al_description'=>$page.' is opened', 
						'al_ip'=>$this->input->ip_address(),
						'al_flag'=>1,
						'al_date_time'=>date('Y-m-d H:i:s'),
						'al_userid'=>$this->session->userdata('userid')
						);
		$this->Globalmodel->savedata('activity_log',$acitvity);						
		*/


		$this->load->view('template/header',$this->data);		
		$this->load->view('template/sidemenu',$this->data);
		$this->load->view($page, $this->data);
		$this->load->view('template/footer',$this->data);

	}
	
	public function basic_table_data()
	{
		
	}
}
