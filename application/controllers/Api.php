
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends My_Controller 
{
    var $permission = array();
	public function __construct()
    {
        parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
        $this->load->model('Mailmodel');
        $this->load->model('Sectionmodel');        
        $this->permission=unserialize($this->session->userdata('userdtls')[0]->ug_permission);
    }

    public function printComplainGraph()
    {   
        //echo '<pre>';
        if(in_array('usercase',$this->permission))
        {
            $userid=$this->session->userdata('userdtls')[0]->u_id;	            
            $this->data['complain']=$this->Mailmodel->get_all_complain_status(array('mt_userid'=>$userid));
        }
        else
        {
            $this->data['complain']=$this->Mailmodel->get_all_complain_status(array());
        }
        //print_r($this->data['disposed']);

        $temp_month=array();
        foreach($this->data['complain'] as $r)
        {
            switch($r->mt_date)
            {
                case 1: $r->t_month='January';break;
                case 2: $r->t_month='February';break;
                case 3: $r->t_month='March';break;
                case 4: $r->t_month='April';break;
                case 5: $r->t_month='May';break;
                case 6: $r->t_month='June';break;
                case 7: $r->t_month='July';break;
                case 8: $r->t_month='August';break;
                case 9: $r->t_month='September';break;
                case 10: $r->t_month='October';break;
                case 11: $r->t_month='Novemer';break;
                case 12: $r->t_month='December';break;
            }
        }
        //echo '<pre>';
        //print_r($this->data['disposed']);                
        print_r(json_encode($this->data['complain']));                
    }   

    public function printDisposePendingGraph()
    {   
        //echo '<pre>';
        if(in_array('usercase',$this->permission))
        {
            $userid=$this->session->userdata('userdtls')[0]->u_id;	            
            $this->data['complain']=$this->Mailmodel->get_all_dipsose_pending_status(array('mt_userid'=>$userid));
        }
        else
        {
            $this->data['complain']=$this->Mailmodel->get_all_dipsose_pending_status(array());
        }
        //print_r($this->data['disposed']);        
        print_r(json_encode($this->data['complain']));                
    }

    public function printDisposedGraph()
    {  
        if(in_array('usercase',$this->permission))
        {
            $userid=$this->session->userdata('userdtls')[0]->u_id;	            
            $this->data['complain']=$this->Mailmodel->get_all_dipsosed_status(array('mt_userid'=>$userid));
        }
        else
        { 
            $this->data['complain']=$this->Mailmodel->get_all_dipsosed_status(array());
        }
        foreach($this->data['complain'] as $r)
        {
            switch($r->mt_date)
            {
                case 1: $r->t_month='January';break;
                case 2: $r->t_month='February';break;
                case 3: $r->t_month='March';break;
                case 4: $r->t_month='April';break;
                case 5: $r->t_month='May';break;
                case 6: $r->t_month='June';break;
                case 7: $r->t_month='July';break;
                case 8: $r->t_month='August';break;
                case 9: $r->t_month='September';break;
                case 10: $r->t_month='October';break;
                case 11: $r->t_month='Novemer';break;
                case 12: $r->t_month='December';break;
            }
        }
        //echo '<pre>';
        //print_r($this->data['disposed']);
        print_r(json_encode($this->data['complain']));                
    }  
    
    public function printPendingGraph()
    {   
        if(in_array('usercase',$this->permission))
        {
            $userid=$this->session->userdata('userdtls')[0]->u_id;	            
            $this->data['complain']=$this->Mailmodel->get_all_pending_status(array('mt_userid'=>$userid));
        }
        else
        { 
            $this->data['complain']=$this->Mailmodel->get_all_pending_status(array());
        }
        foreach($this->data['complain'] as $r)
        {
            switch($r->mt_date)
            {
                case 1: $r->t_month='January';break;
                case 2: $r->t_month='February';break;
                case 3: $r->t_month='March';break;
                case 4: $r->t_month='April';break;
                case 5: $r->t_month='May';break;
                case 6: $r->t_month='June';break;
                case 7: $r->t_month='July';break;
                case 8: $r->t_month='August';break;
                case 9: $r->t_month='September';break;
                case 10: $r->t_month='October';break;
                case 11: $r->t_month='Novemer';break;
                case 12: $r->t_month='December';break;
            }
        }
        //echo '<pre>';
        //print_r($this->data['disposed']);
        print_r(json_encode($this->data['complain']));                
    }  
    public function printCompainNature()
    {  
        if(in_array('usercase',$this->permission))
        {
            $userid=$this->session->userdata('userdtls')[0]->u_id;	            
            $this->data['complain']=$this->Mailmodel->get_all_complain_nature(array('mt_userid'=>$userid));
        }
        else
        {  
            $this->data['complain']=$this->Mailmodel->get_all_complain_nature(array());
        }
        //echo '<pre>';
        //print_r($this->data['disposed']);        
        print_r(json_encode($this->data['complain']));                
    }

    public function printComplainDisposedPendingGraph()
    {  
        if(in_array('usercase',$this->permission))
        {
            $userid=$this->session->userdata('userdtls')[0]->u_id;	            
            $this->data['complain']=$this->Mailmodel->get_all_complain_status(array('mt_userid'=>$userid));
            $this->data['disposed']=$this->Mailmodel->get_all_dipsosed_status(array('mt_userid'=>$userid));
            $this->data['pending']=$this->Mailmodel->get_all_pending_status(array('mt_userid'=>$userid));
        }
        else
        {   
            $this->data['complain']=$this->Mailmodel->get_all_complain_status(array());
            $this->data['disposed']=$this->Mailmodel->get_all_dipsosed_status(array());
            $this->data['pending']=$this->Mailmodel->get_all_pending_status(array());
        }
        
        foreach($this->data['complain'] as $r=>$v)
        {
            foreach($this->data['disposed'] as $dr=>$dv)
            {
                $this->data['complain'][$r]->c_d=0;
                if($v->mt_date==$dv->mt_date && $v->year==$dv->year){
                    $this->data['complain'][$r]->c_d=$dv->c_c;
                    break;
                } 

            }  
            foreach($this->data['pending'] as $pr=>$pv)
            {
                $this->data['complain'][$r]->c_p=0;
                if($v->mt_date==$pv->mt_date && $v->year==$pv->year){
                    $this->data['complain'][$r]->c_p=$pv->c_c;
                    break;
                } 
            }  
        
            switch($v->mt_date)
            {
                case 1: $this->data['complain'][$r]->t_month='January';                        
                        break;
                case 2: $this->data['complain'][$r]->t_month='February';                        
                        break;
                case 3: $this->data['complain'][$r]->t_month='March';                        
                        break;
                case 4: $this->data['complain'][$r]->t_month='April';                        
                        break;
                case 5: $this->data['complain'][$r]->t_month='May';                        
                        break;
                case 6: $this->data['complain'][$r]->t_month='June';                                        
                        break;
                case 7: $this->data['complain'][$r]->t_month='July';                        
                        break;
                case 8: $this->data['complain'][$r]->t_month='August';                        
                        break;
                case 9: $this->data['complain'][$r]->t_month='September';                        
                        break;
                case 10: $this->data['complain'][$r]->t_month='October';
                         break;
                case 11: $this->data['complain'][$r]->t_month='November';                        
                        break;
                case 12: $this->data['complain'][$r]->t_month='December';                        
                        break;
            }            
            //print_r($this->data['complain'][$r]->mt_date);
        }
        //echo '<pre>';
        //print_r($this->data['complain']);                        
        //print_r($this->data['disposed']);                        
        //print_r($this->data['pending']);    
        print_r(json_encode($this->data['complain']));                        
    }


    public function printCompainDutyOfficer()
    {
        if(in_array('usercase',$this->permission))
        {
            $userid=$this->session->userdata('userdtls')[0]->u_id;
            $this->data['complain']=$this->Mailmodel->get_all_complain_duty_officer(array('mt_userid'=>$userid));
            $this->data['disposed']=$this->Mailmodel->get_all_disposed_duty_officer(array('mt_userid'=>$userid));
            $this->data['pending']=$this->Mailmodel->get_all_pending_duty_officer(array('mt_userid'=>$userid));	    
        }
        else
        {
            $this->data['complain']=$this->Mailmodel->get_all_complain_duty_officer(array());
            $this->data['disposed']=$this->Mailmodel->get_all_disposed_duty_officer(array());
            $this->data['pending']=$this->Mailmodel->get_all_pending_duty_officer(array());
        }
        
        /*echo '<pre>';
        print_r($this->data['complain']); 
        print_r($this->data['disposed']); 
        print_r($this->data['pending']); 
        */

        
        foreach($this->data['complain'] as $r=>$v)
        {
            
            foreach($this->data['disposed'] as $dr=>$dv)
            {
                $this->data['complain'][$r]->c_d=0;
                if($v->do_name==$dv->do_name){
                    $this->data['complain'][$r]->c_d=$dv->c_d;
                    break;
                } 

            }  
            foreach($this->data['pending'] as $pr=>$pv)
            {
                $this->data['complain'][$r]->c_p=0;
                if($v->do_name==$pv->do_name){
                    $this->data['complain'][$r]->c_p=$pv->c_p;
                    break;
                } 
            }  

            //$this->data['complain'][$r]->c_d=$this->data['disposed'][$r]->c_d;
            //$this->data['complain'][$r]->c_p=$this->data['pending'][$r]->c_p;
        }
        //echo '<pre>';
        //print_r($this->data['complain']); 
        print_r(json_encode($this->data['complain']));                
    }  

    //current month
    public function printCurrentMonthComplainDisposedPendingGraph()
    {  
        //echo '<pre>';
        //print_r($this->permission);

        if(in_array('usercase',$this->permission))
        {
            $userid=$this->session->userdata('userdtls')[0]->u_id; 
            $this->data['complain']=$this->Mailmodel->get_all_complain_status(array('mt_userid'=>$userid));
            $this->data['disposed']=$this->Mailmodel->get_all_dipsosed_status(array('mt_userid'=>$userid));
            $this->data['pending']=$this->Mailmodel->get_all_pending_status(array('mt_userid'=>$userid));
        }
        else
        {
            $this->data['complain']=$this->Mailmodel->get_all_complain_status(array());
            $this->data['disposed']=$this->Mailmodel->get_all_dipsosed_status(array());
            $this->data['pending']=$this->Mailmodel->get_all_pending_status(array());
        }
        
        


        foreach($this->data['complain'] as $r=>$v)
        {
            if(count($this->data['disposed'])>0)
            {
                foreach($this->data['disposed'] as $dr=>$dv)
                {
                    $this->data['complain'][$r]->c_d=0;
                    if($v->mt_date==$dv->mt_date && $v->year==$dv->year){
                        $this->data['complain'][$r]->c_d=$dv->c_c;
                        break;
                    } 
                }  
            }
            else
            {
                $this->data['complain'][$r]->c_d=0;
            }
            
            if(count($this->data['pending'])>0)
            {
                foreach($this->data['pending'] as $pr=>$pv)
                {
                    $this->data['complain'][$r]->c_p=0;
                    if($v->mt_date==$pv->mt_date && $v->year==$pv->year){
                        $this->data['complain'][$r]->c_p=$pv->c_c;
                        break;
                    } 
                }         
            }
            else
            {
                $this->data['complain'][$r]->c_p=0;
            }

            switch($v->mt_date)
            {
                case 1: $this->data['complain'][$r]->t_month='January';                        
                        break;
                case 2: $this->data['complain'][$r]->t_month='February';                        
                        break;
                case 3: $this->data['complain'][$r]->t_month='March';                        
                        break;
                case 4: $this->data['complain'][$r]->t_month='April';                        
                        break;
                case 5: $this->data['complain'][$r]->t_month='May';                        
                        break;
                case 6: $this->data['complain'][$r]->t_month='June';                                        
                        break;
                case 7: $this->data['complain'][$r]->t_month='July';                        
                        break;
                case 8: $this->data['complain'][$r]->t_month='August';                        
                        break;
                case 9: $this->data['complain'][$r]->t_month='September';                        
                        break;
                case 10: $this->data['complain'][$r]->t_month='October';
                         break;
                case 11: $this->data['complain'][$r]->t_month='November';                       
                        break;
                case 12: $this->data['complain'][$r]->t_month='December';                        
                        break;
            }            
            //print_r($this->data['complain'][$r]->mt_date);
        }

       
        $data=array();
        foreach($this->data['complain'] as $r)
        {
            if($r->mt_date==date('m') && $r->year==date('Y'))            
            {
                array_push($data,array("t_month"=>$r->t_month,"year"=>$r->year,"c_c"=>$r->c_c,"c_d"=>$r->c_d,"c_p"=>$r->c_p));
            }
        }

        /*
        echo '<pre>';
        print_r($this->data['complain']);                        
        print_r($this->data['disposed']);                        
        print_r($this->data['pending']);   
        die;
        */
        print_r(json_encode($data));                        
    }
    public function printCurrentMonthCompainNature()
    {   
        if(in_array('usercase',$this->permission))
        {
            $userid=$this->session->userdata('userdtls')[0]->u_id; 
            $this->data['complain']=$this->Mailmodel->get_current_month_complain_nature(array('mt_userid'=>$userid));        
        }
        else
        {
            $this->data['complain']=$this->Mailmodel->get_current_month_complain_nature(array());        
        }
        $data=array();
        foreach($this->data['complain'] as $r)
        {
            if($r->mt_date==date('m') && $r->year==date('Y'))            
            {
                array_push($data,array("mt_subject"=>$r->cn_name,"c_c"=>$r->c_c));
            }
        }
        print_r(json_encode($data));            
    }
    public function printCurrentMonthDisposePendingGraph()
    {   
        //echo '<pre>';
        if(in_array('usercase',$this->permission))
        {
            $userid=$this->session->userdata('userdtls')[0]->u_id; 
            $this->data['complain']=$this->Mailmodel->get_current_month_dipsose_pending_status(array('mt_userid'=>$userid));        
        }
        else
        {
            $this->data['complain']=$this->Mailmodel->get_current_month_dipsose_pending_status(array());
        }
        $data=array();
        foreach($this->data['complain'] as $r)
        {
            if($r->mt_date==date('m') && $r->year==date('Y'))            
            {
                array_push($data,array("mt_disposed"=>$r->mt_disposed,"c_c"=>$r->c_c));
            }
        }

        print_r(json_encode($data));                 
    }


    //Between Date

    public function printBetweenDateComplainDisposedPendingGraph()
    {
        $date1=date('Y-m-d',strtotime($this->input->get('date1')));
        $date2=date('Y-m-d',strtotime($this->input->get('date2')));
        if(in_array('usercase',$this->permission))
        {
            $userid=$this->session->userdata('userdtls')[0]->u_id; 
            $this->data['mail']=$this->Mailmodel->get_all_mail_between_date_condition($date1,$date2,array('mt_userid'=>$userid));        
        }
        else
        {
            $this->data['mail']=$this->Mailmodel->get_all_mail_between_date_condition($date1,$date2,array());
        }
        $complain=count($this->data['mail']);          
        $disposed=0;
        $pending=0;        
        foreach($this->data['mail'] as $r)
        {
            if($r->mt_disposed=="Yes")
            {
                $disposed++;
            }
            else
            {
                $pending++;
            }
        }         
        $data=array(array("t_month"=>"Between Two Dates","c_c"=>$complain,"c_d"=>$disposed,"c_p"=>$pending));        
        print_r(json_encode($data));        
    }

    public function printBetweenDateCompainNature()
    {   
        $date1=date('Y-m-d',strtotime($this->input->get('date1')));
        $date2=date('Y-m-d',strtotime($this->input->get('date2')));
        if(in_array('usercase',$this->permission))
        {
            $userid=$this->session->userdata('userdtls')[0]->u_id; 
            $this->data['mail']=$this->Mailmodel->get_all_mail_between_date_condition($date1,$date2,array('mt_userid'=>$userid));        
        }
        else
        {
            $this->data['mail']=$this->Mailmodel->get_all_mail_between_date_condition($date1,$date2,array());        
        }
        $count=0;
        $nature=array();
        foreach($this->data['mail'] as $r)
        {
            array_push($nature,$r->cn_name);
        }                
        $data=array_count_values($nature);
        //print_r($data);    
        $nature_data=array();
        foreach($data as $r=>$v)
        {
            //print_r($r);            
            //print_r($v);
            array_push($nature_data,array("mt_subject"=>$r,"c_c"=>$v));
        }
        //print_r($nature_data);    
        print_r(json_encode($nature_data));        
    }

    public function printBetweenDateDisposePendingGraph()
    {
        $date1=date('Y-m-d',strtotime($this->input->get('date1')));
        $date2=date('Y-m-d',strtotime($this->input->get('date2')));
        if(in_array('usercase',$this->permission))
        {
            $userid=$this->session->userdata('userdtls')[0]->u_id; 
            $this->data['mail']=$this->Mailmodel->get_all_mail_between_date_condition($date1,$date2,array('mt_userid'=>$userid));        
        }
        else
        {
            $this->data['mail']=$this->Mailmodel->get_all_mail_between_date_condition($date1,$date2,array());
        }
        $complain=count($this->data['mail']);          
        $disposed=0;
        $pending=0;        

        foreach($this->data['mail'] as $r)
        {
            if($r->mt_disposed=="Yes")
            {
                $disposed++;
            }
            else
            {
                $pending++;
            }
        }         
        $data=array(array("mt_disposed"=>"Yes","c_c"=>$disposed),array("mt_disposed"=>"No","c_c"=>$pending));        
        print_r(json_encode($data));   
    }

    public function printComplainDivisionGraph()
    {
        $this->data['complain']=$this->Mailmodel->get_complain_division(array());
        $this->data['disposed']=$this->Mailmodel->get_disposed_division(array());
        $this->data['pending']=$this->Mailmodel->get_pending_division(array());
        
        /*echo "<pre>";
        print_r($this->data['complain']);
        print_r($this->data['disposed']);
        print_r($this->data['pending']);
        die;
        */
        
        foreach($this->data['complain'] as $r=>$v)
        {
            if(count($this->data['disposed'])>0)
            {
                foreach($this->data['disposed'] as $dr=>$dv)
                {
                    $this->data['complain'][$r]->c_d=0;
                    if($v->u_title==$dv->u_title){
                        $this->data['complain'][$r]->c_d=$dv->c_c;
                        break;
                    } 
                }  
            }
            else
            {
                $this->data['complain'][$r]->c_d=0;
            }
            
            if(count($this->data['pending'])>0)
            {
                foreach($this->data['pending'] as $pr=>$pv)
                {
                    $this->data['complain'][$r]->c_p=0;
                    if($v->u_title==$pv->u_title){
                        $this->data['complain'][$r]->c_p=$pv->c_c;
                        break;
                    } 
                }         
            }
            else
            {
                $this->data['complain'][$r]->c_p=0;
            }
        }

        print_r(json_encode($this->data['complain']));
    }

    public function printSectionGraph()
    {
        $this->data['division']=$this->Globalmodel->getdata_by_field_array('d_id,d_name','divisions',array('d_parent_id'=>0,'d_flag'=>'1'),'d_id', 'asc');	                                          
        $div=array();
        
        foreach($this->data['division'] as $r)
        {
            array_push($div,array('ps'=>$r->d_name,'parent'=>''));
        }
        
        foreach($this->data['division'] as $r)
        {
            $i=0;
            $this->data['ps']=$this->Globalmodel->getdata_by_field_array('d_name,d_parent_id','divisions',array('d_parent_id'=>$r->d_id,'d_flag'=>'1'),'d_id', 'asc');	                                                      
            foreach($this->data['ps'] as $x)
            {   
                array_push($div,array('ps'=>$x->d_name,'parent'=>$r->d_name));
            } 
        }
        //echo "<pre>";
        //print_r($div);
        print_r(json_encode($div));      
    }

    public function printComplainGraphByDate()
    {
        if(in_array('usercase',$this->permission))
        {
            $userid=$this->session->userdata('userdtls')[0]->u_id;	            
            $this->data['division']=$this->Mailmodel->get_all_complain_status_by_date(array('mt_userid'=>$userid));
        }
        else
        {
            $this->data['division']=$this->Mailmodel->get_all_complain_status_by_date(array());	                                                  
        }
        //echo "<pre>";
        //print_r($this->data['division']);
        print_r(json_encode($this->data['division']));      
    }

    public function getSection()
	{
		$m_transfer_division=$this->input->post('m_transfer_division');
        //$m_transfer_division=2;
		$this->data['ps']=$this->Globalmodel->getdata_by_field_array('*','divisions',array('d_flag'=>'1','d_parent_id'=>$m_transfer_division),'d_name', 'asc');	
		$str='';		
		foreach($this->data['ps'] as $r)
		{
			$str.='<option value="'.$r->d_id.'">'.$r->d_name.'</option>';
		}
		echo $str;
	}
}   


