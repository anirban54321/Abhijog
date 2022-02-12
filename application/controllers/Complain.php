
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Complain extends Admin_Controller 
{
	public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');        
        $this->load->model('Usermodel');
        $this->load->model('Mailmodel');
        $this->load->model('Sectionmodel');    
    }
	
    public function upload_document($mt_id)
    {
        
        if(!empty($_FILES)){ 
            // File upload configuration 
            //$uploadPath = '../../../home/ddsw/Anirban/document_scan/'; 
            $uploadPath = './uploads/'; 
            $filename= $_FILES["userfile"]["name"];
            $file_ext = pathinfo($filename,PATHINFO_EXTENSION);
            $config['file_name'] = time().'.'.$file_ext;
            $config['allowed_types']= 'gif|jpg|png';
            $config['upload_path'] = $uploadPath; 
            //$config['allowed_types'] = '*'; 
            // Load and initialize upload library 
            $this->load->library('upload', $config); 
            $this->upload->initialize($config); 
            //print_r($config);
            //print_r(getcwd());
            // Upload file to the server

            
            if($this->upload->do_upload('userfile')){ 
                $fileData = $this->upload->data(); 
                //$uploadData['file_name'] = $fileData['file_name']; 
                //$uploadData['uploaded_on'] = date("Y-m-d H:i:s");                  
                $data=array(
                    'cd_mt_id'=>$mt_id,
                    'cd_name'=>$fileData['file_name'],
                    'cd_datetime'=>date('Y-m-d H:i'), 
                    'cd_flag'=>1,
                    'cd_userid'=>$this->session->userdata('userdtls')[0]->u_id
                );
                $this->Globalmodel->savedata('complain_document',$data);	            
                $this->session->set_flashdata('successmsg', 'Image Successfully Added');
                redirect('Complain/enquiry?q='.urlencode($this->encrypt->encode($mt_id)));
            }
            else
            {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error',$error);
                redirect('Complain/enquiry?q='.urlencode($this->encrypt->encode($mt_id)));
            }                         
        } 
    }

    public function deleteDocument()
	{
        $cd_id=rawurldecode($this->encrypt->decode($_GET['q']));	
        $doc=$this->Globalmodel->getdata_by_field_array('*','complain_document',array('cd_id'=>$cd_id),'cd_id', 'asc');                
        $mt_id=$doc[0]->cd_mt_id;
        $this->Globalmodel->deletedata('complain_document','cd_id',$cd_id);
        unlink('./uploads/'.$doc[0]->cd_name);
        redirect('Complain/enquiry?q='.urlencode($this->encrypt->encode($mt_id)));	       
    }

	public function index()
	{	
        /*
        $sessdata=$this->session->userdata('userdtls');	  
		echo '<pre>';
		print_r($this->data);
        print_r($sessdata);
        */
        if(in_array('usercase',$this->permission))
        {
            $userid=$this->session->userdata('userdtls')[0]->u_id;	
            $this->data['mail']=$this->Mailmodel->get_current_month_mail(array('MONTH(mt_date)'=>date('m'),'YEAR(mt_date)'=>date('Y'),'mt_userid'=>$userid));            
        }
        else
        {
            $this->data['mail']=$this->Mailmodel->get_current_month_mail(array('MONTH(mt_date)'=>date('m'),'YEAR(mt_date)'=>date('Y')));            
        }
        $this->render_template('complain/search_dtls', $this->data);
    }   

    public function disposedComplain()
	{
        if(in_array('usercase',$this->permission))
        {
            $userid=$this->session->userdata('userdtls')[0]->u_id;	
            $this->data['mail']=$this->Mailmodel->get_current_month_mail(array('MONTH(mt_date)'=>date('m'),'YEAR(mt_date)'=>date('Y'),'mt_disposed'=>'Yes','mt_userid'=>$userid));    
        }
        else
        {
            $this->data['mail']=$this->Mailmodel->get_current_month_mail(array('MONTH(mt_date)'=>date('m'),'YEAR(mt_date)'=>date('Y'),'mt_disposed'=>'Yes'));    
        }
        $this->render_template('complain/search_dtls', $this->data);
    }  

    public function pendingComplain()
	{
        if(in_array('usercase',$this->permission))
        {
            $userid=$this->session->userdata('userdtls')[0]->u_id;	
            $this->data['mail']=$this->Mailmodel->get_current_month_mail(array('MONTH(mt_date)'=>date('m'),'YEAR(mt_date)'=>date('Y'),'mt_disposed'=>'No','mt_userid'=>$userid));   
        }
        else
        {
            $this->data['mail']=$this->Mailmodel->get_current_month_mail(array('MONTH(mt_date)'=>date('m'),'YEAR(mt_date)'=>date('Y'),'mt_disposed'=>'No'));   
        }
        $this->render_template('complain/search_dtls', $this->data);
    }  

    public function allComplain()
	{	
        /*
        $sessdata=$this->session->userdata('userdtls');	  
		echo '<pre>';
		print_r($this->data);
        print_r($sessdata);
        */
        if(in_array('usercase',$this->permission))
        {
            $userid=$this->session->userdata('userdtls')[0]->u_id;	
            $this->data['mail']=$this->Mailmodel->get_all_mail(array('mt_userid'=>$userid));
        }
        else
        {
            $this->data['mail']=$this->Mailmodel->get_all_mail(array());
        }
		$this->render_template('complain/search_dtls', $this->data);
    }   

    public function allDisposedComplain()
	{
        if(in_array('usercase',$this->permission))
        {
            $userid=$this->session->userdata('userdtls')[0]->u_id;	
            $this->data['mail']=$this->Mailmodel->get_all_mail(array('mt_disposed'=>'Yes','mt_userid'=>$userid));    
        }
            else
        {
            $this->data['mail']=$this->Mailmodel->get_all_mail(array('mt_disposed'=>'Yes'));    
        }
        $this->render_template('complain/search_dtls', $this->data);
    }  

    public function allPendingComplain()
	{
        if(in_array('usercase',$this->permission))
        {
            $userid=$this->session->userdata('userdtls')[0]->u_id;	
            $this->data['mail']=$this->Mailmodel->get_all_mail(array('mt_disposed'=>'No','mt_userid'=>$userid));   
        }
        else
        {
            $this->data['mail']=$this->Mailmodel->get_all_mail(array('mt_disposed'=>'No'));   
        }
        $this->render_template('complain/search_dtls', $this->data);
    }  

    public function todaysComplain()
	{
        if(in_array('usercase',$this->permission))
        {
            $userid=$this->session->userdata('userdtls')[0]->u_id;	
            $this->data['mail']=$this->Mailmodel->get_all_mail(array('mt_date'=>date('Y-m-d'),'mt_userid'=>$userid));   
        }
        else
        {
            $this->data['mail']=$this->Mailmodel->get_all_mail(array('mt_date'=>date('Y-m-d'))); 
        }
        $this->render_template('complain/search_dtls', $this->data);
    }

    public function yesterdaysComplain()
	{
        $yesterday=date('Y-m-d', strtotime('-1 day'));
        if(in_array('usercase',$this->permission))
        {
            $userid=$this->session->userdata('userdtls')[0]->u_id;	
            $this->data['mail']=$this->Mailmodel->get_all_mail(array('mt_date'=>$yesterday,'mt_userid'=>$userid));   
        }
        else
        {
            $this->data['mail']=$this->Mailmodel->get_all_mail(array('mt_date'=>$yesterday));    
        }
        $this->render_template('complain/search_dtls', $this->data);
    }    
    


    public function create()
	{
        $userid=$this->session->userdata('userdtls')[0]->u_id;	        
        if(in_array('usercase',$this->permission))
        {
            $this->data['do']=$this->Globalmodel->getdata_by_field_array('*','duty_officer',array('do_userid'=>$userid,'do_flag'=>'1'),'do_id', 'asc');	               
        }
        else
        {
            $this->data['do']=$this->Globalmodel->getdata_by_field_array('*','duty_officer',array('do_flag'=>'1'),'do_id', 'asc');	               
        }
        $this->data['cn']=$this->Globalmodel->getdata_by_field_array('*','complain_nature',array('cn_flag'=>'1'),'cn_name', 'asc');	               

        $this->data['division']=$this->Globalmodel->getdata_by_field_array('*','divisions',array('d_parent_id'=>'0','d_flag'=>'1'),'d_name', 'asc');	                       

        $this->render_template('complain/create', $this->data);
    }

    public function edit()
	{
        $mt_id=rawurldecode($this->encrypt->decode($_GET['q']));	        
        $userid=$this->session->userdata('userdtls')[0]->u_id;	    
        if(in_array('usercase',$this->permission))
        {
            $this->data['do']=$this->Globalmodel->getdata_by_field_array('*','duty_officer',array('do_userid'=>$userid,'do_flag'=>'1'),'do_id', 'asc');	               
        }
        else
        {
            $this->data['do']=$this->Globalmodel->getdata_by_field_array('*','duty_officer',array('do_flag'=>'1'),'do_id', 'asc');	               
        }

        $this->data['cn']=$this->Globalmodel->getdata_by_field_array('*','complain_nature',array('cn_flag'=>'1'),'cn_name', 'asc');	
        
        $this->data['division']=$this->Globalmodel->getdata_by_field_array('*','divisions',array('d_parent_id'=>'0','d_flag'=>'1'),'d_name', 'asc');	                       

        $this->data['comment']=$this->Mailmodel->get_complain_comments(array('cc_mt_id'=>$mt_id,'cc_flag'=>'1'));	                                              

        $this->data['mail']=$this->Mailmodel->get_all_mail(array('mt_id'=>$mt_id));    
        //echo '<pre>';
        //print_r($this->data['mail']);
        $this->render_template('complain/edit', $this->data);
    }    

    public function search()
	{	    
		$this->render_template('complain/search', $this->data);
    }    

    public function deleteComplain()
	{
        $id=rawurldecode($this->encrypt->decode($_GET['q']));	
		$this->Globalmodel->deletedata('mail_tracking','mt_id',$id);
		$this->session->set_flashdata('delmsg','complain Successfully Deleted');
		redirect('Complain/search');
    }      

    public function searchComplain()
	{
        if(!empty($this->input->post('date1')))
        {
            $date1=date('Y-m-d',strtotime($this->input->post('date1')));
            $date2=date('Y-m-d',strtotime($this->input->post('date2')));
            $this->session->set_userdata('date1', $date1);
            $this->session->set_userdata('date2', $date2);            
        }
        else {
            $date1 = $this->session->userdata('date1');
            $date2 = $this->session->userdata('date2');
        }

        $this->data['date1']=$date1;
        $this->data['date2']=$date2;

        if(in_array('usercase',$this->permission))
        {
            $userid=$this->session->userdata('userdtls')[0]->u_id;	
            $this->data['mail']=$this->Mailmodel->get_all_mail_between_date_condition($date1,$date2,array('mt_userid'=>$userid));   
        }
        else
        {
            $this->data['mail']=$this->Mailmodel->get_all_mail_between_date_condition($date1,$date2,array());        
        }
        $this->render_template('complain/search_dtls', $this->data);
    }

    public function enquiry()
	{
        $mt_id=rawurldecode($this->encrypt->decode($_GET['q']));
        $userid=$this->session->userdata('userdtls')[0]->u_id;		        
        $this->data['do']=$this->Globalmodel->getdata_by_field_array('*','duty_officer',array('do_flag'=>'1','do_userid'=>$userid),'do_id', 'asc');	
        $this->data['mail']=$this->Mailmodel->get_all_mail(array('mt_id'=>$mt_id));  
        $this->data['doc']=$this->Globalmodel->getdata_by_field_array('*','complain_document',array('cd_mt_id'=>$mt_id,'cd_flag'=>'1','cd_userid'=>$userid),'cd_id', 'asc');	
        $this->data['enquiry']=$this->Globalmodel->getdata_by_field_array('*','complain_enquiry',array('cq_mt_id'=>$mt_id,'cq_userid'=>$userid),'cq_id', 'asc');	                   
        $this->data['enquiry_nodes']=$this->Globalmodel->getdata_by_field_array('*','mail_tracking',array('mt_id'=>$mt_id),'mt_id', 'asc');	                   

        $this->render_template('complain/enquiry', $this->data);
    }    

    
    public function saveComment($cc_comment_head,$mt_id)
	{
        $cc_comment=$this->input->post('cc_comment');
        $mt_reenquiry=$this->input->post('mt_reenquiry');

        $data=array(
            'cc_mt_id'=>$mt_id,                                        
            'cc_comment_head'=>$cc_comment_head,  
            'cc_comment'=>$cc_comment,                                                            
            'cc_datetime'=>date('Y-m-d H:i'), 
            'cc_flag'=>1, 
            'cc_userid'=>$this->session->userdata('userdtls')[0]->u_id
        );
        //print_r($data);
        //die;
        $this->Globalmodel->savedata('complain_comments',$data);

        $data2=array(                                                 
            'mt_reenquiry'=>$mt_reenquiry
        );
        $this->Globalmodel->updatedata('mail_tracking','mt_id',$mt_id,$data2);

        $this->session->set_flashdata('successmsg','Comment Successfully Saved');	        
        redirect('Complain/edit?q='.urlencode($this->encrypt->encode($mt_id)));
    }

    public function deleteComment($mt_id,$cc_id)
	{
        //echo $mt_id;
        //echo $cc_id;
        //die;
		$this->Globalmodel->deletedata('complain_comments','cc_id',$cc_id);
        $this->session->set_flashdata('errmsg','Comment Successfully Deleted');	        
        redirect('Complain/edit?q='.urlencode($this->encrypt->encode($mt_id)));
    }

    public function saveEnquiry()
	{
        $cq_mt_id=$this->input->post('cq_mt_id');
        $cq_date=$this->input->post('cq_date');
        $cq_time=$this->input->post('cq_time');
        $cq_enquiry=$this->input->post('cq_enquiry');
        //print($this->input->post);
         /*delete data from accused table*/
         $this->Globalmodel->deletedata('complain_enquiry','cq_mt_id',$cq_mt_id);         
         /*delete data from accused table*/         
        for($i=0;$i<count($cq_enquiry);$i++)
        {
            $data=array(
                'cq_mt_id'=>$cq_mt_id,                            
                'cq_date'=>date('Y-m-d',strtotime($cq_date[$i])),  
                'cq_time'=>date('H:i',strtotime($cq_time[$i])),  
                'cq_enquiry'=>$cq_enquiry[$i],                                                            
                'cq_datetime'=>date('Y-m-d H:i'), 
                'cq_flag'=>1, 
                'cq_userid'=>$this->session->userdata('userdtls')[0]->u_id
            );
            //print_r($data);
            $this->Globalmodel->savedata('complain_enquiry',$data);
        }
        $this->session->set_flashdata('successmsg','Case Successfully Saved');	
        redirect('Complain/enquiry?q='.urlencode($this->encrypt->encode($cq_mt_id)));
    }

    public function saveComplain()
	{	
        $data=array(            
            'mt_type'=>$this->input->post('m_type'),
            'mt_ref'=>$this->input->post('m_ref'),
            'mt_subject'=>$this->input->post('m_subject'),
            'mt_subject_others'=>$this->input->post('m_subject_others'),            
            'mt_body'=>$this->input->post('m_body'),  

            'mt_incident_date'=>date('Y-m-d',strtotime($this->input->post('m_incident_date'))),                
            'mt_incident_time'=>date('H:i',strtotime($this->input->post('m_incident_time'))), 

            'mt_date'=>date('Y-m-d',strtotime($this->input->post('m_date'))),                
            'mt_time'=>date('H:i',strtotime($this->input->post('m_time'))), 

            'mt_mail_from'=>$this->input->post('m_mail_from'),                          
            'mt_do_id'=>$this->input->post('m_do_id'),
            'mt_remarks'=>$this->input->post('m_remarks'),  
            'mt_action_taken'=>$this->input->post('m_action_taken'),

            'mt_transfer'=>$this->input->post('m_transfer'),
            'mt_transfer_section'=>$this->input->post('m_transfer_section'),            
            'mt_transfer_date'=>date('Y-m-d',strtotime($this->input->post('m_transfer_date'))),

            'mt_action'=>serialize($this->input->post('m_action')),                  
            'mt_disposed'=>$this->input->post('m_disposed'),  
            'mt_priority'=>$this->input->post('m_priority'),  
            
            'mt_col1'=>$this->input->post('mt_col1'),  
            'mt_col2'=>$this->input->post('mt_col2'),  
            'mt_col3'=>$this->input->post('mt_col3'),  
            'mt_col4'=>$this->input->post('mt_col4'),  
            'mt_col5'=>$this->input->post('mt_col5'),  
            'mt_col6'=>$this->input->post('mt_col6'),  
            
            'mt_oc_comment'=>$this->input->post('m_oc_comment'), 

            'mt_feedback'=>$this->input->post('mt_feedback'),  
            'mt_feedbackdate'=>date('Y-m-d',strtotime($this->input->post('mt_feedbackdate'))),  

            'mt_datetime'=>date('Y-m-d H:i'), 
            'mt_flag'=>1, 
            'mt_userid'=>$this->session->userdata('userdtls')[0]->u_id
        );
        //echo '<pre>';
        //print_r($data);
        $this->Globalmodel->savedata('mail_tracking',$data);
        $this->session->set_flashdata('successmsg','Complain Successfully Saved');
        
        $last_mt_id=$this->Globalmodel->getlastid('mail_tracking','mt_id');
        $last_mt_id=$last_mt_id[0]->mt_id;

        //print_r($last_mt_id[0]->mt_id);

        redirect('Complain/enquiry?q='.urlencode($this->encrypt->encode($last_mt_id)));        
    }  

    public function updateComplain()
	{
        $mt_id=rawurldecode($this->encrypt->decode($_GET['q']));		
        $data=array(            
            'mt_type'=>$this->input->post('m_type'),
            'mt_ref'=>$this->input->post('m_ref'),
            'mt_subject'=>$this->input->post('m_subject'), 
            'mt_subject_others'=>$this->input->post('m_subject_others'),            
            'mt_body'=>$this->input->post('m_body'),  
            
            'mt_incident_date'=>date('Y-m-d',strtotime($this->input->post('m_incident_date'))),                
            'mt_incident_time'=>date('H:i',strtotime($this->input->post('m_incident_time'))), 

            'mt_date'=>date('Y-m-d',strtotime($this->input->post('m_date'))),                
            'mt_time'=>date('H:i',strtotime($this->input->post('m_time'))), 
            'mt_mail_from'=>$this->input->post('m_mail_from'),                          
            'mt_do_id'=>$this->input->post('m_do_id'),
            'mt_remarks'=>$this->input->post('m_remarks'), 
            'mt_action_taken'=>$this->input->post('m_action_taken'), 

            'mt_transfer'=>$this->input->post('m_transfer'),
            'mt_transfer_section'=>$this->input->post('m_transfer_section'),            
            'mt_transfer_date'=>date('Y-m-d',strtotime($this->input->post('m_transfer_date'))),

            'mt_action'=>serialize($this->input->post('m_action')),                  
            'mt_disposed'=>$this->input->post('m_disposed'),  
            'mt_priority'=>$this->input->post('m_priority'),  

            'mt_col1'=>$this->input->post('mt_col1'),  
            'mt_col2'=>$this->input->post('mt_col2'),  
            'mt_col3'=>$this->input->post('mt_col3'),  
            'mt_col4'=>$this->input->post('mt_col4'),  
            'mt_col5'=>$this->input->post('mt_col5'),  
            'mt_col6'=>$this->input->post('mt_col6'),  

            'mt_oc_comment'=>$this->input->post('m_oc_comment'), 
            
            'mt_feedback'=>$this->input->post('mt_feedback'),  
            'mt_feedbackdate'=>date('Y-m-d',strtotime($this->input->post('mt_feedbackdate'))),  
            
            'mt_datetime'=>date('Y-m-d H:i'), 
            'mt_flag'=>1, 
            'mt_userid'=>$this->session->userdata('userdtls')[0]->u_id
        );
        //echo '<pre>';
        //print_r($data);
        $this->Globalmodel->updatedata('mail_tracking','mt_id',$mt_id,$data);
        $this->session->set_flashdata('successmsg','Complain Successfully Updated');	
        //redirect('Mail/edit?q='.urlencode($this->encrypt->encode($mt_id)));
        redirect('Complain/enquiry?q='.urlencode($this->encrypt->encode($mt_id)));
    }  

    public function printComplain()
    {
		$this->load->library('pdf');
        $pdf = $this->pdf->load();
        $mt_id=rawurldecode($this->encrypt->decode($_GET['q']));
        $this->data['do']=$this->Globalmodel->getdata_by_field_array('*','duty_officer',array('do_flag'=>'1'),'do_id', 'asc');	
        $this->data['mail']=$this->Mailmodel->get_all_mail(array('mt_id'=>$mt_id));         
        $this->data['enquiry']=$this->Globalmodel->getdata_by_field_array('*','complain_enquiry',array('cq_mt_id'=>$mt_id),'cq_id', 'asc');	                   
        
        ini_set('memory_limit', '256M'); 
        //boost the memory limit if it's low ;)
	     
	    $html='<html>
		<head>
			<style>
					table 
					{
                            width:100%;
							font-family: Poppins,sans-serif;							
					}
                    h1
                    {
                        font-family: Poppins,sans-serif;
                        text-align:center;
                    }
                    h3
                    {
                        font-family: Poppins,sans-serif;
                    }
					td,th 
					{
						padding: 5px;						
						vertical-align: middle;
					}
			</style>
			<title>Complain Enquiry Report.pdf</title>
		</head>
		<body>';
		$html.='<h1>Cyber PS Comaplain Register</h1>';
        $html.='<h3>Comaplain Details</h3>';
        $html.='<table id="file_export" class="table table-bordered" >                                                   
                                                    <tbody>';
                                                        $i=1; foreach($this->data["mail"] as $r) { 
                                                            $html.='<tr><td>Type</td><td>'.$r->mt_type.'</td></tr>
                                                                <tr><td>Category</td><td>'.$r->cn_name.'</td></tr>
                                                                <tr><td>Details of Incident</td><td>'.$r->mt_body.'</td></tr>';

                                                                if(date("d-m-Y",strtotime($r->mt_incident_date))!="01-01-1970")
                                                                {
                                                                    $html.='<tr><td>Incident Date</td><td>'.date("d-M-Y",strtotime($r->mt_incident_date)).'</td></tr>';
                                                                }
                                                                else
                                                                {
                                                                    $html.='<tr><td>Incident Date</td><td>-</td></tr>';
                                                                }
                                                                
                                                                if(date("H:i",strtotime($r->mt_incident_time))!="01:00")
                                                                {
                                                                    $html.='<tr><td>Incident Time</td><td>'.date("H:i",strtotime($r->mt_incident_time)).'</td></tr>';
                                                                }
                                                                else
                                                                {
                                                                    $html.='<tr><td>Incident Time</td><td>-</td></tr>';
                                                                }
                                                                
                                                                $html.='<tr><td >Compalint Date</td><td>'.date("d-M-Y",strtotime($r->mt_date)).'</td></tr>
                                                                <tr><td>Compalint Time</td><td>'.date("H:i",strtotime($r->mt_time)).'</td></tr>
                                                                <tr><td>Compalint From</td><td>'.$r->mt_mail_from.'</td></tr>
                                                                <tr><td>Duty Officer</td> <td>'.$r->do_name.'</td></tr>
                                                                <tr><td>Action Taken</td> <td>'.$r->mt_action_taken.'</td> </tr>
                                                                <tr><td>Immediate Relief</td>';

                                                                $html.='<td><table  table-bordered>';
                                                                if(!empty(unserialize($r->mt_action)))
                                                                {
                                                                    foreach(unserialize($r->mt_action) as $x)
                                                                    {
                                                                        $html.='<tr><td>'.$x.'<br/></td></tr>';
                                                                    }
                                                                }
                                                                $html.='</table></td>';

                                                                $html.='<tr><td>Remarks</td><td>'.$r->mt_remarks.'</td></tr>
                                                                <tr><td>Disposed</td><td>'.$r->mt_disposed.'</td></tr>';
                                                         }
                                                $html.='  </tbody>       
                                                </table>';
        $html.='</body></html>';
        //print_r($html);
        //die;
		$pdf->AddPage('L');
        $pdf->WriteHTML($html); // write the HTML into the PDF
        $output = 'Complain Report' . date('Y_m_d_H_i_s') . '_.pdf';        
        $pdf->Output("$output", 'I'); // save to file because we can
        exit();
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

    public function orgChart()
    {
        $this->data['mail']=$this->Mailmodel->get_all_mail(array());     
        $this->render_template('complain/org_chart', $this->data);
    }
    
    //step 0:
    //insert value in complain_nature 23 Others
    //step 1:    
    public function updateComplainNature()
    {
        $m_subject=array('Creation of fake profile and impersonation',
                 'Blackmailing through social media/whatsapp/facebook',
                 'Harrassment through social media/whatsapp/facebook',
                 'Money cheated through online',
                 'Hacking of devices',
                 'Scam under the pretext of making a donation',
                 'Fraud call',
                 'Fake call center',
                 'Uploading of different obscene and sexually coloured picture',
                 'Circulation of obscene material through WhatsApp/Social Media', 
                 'Hacking of social networking account/Email/Websites',
                 'Data Theft/Misuse of Digital Signature',      
                 'Creation of lookalike mails and phishing websites',
                 'Job cheating.',
                 'OLX Fraud/Online advertisement fraud',
                 'Cheating through different Payment Apps/Remote Access',
                 'Credit card and debit card fraud.',
                 'Net Banking Fraud',
                 'Communal/Political/Controversial Post',
                 'Sextortion',
                 'Phishing/Look alike site/app',
                 'Ransomware/Malware Attack',
                 'Others'
                );
         $m_subject_id=array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23);

        $this->data['complain']=$this->Globalmodel->getdata_by_field_array('*','mail_tracking',array('mt_flag'=>'1'),'mt_id', 'asc');	

        for($i=0;$i<count($m_subject);$i++)
        {

            $data=array(                            
                       'mt_subject'=>$m_subject_id[$i]
            );
            $this->Globalmodel->updatedata('mail_tracking','mt_subject',$m_subject[$i],$data);            
        }
    }

   //step 2: 
    public function updateComplainNatureOthers()
    {
        $this->data['complain']=$this->Globalmodel->getdata_by_field_array('*','mail_tracking',array('mt_flag'=>'1'),'mt_id', 'asc');	
        
        $m_subject_id=array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23);

        foreach($this->data['complain'] as $r)
        {
            if(!in_array($r->mt_subject,$m_subject_id))
            {
                $data=array(                            
                    'mt_subject_others'=>$r->mt_subject
                );
                $this->Globalmodel->updatedata('mail_tracking','mt_id',$r->mt_id,$data);            
            }  
            else
            {
                $data=array(                            
                    'mt_subject_others'=>''
                );
                $this->Globalmodel->updatedata('mail_tracking','mt_id',$r->mt_id,$data);            
            }          
        }
    }

  //step 3: mt_subject to change longtext to int(11)

  //step 4:

    public function updateComplainNatureSubject2()
    {
        $this->data['complain']=$this->Globalmodel->getdata_by_field_array('*','mail_tracking',array('mt_flag'=>'1'),'mt_id', 'asc');	
        
        foreach($this->data['complain'] as $r)
        {
            $data=array(                            
                       'mt_subject'=>23
            );
            $this->Globalmodel->updatedata('mail_tracking','mt_subject',0,$data);            
        }
    } 

    //add ps to division table from pstation table

    public function updateDivision()
    {
        $this->data['ps']=$this->Globalmodel->getdata_by_field_array('*','pstation',array(),'ps_id', 'asc');	

        foreach($this->data['ps'] as $r)
        {
            $data=array(                            
                    'd_name'=>$r->ps_name,
                    'd_address'=>$r->ps_address,
                    'd_emailid'=>$r->ps_emailid,
                    'd_phoneno'=>$r->ps_phoneno,
                    'd_parent_id'=>$r->ps_d_id,
                    'd_datetime'=>date('Y-m-d H:i'), 
                    'd_flag'=>1, 
                    'd_userid'=>$this->session->userdata('userdtls')[0]->u_id
            );
            $this->Globalmodel->savedata('divisions',$data);            
        }
        
    }

}   


