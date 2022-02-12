
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Group extends Admin_Controller 
{
	public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');	        
    }

    public function index()
	{
        //$this->data['user']=$this->Globalmodel->getdata('*','users','u_id','asc');
        $this->render_template('usergroup/index', $this->data);
    }

    public function create()
	{
        $this->render_template('usergroup/create', $this->data);
    }

    public function manage()
	{
        $ug_id=rawurldecode($this->encrypt->decode($_GET['q']));	        
        $this->data['user_group']=$this->Globalmodel->getdata_by_field_array('*','user_group',array('ug_id'=>$ug_id),'ug_id', 'asc');
        $this->render_template('usergroup/manage', $this->data);
    }
   
    public function saveUserGroup()
	{
        $this->form_validation->set_rules('u_title', 'Name', 'required');

        $this->form_validation->set_error_delimiters('<div class="text-danger font-weight-bold">', '</div>');
        
        //a:6:{i:0;s:7:"allcase";i:1;s:10:"createcase";i:2;s:10:"updatecase";i:3;s:8:"viewcase";i:4;s:11:"createusers";i:5;s:11:"updateusers";}

        if ($this->form_validation->run() == FALSE) 
		{

            $data=array(             
                'ug_name'=>$this->input->post('ug_name'),  
                'ug_permission'=>serialize($this->input->post('ug_permission')),                             
                'ug_datetime'=>date('Y-m-d H:i'), 
                'ug_flag'=>1,
                'ug_userid'=>$this->session->userdata('userdtls')[0]->u_id             
            );
            //echo '<pre>';
            //print_r($data);
            $this->Globalmodel->savedata('user_group',$data);
            $this->session->set_flashdata('successmsg','User Group Successfully Created');	
            redirect('User_Group');
        }
        else{
            $this->render_template('users/create', $this->data);
        }
    }
    
    public function updateUserGroup()
	{
        $ug_id=rawurldecode($this->encrypt->decode($_GET['q']));		        
        $data=array(             
            'ug_name'=>$this->input->post('ug_name'),  
            'ug_permission'=>serialize($this->input->post('ug_permission')),                             
            'ug_datetime'=>date('Y-m-d H:i'), 
            'ug_flag'=>1,
            'ug_userid'=>$this->session->userdata('userdtls')[0]->u_id             
        );
        //echo '<pre>';
        //print_r($data);
        $this->Globalmodel->updatedata('user_group','ug_id',$ug_id,$data);
        $this->session->set_flashdata('successmsg','User Group Successfully Updated');	
        redirect('User_Group');
    } 

    public function deleteUserGroup()
	{
        $id=rawurldecode($this->encrypt->decode($_GET['q']));	
		$this->Globalmodel->deletedata('user_group','ug_id',$id);
		$this->session->set_flashdata('delmsg','User_Group Successfully Deleted');
		redirect('User_Group');
    } 

    public function getUserGroup()
	{
        $users=$this->Globalmodel->getdata('*','user_group','ug_id', 'asc');
        $data = array();
        $i=1;
		foreach($users as $r)
		{
            $str='';
            $str.='<a role="button" href="'.base_url('User_Group/manage?q='.urlencode($this->encrypt->encode($r->ug_id))).'" class="btn waves-effect waves-light btn-info btn-sm"><i class="fas fa-edit"></i> </a>';                                                        
            $str.='&nbsp;<a role="button" href="'.base_url('User_Group/deleteUserGroup?q='.urlencode($this->encrypt->encode($r->ug_id))).'" class="btn waves-effect waves-light btn-danger btn-sm"><i class="fas fa-trash"></i> </a>';                            			

            $sub_array = array();
            $sub_array[] = $i++;
            $sub_array[] = $r->ug_name;            
            $sub_array[] = $str;
			$data[] = $sub_array;
		}

		$output = array(			
			"data"   =>  $data
		   );
		   
		echo json_encode($output);
    }


}   


