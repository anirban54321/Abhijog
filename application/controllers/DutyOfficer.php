<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DutyOfficer extends Admin_Controller 
{
	public function __construct()
    {
        parent::__construct();
		date_default_timezone_set('Asia/Kolkata');			
    }
	
	public function index()
	{	
		$this->render_template('dutyofficer/index', $this->data);
	}

	public function create()
	{
		$this->data['section']=$this->Globalmodel->getdata_by_field_array('*','divisions',array('d_flag'=>'1'),'d_id', 'asc');	        		
		$this->render_template('dutyofficer/create', $this->data);		
	}

	public function edit()
	{
		$do_id=rawurldecode($this->encrypt->decode($_GET['q']));
		$this->data['section']=$this->Globalmodel->getdata_by_field_array('*','divisions',array('d_flag'=>'1'),'d_id', 'asc');	        		
		$this->data['do']=$this->Globalmodel->getdata_by_field_array('*','duty_officer',array('do_id'=>$do_id),'do_id', 'asc');	        
		$this->render_template('dutyofficer/edit', $this->data);		
	}

	public function saveDutyOfficer()
	{
		if(in_array('usercase',$this->permission))
        {
			$do_section=$this->session->userdata('userdtls')[0]->u_id;
		}
		else 
		{
			$do_section=$this->input->post('do_section');
		}
		$data=array( 
			'do_section'=>$do_section,		           
            'do_designation'=>$this->input->post('do_designation'),
            'do_name'=>$this->input->post('do_name'), 
            'do_phoneno'=>$this->input->post('do_phoneno'),              
            'do_datetime'=>date('Y-m-d H:i'), 
            'do_flag'=>1, 
            'do_userid'=>$this->session->userdata('userdtls')[0]->u_id
        );
        //echo '<pre>';
        //print_r($data);
        $this->Globalmodel->savedata('duty_officer',$data);
        $this->session->set_flashdata('successmsg','DutyOfficer Successfully Updated');	
        redirect('DutyOfficer');
	}

	public function updateDutyOfficer()
	{
		$do_id=rawurldecode($this->encrypt->decode($_GET['q']));
		if(in_array('usercase',$this->permission))
        {
			$do_section=$this->session->userdata('userdtls')[0]->u_id;
		}
		else 
		{
			$do_section=$this->input->post('do_section');
		}
		$data=array(            
			'do_section'=>$do_section,			           
            'do_designation'=>$this->input->post('do_designation'),
            'do_name'=>$this->input->post('do_name'), 
            'do_phoneno'=>$this->input->post('do_phoneno'),              
            'do_datetime'=>date('Y-m-d H:i'), 
            'do_flag'=>1, 
            'do_userid'=>$this->session->userdata('userdtls')[0]->u_id
        );
        //echo '<pre>';
        //print_r($data);        
		$this->Globalmodel->updatedata('duty_officer','do_id',$do_id,$data);
        $this->session->set_flashdata('successmsg','Duty Officer Successfully Updated');	
        redirect('DutyOfficer');
	}

	public function deleteDutyOfficer()
	{
		$id=rawurldecode($this->encrypt->decode($_GET['q']));	
		$this->Globalmodel->deletedata('duty_officer','do_id',$id);
		$this->session->set_flashdata('successmsg','Duty Officer  Successfully Deleted');
		redirect('DutyOfficer');
	}

	public function getDutyOfficer()
	{   
        $data = array();  
		if(in_array('usercase',$this->permission))
        {
			$userid=$this->session->userdata('userdtls')[0]->u_id;
        	//$this->data['do']=$this->Globalmodel->getdata_by_field_array('*','duty_officer',array('do_section'=>$userid),'do_id', 'asc');	        
			$this->data['do']=$this->Globalmodel->getdata_by_field_join_array('duty_officer','do_section','divisions','d_id',array('do_userid'=>$userid),'do_id', 'asc');
		}
		else
		{
			//$this->data['do']=$this->Globalmodel->getdata_by_field_array('*','duty_officer',array(),'do_id', 'asc');	        
			$this->data['do']=$this->Globalmodel->getdata_by_field_join_array('duty_officer','do_section','divisions','d_id',array(),'do_id', 'asc');
		}

        $do=$this->data['do'];
        $i=1;
		foreach($do as $r)
		{
            $sub_array = array();
            $sub_array[] = $i++;            
            $str='';     

			if(in_array('updatedo',$this->permission))
            { 
            $str.='&nbsp;<a role="button" href="'.base_url('DutyOfficer/edit?q='.urlencode($this->encrypt->encode($r->do_id))).'" class="btn waves-effect waves-light btn-primary btn-sm" title="Edit Duty Officer"><i class="fas fa-edit"></i></a>';                            
			}
			if(in_array('deletedo',$this->permission))
            { 
			$str.='&nbsp;<a role="button" href="'.base_url('DutyOfficer/deleteDutyOfficer?q='.urlencode($this->encrypt->encode($r->do_id))).'" class="btn waves-effect waves-light btn-danger btn-sm"  title="Delete Duty Officer"><i class="fas fa-trash"></i> </a>';                            
			}
			if($r->do_flag==1)	
			{
            	$str.='&nbsp;<a role="button" href="'.base_url('DutyOfficer/activateDutyOfficer?q='.urlencode($this->encrypt->encode($r->do_id))).'" class="btn waves-effect waves-light btn-warning btn-sm"  title="Deactivate Duty Officer"><i class="fas fa-times"></i> </a>';                            
			}
			else
			{
				$str.='&nbsp;<a role="button" href="'.base_url('DutyOfficer/activateDutyOfficer?q='.urlencode($this->encrypt->encode($r->do_id))).'" class="btn waves-effect waves-light btn-success btn-sm"  title="Activate Duty Officer"><i class="fas fa-check"></i> </a>';                            
			}
			$sub_array[] = $r->d_name;     
			$sub_array[] = $r->do_designation;     
            $sub_array[] = $r->do_name;   
            $sub_array[] = $r->do_phoneno;                                 
            $sub_array[] = $str;
			$data[] = $sub_array;
		}
		$output = array(			
			"data"   =>  $data
		   );		   
		echo json_encode($output);
    }

	public function activateDutyOfficer()
	{
		$id=rawurldecode($this->encrypt->decode($_GET['q']));	
		$this->Globalmodel->activate('duty_officer','do_id',$id,'do_flag');	
		$this->session->set_flashdata('successmsg','Duty Officer Successfully Updated');
		redirect('DutyOfficer');
	}
}
