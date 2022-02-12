<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends My_Controller 
{
	public function __construct()
    {
        parent::__construct();
		date_default_timezone_set('Asia/Kolkata');	
		$this->load->model('Loginmodel');	
    }
	
	public function index()
	{	
		
		if(get_cookie('username')!='' && get_cookie('password')!='' )
		{
			$username=get_cookie('username'); 
			$password=get_cookie('password'); 

			echo '<pre>';
			echo $username;
			echo $password;
			
			/*
			$data=$this->Loginmodel->get_user_data($username);

			if(count($data)>0)
			{
				$dbpassword=$this->encrypt->decode($data[0]->u_password);							
				//$pass=$this->encrypt->encode('123456');	
				//echo '<pre>';
				//echo $password;						
				//echo  $dbpassword;
				
				
				if($password==$dbpassword)
				{
					$data[0]->logged_in=true;
					$this->session->set_userdata('userdtls',$data);


					//echo '<pre>';
					//print_r($this->session->userdata('userdtls'));
					//print_r($this->session->userdata('userdtls'));

					
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
			*/
		}
		else
		{
			$this->load->view('login'); 
		} 

	}

	public function checklogin()
	{	
		
		$url = "https://www.google.com/recaptcha/api/siteverify";
		$data = [
			'secret' => "6LdHDqobAAAAALRfVUHpr-Sb1kW2DM5MvEbSAMb9",
			'response' => $this->input->post('token'),
			// 'remoteip' => $_SERVER['REMOTE_ADDR']
		];

		$options = array(
		    'http' => array(
		      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		      'method'  => 'POST',
		      'content' => http_build_query($data)
		    )
		  );

		$context  = stream_context_create($options);
  		$response = file_get_contents($url, false, $context);

		$res = json_decode($response, true);
		if($res['success'] == true) {
			
		
				$username=trim($this->input->post('username'));
				$password=trim($this->input->post('password'));

				$remember=trim($this->input->post('remember'));
				
				//echo $remember;
				
				$this->form_validation->set_rules('username', 'Username', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');
				
				$this->form_validation->set_error_delimiters('<div class="text-danger font-weight-bold">', '</div>');
				
				if($remember=="on")
				{
					set_cookie('username',$username,'3600'); 		
					set_cookie('password',$password,'3600'); 
				}
				
				if ($this->form_validation->run() == TRUE) 
				{
					$data=$this->Loginmodel->get_user_data($username);

					if(count($data)>0)
					{
						$dbpassword=$this->encrypt->decode($data[0]->u_password);							
						//$pass=$this->encrypt->encode('123456');	
						//echo '<pre>';
						//echo $password;						
						//echo  $dbpassword;
						
						if($password==$dbpassword)
						{
							$data[0]->logged_in=true;
							$this->session->set_userdata('userdtls',$data);


							//echo '<pre>';
							//print_r($this->session->userdata('userdtls'));
							//print_r($this->session->userdata('userdtls'));
							
							$userlog=array( 
								'ul_userid'=>$this->session->userdata('userdtls')[0]->u_id,
								'ul_ipadd'=>$this->input->ip_address(),						
								'ul_datetime'=>date('Y-m-d H:i:s')						
								);
							$this->Globalmodel->savedata('users_log',$userlog);	


							if(in_array('usercase',unserialize($data[0]->ug_permission)))
							{
								redirect('Dashboard/PS');
							}
							else
							{
								redirect('Dashboard/Superior');
							}
							//redirect('Dashboard');
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
				else{
					$this->load->view('login');
				}
		
				
		}else{
			$this->session->set_flashdata('errmsg','Sorry ! Google reCaptcha incomplete.');
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
