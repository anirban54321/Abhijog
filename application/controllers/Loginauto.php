<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loginauto extends My_Controller 
{
	public function __construct()
    {
        parent::__construct();
		date_default_timezone_set('Asia/Kolkata');	
		$this->load->model('Loginmodel');	
    }
	
	public function index()
	{	
		
		
	   $this->checklogin();
	

	}

	public function checklogin()
	{	
		
				$username=trim($this->input->get('username'));
				$password=trim($this->input->get('password'));
				
				
					$data=$this->Loginmodel->get_user_data($username);

					if(count($data)>0)
					{
						$dbpassword=$this->encrypt->decode($data[0]->u_password);							
						
						if($password==$dbpassword)
						{
							$data[0]->logged_in=true;
							$this->session->set_userdata('userdtls',$data);
							
							if(in_array('userlevelcase',unserialize($data[0]->ug_permission)))
							{
								redirect('Dashboard/user');
							}
							else
							{
								redirect('Dashboard');
							}
							
						}
						else
						{
							$this->session->set_flashdata('errmsg','Wrong Username or Password');
							redirect('Login');	
						}						
					}
					else{
						$this->session->set_flashdata('errmsg','Username not Found');
						redirect('Login');	
					}
				
		
	}
	 
	function logout()
	{
	  $this->session->sess_destroy(); 
	  delete_cookie('username'); 
	  delete_cookie('password');  
	  redirect('Login');
	}		
	 
	public function staffMail($from,$to,$subject,$msg)
	{
		 $config = Array(                 
         'mailtype'  => 'html',
         'charset'  => 'iso-8859-1',
         'wordwrap'  => TRUE
        );
	    $this->load->library('email', $config);
	  
	    $this->email->set_newline("\r\n");
		$this->email->from('admin@sahajpath.com', 'Admin | '.$from);
		$this->email->to($to);		
		$this->email->subject($subject);
		$this->email->message($msg);		
		
		if ( ! $this->email->send())
		{
			print_r('error');
		}	
		$this->email->clear();
		return 1;		
	} 
}
