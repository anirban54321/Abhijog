
<div class="page-wrapper">

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Edit Complaint Details</h4>
            <div class="d-flex align-items-center">

            </div>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex no-block justify-content-end align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Complaint</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Complaint Details</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<?php $this->load->view('template/message');?>	
<div class="container-fluid">

<!--
    <a role="button" href="<?=base_url('Complain/searchComplain')?>" class="btn waves-effect waves-light btn-success " title="Back">Back</a> 
-->                                                                   
    <div class="row">

        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card" id="myform">
                <?php foreach($mail as $r){?>
                <form action="<?=base_url('Complain/updateComplain?q='.urlencode($this->encrypt->encode($r->mt_id)))?>" method="post"> 

                        <!-- CRSF -->
                        <?php 
                        $csrf = array(
                                'name' => $this->security->get_csrf_token_name(),
                                'hash' => $this->security->get_csrf_hash()
                        );
                        ?>
                        <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                        <!-- CRSF -->

                <div class="card-body">
                    <!--<h4 class="card-title">Edit Mail Details</h4> -->
                    <div class="row">
                        
                        <div class="col-12 col-sm-6">
                                        <label class="m-t-20">Complaint Type</label>
                                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="m_type" name="m_type">
                                                        <option value="select">Select</option>                                                                                                               
                                                        <option value="Written" <?php if($r->mt_type=='Written'){echo 'selected';}?> >Written</option>                                                        
                                                        <option value="eMail" <?php if($r->mt_type=='eMail'){echo 'selected';}?>>eMail</option>                                                        
                                                        <option value="Helpline" <?php if($r->mt_type=='Helpline'){echo 'selected';}?>>Helpline</option>                                                        
                                                        <option value="BySuperiors" <?php if($r->mt_type=='BySuperiors'){echo 'selected';}?>>By Superiors</option>  
                                                        <?php if($this->session->userdata('userdtls')[0]->u_id==45) {?> 
                                                            <option value="CyberPSPhoneCall" <?php if($r->mt_type=='CyberPSPhoneCall'){echo 'selected';}?>>Cyber PS Phone Call</option>
                                                        <?php }else{?>
                                                            <option value="CyberCellPsPhoneCall" <?php if($r->mt_type=='CyberCellPsPhoneCall'){echo 'selected';}?>>Cyber Cell/PS Phone Call</option>
                                                        <?php }?> 
                                        </select>  
                        </div>
                        <?php if($this->session->userdata('userdtls')[0]->u_id==45) {?>
                        <div class="col-12 col-sm-6">
                            <label class="m-t-20">Cyber PS Ref No</label>
                            <input type="text" class="form-control" placeholder="Enter Cyber PS Ref No" id="m_ref" name="m_ref" value="<?=$r->mt_ref?>">                                                                    
                        </div>  
                        <?php }else{?>
                            <div class="col-12 col-sm-6">
                                        <label class="m-t-20">Cyber Cell Ref No</label>
                                        <input type="text" class="form-control" placeholder="Enter Cyber Cell Ref No" id="m_ref" name="m_ref" value="<?=$r->mt_ref?>">                                                                    
                            </div>
                        <?php }?>
                                    <div class="col-12 col-sm-6">
                                        <label class="m-t-20">Nature Of Complaint</label>
                                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="m_subject" name="m_subject" required>
                                                <option value="">Select</option>                                                        
                                                <?php foreach($cn as $x){ ?>
                                                <option value="<?=$x->cn_id?>" <?php if($r->mt_subject==$x->cn_id){echo 'selected';}?>><?=$x->cn_name?></option>    
                                                <?php } ?>                                                                                                    
                                        </select>  
                                    </div>

                                    <?php if($r->mt_subject=="23"){?> 
                                    <div class="col-12 col-sm-6" id="editOthers">                                                                      
                                        <label class="m-t-20">Please Specify Others</label>
                                        <input type="text" class="form-control" placeholder="Please Specify Others" id="m_subject_others" name="m_subject_others" value="<?=$r->mt_subject_others?>" autocomplete="off">                                                                                                                                                        
                                    </div>
                                    <?php } else { ?>    
                                    <div class="col-12 col-sm-6" id="editOthers2">                                                                      
                                        <label class="m-t-20">Please Specify Others</label>
                                        <input type="text" class="form-control" placeholder="Please Specify Others" id="m_subject_others" name="m_subject_others" value="<?=$r->mt_subject_others?>" autocomplete="off">                                                                                                                                                        
                                    </div>
                                    <?php }?>

                        <div class="col-12">
                                        <label class="m-t-20">Complaint Description</label>
                                        <textarea class="form-control" placeholder="Enter Complaint Description" id="m_body" name="m_body" rows="15"><?=$r->mt_body?></textarea>                                        
                        </div>

                        <div class="col-12 col-sm-6">
                            <label class="m-t-20">Incident Date</label>
                            <input type="date" class="form-control" placeholder="Enter Incident Date (DD-MM-YYYY Format)" id="m_incident_date" name="m_incident_date" value="<?php if(date('d-m-Y',strtotime($r->mt_incident_date))!='01-01-1970'){echo date('d-M-Y',strtotime($r->mt_incident_date));}?>">                                                                    
                        </div>

                        <div class="col-12 col-sm-6">
                            <label class="m-t-20">Incident Time</label>
                            <input type="text" class="form-control" placeholder="Enter Incident Time" id="m_incident_time" name="m_incident_time" value="<?php if(date('H:i',strtotime($r->mt_incident_time))!='05:30'){echo date('H:i',strtotime($r->mt_incident_time));}?>">                                                                    
                        </div>    

                        <div class="col-12 col-sm-6">
                            <label class="m-t-20">Complaint Date</label>
                            <input type="text" class="form-control" placeholder="Enter Complaint Date" id="m_date" name="m_date" value="<?=date('d-M-Y',strtotime($r->mt_date))?>">                                                                    
                        </div>

                        <div class="col-12 col-sm-6">
                            <label class="m-t-20">Complaint Time</label>
                            <input type="text" class="form-control" placeholder="Enter Complaint Time" id="m_time" name="m_time" value="<?=date('H:i',strtotime($r->mt_time))?>">                                                                    
                        </div>                        

                        <div class="col-12 col-sm-6">
                                        <label class="m-t-20">Complaint From</label>
                                        <input type="text" class="form-control" placeholder="Enter Complaint From" id="m_mail_from" name="m_mail_from" value="<?=$r->mt_mail_from?>">                                        
                                        <?php echo form_error('m_mail_from'); ?>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label class="m-t-20">Duty Officer</label>
                            <select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="m_do_id" name="m_do_id" required>
                                            <option value="select">Select</option>
                                            <?php foreach($do as $r1){ 
                                                if($r1->do_id==$r->mt_do_id){    
                                            ?>                                                
                                            <option value="<?=$r1->do_id?>" selected><?=$r1->do_designation.' '.$r1->do_name?></option>
                                            <?php } else { ?>   
                                            <option value="<?=$r1->do_id?>"><?=$r1->do_designation.' '.$r1->do_name?></option>
                                            <?php } ?>   
                                            <?php } ?>   

                            </select>  
                        </div>
                        
                        <div class="col-12">                                        
                                        <label class="m-t-20">Set Complaint Priority</label>    
                                        <br />

                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="m_priorityHigh" name="m_priority" value="1"  <?php if($r->mt_priority=='1'){echo 'checked';} ?>> 
                                                <label class="custom-control-label" for="m_priorityHigh">High</label>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="m_priorityMedium" name="m_priority" value="2"  <?php if($r->mt_priority=='2'){echo 'checked';} ?>>
                                                <label class="custom-control-label" for="m_priorityMedium">Medium</label>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="m_priorityLow" name="m_priority" value="3"  <?php if($r->mt_priority=='3'){echo 'checked';} ?>>
                                                <label class="custom-control-label" for="m_priorityLow">Low</label>
                                            </div>
                                        </div>
                                        <!--
                                        <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="m_priority" id="m_priorityHigh" value="1" <?php if($r->mt_priority=='1'){echo 'checked';} ?> >
                                        <label class="form-check-label" for="m_priorityHigh">High</label>
                                        </div>                                      
                                        <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="m_priority" id="m_priorityMedium" value="2" <?php if($r->mt_priority=='2'){echo 'checked';} ?>>
                                        <label class="form-check-label" for="m_priorityMedium">Medium</label>
                                        </div>  
                                        <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="m_priority" id="m_priorityLow" value="3" <?php if($r->mt_priority=='3'){echo 'checked';} ?>>
                                        <label class="form-check-label" for="m_priorityLow">Low</label>
                                        </div> -->

                        </div>
                        
                        <div class="col-12">
                                        <label class="m-t-20">Action Taken</label>    
                                        <br />
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="actiontakenYes" name="m_action_taken" value="Yes" <?php if($r->mt_action_taken=='Yes'){echo 'checked';} ?>>
                                                <label class="custom-control-label" for="actiontakenYes">Yes</label>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="actiontakenNo" name="m_action_taken" value="No"  <?php if($r->mt_action_taken=='No'){echo 'checked';} ?>>
                                                <label class="custom-control-label" for="actiontakenNo">No</label>
                                            </div>
                                        </div>
                                        <!--
                                        <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="m_action_taken" id="actiontakenYes" value="Yes" <?php if($r->mt_action_taken=='Yes'){echo 'checked';} ?> >
                                        <label class="form-check-label" for="actiontakenYes">Yes</label>
                                        </div>                                      
                                        <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="m_action_taken" id="actiontakenNo" value="No" <?php if($r->mt_action_taken=='No'){echo 'checked';} ?>>
                                        <label class="form-check-label" for="actiontakenNo">No</label>
                                        </div>  -->
                        </div>
                       
                                    <div class="col-12"> 
                                    <br/>                      
                                    <div class="form-check form-check-inline">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="m_transfer"  name="m_transfer" value="Yes" <?php if($r->mt_transfer=="Yes"){ echo "checked";}?>>
                                                <label class="custom-control-label" for="m_transfer">Transferred to other unit</label>
                                            </div>
                                        </div>
                                        </div>

                                                          
                                    <div class="col-12 col-sm-4">
                                        <label class="m-t-20">Transferred To Division/Department</label>
                                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="m_transfer_division" name="m_transfer_division">
                                                <option value="">Select</option>                                                  
                                                <?php foreach($division as $x){ ?>
                                                <option value="<?=$x->d_id?>" <?php if($r->mt_transfer_section==$x->d_id){echo 'selected';}?>><?=$x->d_name?></option>    
                                                <?php } ?>  
                                        </select> 
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <label class="m-t-20">Transferred To Section/Unit</label>
                                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="m_transfer_section" name="m_transfer_section">
                                                <option value="">Select</option>  
                                        </select> 
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <label class="m-t-20">Transferred Date</label>
                                        <input type="text" class="form-control" placeholder="Enter Transferred Date" id="m_transfer_date" name="m_transfer_date" value="<?php if($r->mt_transfer_date!='1970-01-01'){echo date('d-M-Y',strtotime($r->mt_transfer_date));}?>">                                                                                
                                    </div>
                                    
                        <?php 
                                        $m_action=array('Contacted and advice given to the Complainant',
                                                         'Social engineering initiated and fixed up',
                                                         'Contacted with alleged person and warned',
                                                         'SDR / CDR / TL analysed',
                                                         'Letter send to the intermediataries',
                                                         'Petition filed'
                                        );
                                    ?>
                                    <!--
                                    <div class="col-12 col-sm-6">
                                        <label class="m-t-20">Immidiate Relief</label>
                                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="m_action" name="m_action">
                                                <option value="">Select</option>                                                  
                                                <?php for($i=0;$i<count($m_action);$i++){ ?>
                                                <option value="<?=$m_action[$i]?>" <?php if($r->mt_action==$m_action[$i]){echo 'selected';}?>><?=$m_action[$i]?></option>    
                                                <?php } ?>  
                                        </select>  
                                    </div>
                                    -->

                                    <div class="col-12 col-sm-6">
                                        <label class="m-t-20">Immidiate Relief</label> 
                                            <?php for($i=0;$i<count($m_action);$i++){ ?>
                                                <br />  
                                                <div class="form-check form-check-inline">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="<?=$m_action[$i]?>" name="m_action[]" value="<?=$m_action[$i]?>"  <?php if(!empty(unserialize($r->mt_action))){if(in_array($m_action[$i],unserialize($r->mt_action))){echo "checked";}}?>>
                                                        <label class="custom-control-label" for="<?=$m_action[$i]?>"><?=$m_action[$i]?></label>
                                                    </div>
                                                </div>
                                            <?php } ?>                                       
                                    </div>


                        <div class="col-12">
                            <label class="m-t-20">Remarks</label>                                        
                            <textarea class="form-control" placeholder="Enter Mail Remakrs" id="m_remarks" name="m_remarks" rows="8"><?=$r->mt_remarks?></textarea>
                        </div>

                        
                        </div>
                        <br />
                                        <h5 class="card-title">Further Enquiry Details</h5>
                                        
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="mt_col1" name="mt_col1" value="Yes" <?php if($r->mt_col1=="Yes"){ echo "checked";}?>>
                                                <label class="custom-control-label" for="mt_col1">Enquiry started / Endorsed to E.O</label>
                                            </div>
                                        </div><br />                                        
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="mt_col3"  name="mt_col3" value="Yes" <?php if($r->mt_col3=="Yes"){ echo "checked";}?>>
                                                <label class="custom-control-label" for="mt_col3">Reply Awaited </label>
                                            </div>
                                        </div><br />
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="mt_col4"  name="mt_col4" value="Yes" <?php if($r->mt_col4=="Yes"){ echo "checked";}?>>
                                                <label class="custom-control-label" for="mt_col4">Reply Received</label>
                                            </div>
                                        </div><br />
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="mt_col5"  name="mt_col5" value="Yes" <?php if($r->mt_col5=="Yes"){ echo "checked";}?>>
                                                <label class="custom-control-label" for="mt_col5">Further Action Taken</label>
                                            </div>
                                        </div><br />
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="mt_col6"  name="mt_col6" value="Yes" <?php if($r->mt_col6=="Yes"){ echo "checked";}?>>
                                                <label class="custom-control-label" for="mt_col6">Enquiry Completed</label>
                                            </div>
                                        </div>
                                    
                                      
                                    <!--
                                    <div class="card-body">
                                        <h4 class="card-title">Feedback</h4>
                                        <hr />
                                        <div class="form-check form-check-inline">
                                           <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="mt_feedback"  name="mt_feedback" value="Yes" <?php if($r->mt_feedback=="Yes"){ echo "checked";}?>>
                                            <label class="custom-control-label" for="mt_feedback">Feedback Given</label>
                                            </div>
                                        </div>   
                                        

                                    <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <label class="m-t-20">Feedback Date</label>
                                        <input type="text" class="form-control" placeholder="Enter Complaint Date" id="mt_feedbackdate" name="mt_feedbackdate" value="<?php if($r->mt_feedbackdate!='1970-01-01'){echo date('d-M-Y',strtotime($r->mt_feedbackdate));}?>">                                                                    
                                    </div>                                              


                                    </div>  
                                    </div>
                                    -->
                                    
                                    <div class="row">
                                    <?php if($this->session->userdata('userdtls')[0]->u_id==45) {?>
                                    <div class="col-12">
                                        <label class="m-t-20">OC's Comment</label>                                        
                                        <textarea class="form-control" placeholder="Enter OC's Comment" id="m_oc_comment" name="m_oc_comment" rows="8"><?=$r->mt_oc_comment?></textarea>
                                    </div>
                                    <?php }else{?>
                                    <div class="col-12">
                                        <label class="m-t-20">Cyber Cell Incharge Comment</label>                                        
                                        <textarea class="form-control" placeholder="Enter Cyber Cell Incharge Comment" id="m_oc_comment" name="m_oc_comment" rows="8"><?=$r->mt_oc_comment?></textarea>
                                    </div>
                                    <?php }?>

                                    <div class="col-12">
                                                                <label class="m-t-20">Complaint Disposed</label>    
                                                                <br />
                                                                <div class="form-check form-check-inline">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" class="custom-control-input" id="disposedYes" name="m_disposed" value="Yes"  <?php if($r->mt_disposed=='Yes'){echo 'checked';} ?>>
                                                                        <label class="custom-control-label" for="disposedYes">Yes</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" class="custom-control-input" id="disposedNo" name="m_disposed" value="No"  <?php if($r->mt_disposed=='No'){echo 'checked';} ?>>
                                                                        <label class="custom-control-label" for="disposedNo">No</label>
                                                                    </div>
                                                                </div>                                          
                                    </div>
                                    </div>       
                                    </div>
                <div class="card-footer">
                    <?php if(in_array('usercase',$user_permission)){ ?>
                        <button type="submit" class="btn waves-effect waves-light btn-primary">Submit</button>
                    <?php }?>
                    <a role="button" href="<?=base_url('Complain/enquiry?q='.urlencode($this->encrypt->encode($r->mt_id)))?>" class="btn waves-effect waves-light btn-warning" title="Enquiry"><i class="fas fa-search"></i>View Enquiry</a>                                                                    
                </div>
                </div>
                </form>
                <?php } ?>


                                 <?php if($this->session->userdata('userdtls')[0]->u_id==45) {?>
                                    <form action="<?=base_url('Complain/saveComment/ACP-DCP/'.$mail[0]->mt_id)?>" method="post"> 
                                    <!-- CRSF -->
                                    <?php 
                                    $csrf = array(
                                            'name' => $this->security->get_csrf_token_name(),
                                            'hash' => $this->security->get_csrf_hash()
                                    );
                                    ?>
                                    <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                                    <!-- CRSF -->

                                        <div class="card">
                                        <div class="card-body">                                            
                                             <div class="row">
                                                <div class="col-12">
                                                    <div class="form-check form-check-inline">
                                                        <div class="custom-control custom-checkbox">
                                                            <br/>                                                
                                                            <input type="checkbox" class="custom-control-input" id="mt_reenquiry"  name="mt_reenquiry" value="Reenquiry" <?php if($r->mt_reenquiry=="Reenquiry"){ echo "checked";}?> />
                                                            <label class="custom-control-label" for="mt_reenquiry">Re Enquiry Complaint</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label class="m-t-20">ACP/DCP Comment</label>                                        
                                                    <textarea class="form-control" placeholder="Please Write Comment" id="cc_comment" name="cc_comment" rows="8"></textarea>
                                                </div>
                                            </div>                                           
                                        </div> 
                                        <div class="card-footer">
                                        <button type="submit" class="btn waves-effect waves-light btn-primary">Submit</button>                                            
                                        </div>  
                                        </div>
                                        </form>
                                

                                        <!-- timeline -->

                                <h4 class="page-title">Superior Comments</h4>
                                <div class="card">                               
                                    <div class="card-body">
                                        <section class="cd-horizontal-timeline">
                                            <div class="timeline">
                                                <div class="events-wrapper">
                                                    <div class="events">
                                                        <ol>
                                                            <?php $i=1; foreach($comment as $r) { ?> 
                                                                <?php if( $i==1){ ?>
                                                                    <li><a href="#0" data-date="<?=date('d/m/Y',strtotime($r->cc_datetime))?>" class="selected"><?=date('d-M',strtotime($r->cc_datetime))?></a></li>                                                    
                                                                <?php }else{ ?>    
                                                                    <li><a href="#0" data-date="<?=date('d/m/Y',strtotime($r->cc_datetime))?>"><?=date('d-M',strtotime($r->cc_datetime))?></a></li>                                                    
                                                                <?php }?>
                                                            <?php $i++; }?>
                                                        </ol>
                                                        <span class="filling-line" aria-hidden="true"></span>
                                                    </div>
                                                    <!-- .events -->
                                                </div>
                                                <!-- .events-wrapper -->
                                                <ul class="cd-timeline-navigation">
                                                    <li><a href="#0" class="prev inactive">Prev</a></li>
                                                    <li><a href="#0" class="next">Next</a></li>
                                                </ul>
                                                <!-- .cd-timeline-navigation -->
                                            </div>
                                            <!-- .timeline -->
                                            <div class="events-content">
                                                <ol>
                                                    <?php $i=1; foreach($comment as $r) { ?>
                                                        <?php if( $i==1){ ?>
                                                            <li class="selected" data-date="<?=date('d/m/Y',strtotime($r->cc_datetime))?>">
                                                                <div class="d-flex align-items-center">
                                                                    <div><img class="img-circle pull-left m-r-20 m-b-10" width="60" alt="user" src="<?=base_url()?>assets/images/users/2.jpg"></div>
                                                                    <div>
                                                                        <h2> <?=$r->u_title?></h2>
                                                                        <h6><?=date('d-M-Y , H:i',strtotime($r->cc_datetime))?></h6></div>
                                                                </div>
                                                                <p class="p-t-20">
                                                                    <?=$r->cc_comment?>
                                                                </p>
                                                                <p>
                                                                    <?php if($r->cc_userid==$this->session->userdata('userdtls')[0]->u_id) { ?>   
                                                                    <a href="<?=base_url('Complain/deleteComment/'.$r->cc_mt_id.'/'.$r->cc_id)?>" class="btn waves-effect waves-light btn-primary text-white">Delete Comment</a>
                                                                     <?php } ?>   
                                                                </p>
                                                            </li>
                                                        <?php }else{ ?>   
                                                            <li data-date="<?=date('d/m/Y',strtotime($r->cc_datetime))?>">
                                                            <div class="d-flex align-items-center">
                                                                <div><img class="img-circle pull-left m-r-20 m-b-10" width="60" alt="user" src="<?=base_url()?>assets/images/users/2.jpg"></div>
                                                                <div>
                                                                    <h2> <?=$r->u_title?></h2>
                                                                    <h6><?=date('d-M-Y , H:i',strtotime($r->cc_datetime))?></h6></div>
                                                            </div>
                                                            <p class="p-t-20">
                                                                <?=$r->cc_comment?>
                                                            </p>
                                                            <p>
                                                                    <?php if($r->cc_userid==$this->session->userdata('userdtls')[0]->u_id) { ?>   
                                                                        <a href="<?=base_url('Complain/deleteComment/'.$r->cc_mt_id.'/'.$r->cc_id)?>" class="btn waves-effect waves-light btn-primary text-white">Delete Comment</a>
                                                                    <?php } ?>   
                                                            </p>
                                                        </li>
                                                        <?php } ?> 
                                                    <?php $i++;} ?>
                                                </ol>
                                                        </div>
                                                        <!-- .events-content -->
                                                    </section>
                                                </div>
                                    </div>
                                    <!--timeline-->
                                    <?php }?>

            </div>
        </div>

        <div class="row">
                    <div class="col-12">
                        
                    </div>
                </div>

                
    </div>
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->


<script>
    $('.select2').select2();   

        // MAterial Date picker    
        $('#m_date').bootstrapMaterialDatePicker({ 
        weekStart: 0, 
        time: false,
        format: 'DD-MMMM-YYYY'
        });

        $('#m_incident_date1').bootstrapMaterialDatePicker({ 
        weekStart: 0, 
        time: false,
        format: 'DD-MMMM-YYYY'
        });

        $('#mt_feedbackdate').bootstrapMaterialDatePicker({ 
        weekStart: 0, 
        time: false,
        format: 'DD-MMMM-YYYY'
        });
        
        $('#m_transfer_date').bootstrapMaterialDatePicker({ 
        weekStart: 0, 
        time: false,
        format: 'DD-MMMM-YYYY'
        });
        

        $('#m_time1').bootstrapMaterialDatePicker({ 
        weekStart: 0, 
        date:false,
        time: true,
        format: 'HH:mm',
        twelvehour: false
        });


        $('#m_transfer_division').on('change',function(){
            var m_transfer_division = $(this).val();
					//alert(m_transfer_division);
					if(m_transfer_division){
						$.ajax({
							type:'POST',
							url: 'https://scientificwing.kolkatapolice.org/Abhijog/Api/getSection',
							data:{'m_transfer_division':m_transfer_division},
							success:function(response){
								//alert(response);
								$('#m_transfer_section').html('<option value="">Select</option>'+response);
							}
						}); 
					}else{
						$('#m_transfer_section').html('<option value="">Please Select Division</option>');
					}
				});

</script>    
