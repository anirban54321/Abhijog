<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ComplainNature extends Admin_Controller 
{
	public function __construct()
    {
        parent::__construct();
		date_default_timezone_set('Asia/Kolkata');			
    }
	
	public function index()
	{	
		$this->render_template('complainnature/index', $this->data);
	}

	public function create()
	{
		$this->render_template('complainnature/create', $this->data);		
	}

	public function edit()
	{
		$do_id=rawurldecode($this->encrypt->decode($_GET['q']));
		$this->data['cn']=$this->Globalmodel->getdata_by_field_array('*','complain_nature',array('cn_id'=>$do_id),'cn_id', 'asc');	        
		$this->render_template('complainnature/edit', $this->data);		
	}

	public function saveComplainNature()
	{
		$data=array(                       
            'cn_name'=>$this->input->post('cn_name'),             
            'cn_datetime'=>date('Y-m-d H:i'), 
            'cn_flag'=>1, 
            'cn_userid'=>$this->session->userdata('userdtls')[0]->u_id
        );
        //echo '<pre>';
        //print_r($data);
        $this->Globalmodel->savedata('complain_nature',$data);
        $this->session->set_flashdata('successmsg','Complain Nature Successfully Updated');	
        redirect('ComplainNature');
	}

	public function updateComplainNature()
	{
		$cn_id=rawurldecode($this->encrypt->decode($_GET['q']));
		$data=array(                       
            'cn_name'=>$this->input->post('cn_name'),             
            'cn_datetime'=>date('Y-m-d H:i'), 
            'cn_flag'=>1, 
            'cn_userid'=>$this->session->userdata('userdtls')[0]->u_id
        );
        //echo '<pre>';
        //print_r($data);        
		$this->Globalmodel->updatedata('complain_nature','cn_id',$cn_id,$data);
        $this->session->set_flashdata('successmsg','Complain Nature Successfully Updated');	
        redirect('ComplainNature');
	}

	public function deleteComplainNature()
	{
		$id=rawurldecode($this->encrypt->decode($_GET['q']));	
		$this->Globalmodel->deletedata('complain_nature','cn_id',$id);
		$this->session->set_flashdata('successmsg','Complain Nature  Successfully Deleted');
		redirect('ComplainNature');
	}

	public function getComplainNature()
	{   
        $data = array();        
        $this->data['cn']=$this->Globalmodel->getdata('*','complain_nature','cn_name','asc'); 
        $do=$this->data['cn'];
        $i=1;
		foreach($do as $r)
		{
            $sub_array = array();
            $sub_array[] = $i++;            
            $str='';     

			if(in_array('updatedo',$this->permission))
            { 
            $str.='&nbsp;<a role="button" href="'.base_url('ComplainNature/edit?q='.urlencode($this->encrypt->encode($r->cn_id))).'" class="btn waves-effect waves-light btn-primary btn-sm" title="Edit Duty Officer"><i class="fas fa-edit"></i></a>';                            
			}
			if(in_array('deletedo',$this->permission))
            { 
			$str.='&nbsp;<a role="button" href="'.base_url('ComplainNature/deleteComplainNature?q='.urlencode($this->encrypt->encode($r->cn_id))).'" class="btn waves-effect waves-light btn-danger btn-sm"  title="Delete Duty Officer"><i class="fas fa-trash"></i> </a>';                            
			}
			if($r->cn_flag==1)	
			{
            	$str.='&nbsp;<a role="button" href="'.base_url('ComplainNature/activateComplainNature?q='.urlencode($this->encrypt->encode($r->cn_id))).'" class="btn waves-effect waves-light btn-warning btn-sm"  title="Deactivate Duty Officer"><i class="fas fa-times"></i> </a>';                            
			}
			else
			{
				$str.='&nbsp;<a role="button" href="'.base_url('ComplainNature/activateComplainNature?q='.urlencode($this->encrypt->encode($r->cn_id))).'" class="btn waves-effect waves-light btn-success btn-sm"  title="Activate Duty Officer"><i class="fas fa-check"></i> </a>';                            
			}			
            $sub_array[] = $r->cn_name;               
            $sub_array[] = $str;
			$data[] = $sub_array;
		}
		$output = array(			
			"data"   =>  $data
		   );		   
		echo json_encode($output);
    }

	public function activateComplainNature()
	{
		$id=rawurldecode($this->encrypt->decode($_GET['q']));	
		$this->Globalmodel->activate('complain_nature','cn_id',$id,'cn_flag');	
		$this->session->set_flashdata('successmsg','Complain Nature Successfully Updated');
		redirect('ComplainNature');
	}
}
