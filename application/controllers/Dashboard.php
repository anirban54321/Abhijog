<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller 
{
	public function __construct()
    {
        parent::__construct();
		date_default_timezone_set('Asia/Kolkata');	
		$this->load->model('Mailmodel');		
    }

	public function Superior()
	{	
		/*$sessdata=$this->session->userdata('userdtls');	  
		echo '<pre>';
		print_r($this->data);
		print_r($sessdata);		
		*/		
		//print_r($user_permission);
		//print_r($this->data['user_permission']);			
		$this->load->model('Usermodel');
		
		$userid=$this->session->userdata('userdtls')[0]->u_id;	
		//print_r(date('Y-m-d', strtotime('-1 day')));
		$yesterday=date('Y-m-d', strtotime('-1 day'));
		$this->data['mail']=$this->Mailmodel->get_current_month_mail(array('MONTH(mt_date)'=>date('m'),'YEAR(mt_date)'=>date('Y')));		
		$this->data['disposed']=$this->Mailmodel->get_current_month_mail(array('MONTH(mt_date)'=>date('m'),'YEAR(mt_date)'=>date('Y'),'mt_disposed'=>'Yes'));
		$this->data['pending']=$this->Mailmodel->get_current_month_mail(array('MONTH(mt_date)'=>date('m'),'YEAR(mt_date)'=>date('Y'),'mt_disposed'=>'No'));
		$this->data['do']=$this->Globalmodel->getdata_by_field_join_array('duty_officer','do_section','divisions','d_id',array('do_flag'=>'1'),'do_id','asc');
		//$this->Globalmodel->getdata('*','duty_officer','do_id','asc');				
		$this->data['todays']=$this->Globalmodel->getdata_by_field_array('*','mail_tracking',array('mt_date'=>date('Y-m-d')),'mt_id', 'asc');
		$this->data['yesterday']=$this->Globalmodel->getdata_by_field_array('*','mail_tracking',array('mt_date'=>$yesterday),'mt_id', 'asc');
		$this->data['allmail']=$this->Globalmodel->getdata_by_field_array('*','mail_tracking',array(),'mt_id', 'asc');				
		$this->data['alldisposed']=$this->Globalmodel->getdata_by_field_array('*','mail_tracking',array('mt_disposed'=>'Yes'),'mt_id', 'asc');				
		$this->data['allpending']=$this->Globalmodel->getdata_by_field_array('*','mail_tracking',array('mt_disposed'=>'No'),'mt_id', 'asc');				
		//print_r(date('Y-m-d'));
		//print_r($this->data['todays']);
		$this->data['users']=count($this->Usermodel->get_user(array()));
		$this->render_template('dashboard/dashboard', $this->data);		
	}
	public function PS()
	{	
		/*$sessdata=$this->session->userdata('userdtls');	  
		echo '<pre>';
		print_r($this->data);
		print_r($sessdata);		
		*/		
		//print_r($user_permission);
		//print_r($this->data['user_permission']);			
		$this->load->model('Usermodel');
		$userid=$this->session->userdata('userdtls')[0]->u_id;	
		//print_r(date('Y-m-d', strtotime('-1 day')));
		$yesterday=date('Y-m-d', strtotime('-1 day'));
		$this->data['mail']=$this->Mailmodel->get_current_month_mail(array('MONTH(mt_date)'=>date('m'),'YEAR(mt_date)'=>date('Y'),'mt_userid'=>$userid));		
		$this->data['disposed']=$this->Mailmodel->get_current_month_mail(array('MONTH(mt_date)'=>date('m'),'YEAR(mt_date)'=>date('Y'),'mt_disposed'=>'Yes','mt_userid'=>$userid));		
		$this->data['pending']=$this->Mailmodel->get_current_month_mail(array('MONTH(mt_date)'=>date('m'),'YEAR(mt_date)'=>date('Y'),'mt_disposed'=>'No','mt_userid'=>$userid));
		$this->data['do']=$this->Globalmodel->getdata_by_field_join_array('duty_officer','do_section','divisions','d_id',array('do_userid'=>$userid,'do_flag'=>'1'),'do_id', 'asc');
		//$this->Globalmodel->getdata('*','duty_officer','do_id','asc');				
		$this->data['todays']=$this->Globalmodel->getdata_by_field_array('*','mail_tracking',array('mt_date'=>date('Y-m-d'),'mt_userid'=>$userid),'mt_id', 'asc');
		$this->data['yesterday']=$this->Globalmodel->getdata_by_field_array('*','mail_tracking',array('mt_date'=>$yesterday,'mt_userid'=>$userid),'mt_id', 'asc');
		$this->data['allmail']=$this->Globalmodel->getdata_by_field_array('*','mail_tracking',array('mt_userid'=>$userid),'mt_id', 'asc');				
		$this->data['alldisposed']=$this->Globalmodel->getdata_by_field_array('*','mail_tracking',array('mt_disposed'=>'Yes','mt_userid'=>$userid),'mt_id', 'asc');				
		$this->data['allpending']=$this->Globalmodel->getdata_by_field_array('*','mail_tracking',array('mt_disposed'=>'No','mt_userid'=>$userid),'mt_id', 'asc');				
		//print_r(date('Y-m-d'));
		//print_r($this->data['todays']);
		$this->data['users']=count($this->Usermodel->get_user(array()));
		$this->render_template('dashboard/dashboard', $this->data);		
		
	}

	public function chartDetails($tab,$category,$mon,$year,$disposed)    
    {
        
		if(in_array('usercase',$this->permission))
        {
          	$userid=$this->session->userdata('userdtls')[0]->u_id;

			if($tab=="Complain" && $category=="current" && $disposed=="all")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail(array('MONTH(mt_date)'=>date('m',strtotime($mon)),'YEAR(mt_date)'=>$year,'mt_userid'=>$userid));                        
			}
			if($tab=="Complain" && $category=="current" && $disposed=="yes")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail(array('MONTH(mt_date)'=>date('m',strtotime($mon)),'YEAR(mt_date)'=>$year,'mt_disposed'=>"Yes",'mt_userid'=>$userid));                        
			}
			if($tab=="Complain" && $category=="current" && $disposed=="no")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail(array('MONTH(mt_date)'=>date('m',strtotime($mon)),'YEAR(mt_date)'=>$year,'mt_disposed'=>"No",'mt_userid'=>$userid));                        
			}
			
			if($tab=="Complain" && $category=="all" && $disposed=="all")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail(array('MONTH(mt_date)'=>$mon,'YEAR(mt_date)'=>$year,'mt_userid'=>$userid));                        
			}
			if($tab=="Complain" && $category=="all" && $disposed=="yes")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail(array('MONTH(mt_date)'=>$mon,'YEAR(mt_date)'=>$year,'mt_disposed'=>"Yes",'mt_userid'=>$userid));                        
			}
			if($tab=="Complain" && $category=="all" && $disposed=="no")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail(array('MONTH(mt_date)'=>$mon,'YEAR(mt_date)'=>$year,'mt_disposed'=>"No",'mt_userid'=>$userid));                        
			}
			
			//print_r($this->data['mail']);

			if($tab=="ComplainNature" && $category=="current")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail(array('MONTH(mt_date)'=>date('m'),'YEAR(mt_date)'=>date('Y'),'cn_name'=>urldecode($disposed),'mt_userid'=>$userid));                        
			}
			if($tab=="ComplainNature" && $category=="all")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail(array('cn_name'=>urldecode($disposed),'mt_userid'=>$userid));                        
			}


			if($tab=="ComplainPie" && $category=="all" && $disposed=="yes")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail(array('mt_disposed'=>"Yes",'mt_userid'=>$userid));                        
			}
			if($tab=="ComplainPie" && $category=="all" && $disposed=="no")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail(array('mt_disposed'=>"No",'mt_userid'=>$userid));                        
			}
			if($tab=="ComplainPie" && $category=="current" && $disposed=="yes")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail(array('MONTH(mt_date)'=>date('m'),'YEAR(mt_date)'=>date('Y'),'mt_disposed'=>"Yes",'mt_userid'=>$userid));                        
			}
			if($tab=="ComplainPie" && $category=="current" && $disposed=="no")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail(array('MONTH(mt_date)'=>date('m'),'YEAR(mt_date)'=>date('Y'),'mt_disposed'=>"No",'mt_userid'=>$userid));                        
			}
			//print_r($this->data['mail']);
		
			/*
			echo $tab;        
			echo $mon;
			echo $year;
			echo $category;
			echo urldecode($disposed);
			die;
			*/
		}
		else
		{
			if($tab=="Complain" && $category=="current" && $disposed=="all")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail(array('MONTH(mt_date)'=>date('m',strtotime($mon)),'YEAR(mt_date)'=>$year));                        
			}
			if($tab=="Complain" && $category=="current" && $disposed=="yes")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail(array('MONTH(mt_date)'=>date('m',strtotime($mon)),'YEAR(mt_date)'=>$year,'mt_disposed'=>"Yes"));                        
			}
			if($tab=="Complain" && $category=="current" && $disposed=="no")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail(array('MONTH(mt_date)'=>date('m',strtotime($mon)),'YEAR(mt_date)'=>$year,'mt_disposed'=>"No"));                        
			}
			
			if($tab=="Complain" && $category=="all" && $disposed=="all")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail(array('MONTH(mt_date)'=>$mon,'YEAR(mt_date)'=>$year));                        
			}
			if($tab=="Complain" && $category=="all" && $disposed=="yes")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail(array('MONTH(mt_date)'=>$mon,'YEAR(mt_date)'=>$year,'mt_disposed'=>"Yes"));                        
			}
			if($tab=="Complain" && $category=="all" && $disposed=="no")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail(array('MONTH(mt_date)'=>$mon,'YEAR(mt_date)'=>$year,'mt_disposed'=>"No"));                        
			}
			
			//print_r($this->data['mail']);

			if($tab=="ComplainNature" && $category=="current")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail(array('MONTH(mt_date)'=>date('m'),'YEAR(mt_date)'=>date('Y'),'cn_name'=>urldecode($disposed)));                        
			}
			if($tab=="ComplainNature" && $category=="all")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail(array('cn_name'=>urldecode($disposed)));                        
			}


			if($tab=="ComplainPie" && $category=="all" && $disposed=="yes")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail(array('mt_disposed'=>"Yes"));                        
			}
			if($tab=="ComplainPie" && $category=="all" && $disposed=="no")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail(array('mt_disposed'=>"No"));                        
			}
			if($tab=="ComplainPie" && $category=="current" && $disposed=="yes")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail(array('MONTH(mt_date)'=>date('m'),'YEAR(mt_date)'=>date('Y'),'mt_disposed'=>"Yes"));                        
			}
			if($tab=="ComplainPie" && $category=="current" && $disposed=="no")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail(array('MONTH(mt_date)'=>date('m'),'YEAR(mt_date)'=>date('Y'),'mt_disposed'=>"No"));                        
			}
			//print_r($this->data['mail']);
		
			/*
			echo $tab;        
			echo $mon;
			echo $year;
			echo $category;
			echo urldecode($disposed);
			die;
			*/
		}
        $this->render_template('complain/search_dtls',$this->data);
    }

    public function chartDetails2($date1,$date2,$disposed)    
    {
        $userid=$this->session->userdata('userdtls')[0]->u_id;
		if(in_array('usercase',$this->permission))
        {	
			if($disposed=="all")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail_between_date_condition(date('Y-m-d',strtotime($date1)),date('Y-m-d',strtotime($date2)),array('mt_userid'=>$userid));                        
			}
			if($disposed=="yes")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail_between_date_condition(date('Y-m-d',strtotime($date1)),date('Y-m-d',strtotime($date2)),array('mt_disposed'=>'Yes','mt_userid'=>$userid));                        
			}
			if($disposed=="no")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail_between_date_condition(date('Y-m-d',strtotime($date1)),date('Y-m-d',strtotime($date2)),array('mt_disposed'=>'No','mt_userid'=>$userid));                        
			}
		}
		else
		{
			if($disposed=="all")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail_between_date_condition(date('Y-m-d',strtotime($date1)),date('Y-m-d',strtotime($date2)),array());                        
			}
			if($disposed=="yes")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail_between_date_condition(date('Y-m-d',strtotime($date1)),date('Y-m-d',strtotime($date2)),array('mt_disposed'=>'Yes'));                        
			}
			if($disposed=="no")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail_between_date_condition(date('Y-m-d',strtotime($date1)),date('Y-m-d',strtotime($date2)),array('mt_disposed'=>'No'));                        
			}
		}
        $this->render_template('complain/search_dtls',$this->data);
    }

    public function chartDetails3($date1,$date2,$subject)    
    {
        $userid=$this->session->userdata('userdtls')[0]->u_id;	
        //echo $subject;
		if(in_array('usercase',$this->permission))
        {
        	$this->data['mail']=$this->Mailmodel->get_all_mail_between_date_condition(date('Y-m-d',strtotime($date1)),date('Y-m-d',strtotime($date2)),array('cn_name'=>urldecode($subject),'mt_userid'=>$userid));                                
		}
		else
		{
			$this->data['mail']=$this->Mailmodel->get_all_mail_between_date_condition(date('Y-m-d',strtotime($date1)),date('Y-m-d',strtotime($date2)),array('cn_name'=>urldecode($subject)));                                
		}
        //print_r($this->data['mail']);
        $this->render_template('complain/search_dtls',$this->data);
    }

    public function chartDetails4($doname,$disposed)    
    {
        $userid=$this->session->userdata('userdtls')[0]->u_id;	
        //echo $subject;
		 //echo $subject;
		 if(in_array('usercase',$this->permission))
		 {
			if($disposed=="all")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail(array('do_name'=>urldecode($doname),'mt_userid'=>$userid));                                
			}
			else
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail(array('do_name'=>urldecode($doname),'mt_disposed'=>$disposed,'mt_userid'=>$userid));                                
			}
		}
		else
		{
			if($disposed=="all")
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail(array('do_name'=>urldecode($doname)));                                
			}
			else
			{
				$this->data['mail']=$this->Mailmodel->get_all_mail(array('do_name'=>urldecode($doname),'mt_disposed'=>$disposed));                                
			}
		}
        //print_r($this->data['mail']);
        $this->render_template('complain/search_dtls',$this->data);
    }
}
