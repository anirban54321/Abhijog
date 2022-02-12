<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends My_Controller 
{
	public function __construct()
    {
        parent::__construct();
		date_default_timezone_set('Asia/Kolkata');				
    }
	
	public function index()
	{	
		$this->data['ps']=$this->Globalmodel->getdata_by_field_array('*','pstation',array(),'ps_id', 'asc');
		$this->load->view('register',$this->data);		 
	}		
	 
	public function save()
	{
        /*
        $url = "https://www.google.com/recaptcha/api/siteverify";
		$data = [
			'secret' => "6LfRx6cZAAAAAHZCqmVZ-SDgC3Vwbb7CwGF9mhcH",
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
        */    
           
            $this->form_validation->set_rules('u_emailid', 'Name', 'required');        
            $this->form_validation->set_rules('u_password1', 'Password', 'required');
            $this->form_validation->set_rules('u_password2', 'Confirm Password', 'required|matches[u_password1]');
    
            $this->form_validation->set_error_delimiters('<div class="text-danger font-weight-bold">', '</div>');
            
            //a:6:{i:0;s:7:"allcase";i:1;s:10:"createcase";i:2;s:10:"updatecase";i:3;s:8:"viewcase";i:4;s:11:"createusers";i:5;s:11:"updateusers";}
    
            if ($this->form_validation->run() == TRUE) 
            {
                $ps_id=$this->input->post('u_psid');
                $ps_emailid=$this->input->post('u_emailid');   
                $this->data['ps']=$this->Globalmodel->getdata_by_field_array('*','pstation',array('ps_id'=>$ps_id),'ps_id', 'asc');
                $ps_name=$this->data['ps'][0]->ps_name;
    
                $data=array(  
                    'u_ugid'=>3, 
                    'u_psid'=>$this->input->post('u_psid'),
                    'u_title'=>$ps_name,            
                    'u_emailid'=>$this->input->post('u_emailid'),            
                    'u_username'=>$this->input->post('u_emailid'),            
                    'u_password'=>$this->encrypt->encode($this->input->post('u_password1')),                 
                    'u_datetime'=>date('Y-m-d H:i'), 
                    'u_flag'=>1,
                    'u_userid'=>0,
                    'u_ip'=>$this->input->ip_address()
                );           		
                $this->Globalmodel->savedata('users',$data);
                
                /*update of ps emailid */
                $data2=array('ps_emailid'=>$ps_emailid);
                $this->Globalmodel->updatedata('pstation','ps_id',$ps_id,$data2);
                /*update of ps emailid */
    
               
                $this->session->set_flashdata('successmsg','Registration Completed. Thank You For Registration');	
                redirect('Register');
                
            }
            else{
                $this->data['ps']=$this->Globalmodel->getdata_by_field_array('*','pstation',array(),'ps_id', 'asc');
                $this->load->view('register',$this->data);
            }
         

        /*
        }else{
                $this->session->set_flashdata('errmsg','Sorry ! Google Repatcha Incomplete');	        
                redirect('Register');
        }
        */
                
	}
    
    
    public function isExistUser()
	{
        $ps_id=$this->input->post('ps_id');
        //$token=$this->input->post('token');
        //$token = $this->security->get_csrf_hash();
        //$ps_id=3;

        $this->data['user']=$this->Globalmodel->getdata_by_field_array('*','users',array('u_psid'=>$ps_id),'u_id', 'asc');        
        if(count($this->data['user'])>0){
            $str='<script>
                        Swal.fire({
                            title: "'.$this->title.'",
                            text: "Already User !",
                            type: "error",
                            showCancelButton: false,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Ok"
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "'.base_url('Login').'";
                            }
                        })
                </script>';
            //print_r(json_encode(array("msg"=>'xyz',"token"=>$token)));                
            echo $str;
        }
        
        /*
        else{
            echo '<script>
                    Swal.fire("'.$this->title.'", "Not a User", "success")
                 </script>';
        }*/
    }

	public function sendRegistrationMail($from,$to,$subject,$msg)
	{
		 $config = Array(                 
         'mailtype'  => 'html',
         'charset'  => 'iso-8859-1',
         'wordwrap'  => TRUE
        );
	    $this->load->library('email', $config);
	  
	    $this->email->set_newline("\r\n");
		$this->email->from('admin@Dr.Social', 'Admin | '.$from);
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
