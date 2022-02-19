
<div class="page-wrapper">

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Entry Complaint Details</h4>
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
                                    <li class="breadcrumb-item active" aria-current="page">Entry Complaint Details</li>
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
            <!--
            
            -->
            <!-- ============================================================== -->
            <div class="container-fluid">

                <div class="row">

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card" id="myform">
                    <form action="<?=base_url('Complain/saveComplain')?>" method="post"> 

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
                                <!-- <h4 class="card-title">Entry Mail Details</h4> -->
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <label class="m-t-20">Complaint Type</label>
                                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="m_type" name="m_type" required>
                                                <option value="">Select</option>                                                        
                                                <option value="Written">Written</option>                                                        
                                                <option value="eMail">eMail</option>   
                                                <option value="Helpline">Helpline</option>
                                                <option value="BySuperiors">By Superiors</option>  
                                                <?php if($this->session->userdata('userdtls')[0]->u_id==45) {?>
                                                    <option value="CyberPSPhoneCall">Cyber PS Phone Call</option>
                                                <?php }else{?>
                                                    <option value="CyberCellPsPhoneCall">Cyber Cell/PS Phone Call</option>
                                                <?php }?>                
                                        </select>  
                                    </div>
                                    <?php if($this->session->userdata('userdtls')[0]->u_id==45) {?>
                                    <div class="col-12 col-sm-6">
                                        <label class="m-t-20">Cyber PS Ref No</label>
                                        <input type="text" class="form-control" placeholder="Enter Cyber PS Ref No" id="m_ref" name="m_ref" value="<?=set_value('m_ref')?>">                                                                    
                                    </div>
                                    <?php }else{?>
                                        <div class="col-12 col-sm-6">
                                        <label class="m-t-20">Cyber Cell Ref No</label>
                                        <input type="text" class="form-control" placeholder="Enter Cyber Cell Ref No" id="m_ref" name="m_ref" value="<?=set_value('m_ref')?>">                                                                    
                                    </div>
                                    <?php }?>

                                    <div class="col-12 col-sm-6">
                                        <label class="m-t-20">Nature Of Complaint</label>
                                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="m_subject" name="m_subject" required>
                                                <option value="">Select</option>                                                        
                                                <?php foreach($cn as $x){ ?>
                                                <option value="<?=$x->cn_id?>"><?=$x->cn_name?></option>    
                                                <?php } ?>                                                                                                    
                                        </select>  
                                    </div>

                                    <div class="col-12 col-sm-6" id="Others">
                                        <label class="m-t-20">Please Specify Others</label>
                                        <input type="text" class="form-control" placeholder="Please Specify Others" id="m_subject_others" name="m_subject_others" value="<?=set_value('m_subject_others')?>" autocomplete="off">                                        
                                        <?php echo form_error('m_date'); ?>
                                    </div>

                                   <!-- <div class="col-12">
                                        <label class="m-t-20">Subject</label>
                                        <textarea class="form-control" placeholder="Enter Complaint Subject" id="m_subject" name="m_subject" rows="4" required></textarea>
                                        <?php echo form_error('m_subject'); ?>
                                    </div>
                                    -->
                                    

                                    <div class="col-12">
                                        <label class="m-t-20">Complaint Description</label>
                                        <textarea class="form-control" placeholder="Enter Complaint Description" id="m_body" name="m_body" rows="15" required></textarea>
                                        <?php echo form_error('m_body'); ?>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <label class="m-t-20">Incident Date</label>
                                        <input type="date" class="form-control" placeholder="Enter Incident Date (DD-MM-YYYY Format)" id="m_incident_date" name="m_incident_date" value="<?=set_value('m_incident_date')?>" required>                                        
                                        <?php echo form_error('m_incident_date'); ?>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <label class="m-t-20">Incident Time</label>
                                        <input type="text" class="form-control" placeholder="Enter Incident Time ( 24 HRs Format)" id="m_incident_time" name="m_incident_time" value="<?=set_value('m_incident_time')?>" required>                                        
                                        <?php echo form_error('m_incident_time'); ?>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <label class="m-t-20">Complaint Date</label>
                                        <input type="text" class="form-control" placeholder="Enter Complaint Date" id="m_date" name="m_date" value="<?=set_value('m_date')?>" required>                                        
                                        <?php echo form_error('m_date'); ?>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <label class="m-t-20">Complaint Time</label>
                                        <input type="text" class="form-control" placeholder="Enter Complaint Time ( 24 HRs Format)" id="m_time" name="m_time" value="<?=set_value('m_time')?>" required>                                        
                                        <?php echo form_error('m_time'); ?>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <label class="m-t-20">Complaint From</label>
                                        <input type="text" class="form-control" placeholder="Enter Complaint From" id="m_mail_from" name="m_mail_from" value="<?=set_value('m_mail_from')?>" required>                                        
                                        <?php echo form_error('m_mail_from'); ?>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <label class="m-t-20">Duty Officer</label>
                                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="m_do_id" name="m_do_id" required>
                                                        <option value="">Select</option>
                                                        <?php foreach($do as $r){ ?>
                                                        <option value="<?=$r->do_id?>"><?=$r->do_designation.' '.$r->do_name?></option>
                                                        <?php } ?>   
                                        </select>  
                                    </div>

                                    <div class="col-12">                                        
                                        <label class="m-t-20">Set Complaint Priority</label>    
                                        <br />

                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="m_priorityHigh" name="m_priority" value="1">
                                                <label class="custom-control-label" for="m_priorityHigh">High</label>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="m_priorityMedium" name="m_priority" value="2">
                                                <label class="custom-control-label" for="m_priorityMedium">Medium</label>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="m_priorityLow" name="m_priority" value="3">
                                                <label class="custom-control-label" for="m_priorityLow">Low</label>
                                            </div>
                                        </div>
                                        <!--
                                        <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="m_priority" id="m_priorityHigh" value="1">
                                        <label class="form-check-label" for="m_priorityHigh">High</label>
                                        </div>                                      
                                        <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="m_priority" id="m_priorityMedium" value="2">
                                        <label class="form-check-label" for="m_priorityMedium">Medium</label>
                                        </div>  
                                        <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="m_priority" id="m_priorityLow" value="3">
                                        <label class="form-check-label" for="m_priorityLow">Low</label>
                                        </div> -->
                                    </div>

                                    <div class="col-12">
                                        <label class="m-t-20">Action Taken</label>    
                                        <br />
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="actiontakenYes" name="m_action_taken" value="Yes">
                                                <label class="custom-control-label" for="actiontakenYes">Yes</label>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="actiontakenNo" name="m_action_taken" value="No" checked>
                                                <label class="custom-control-label" for="actiontakenNo">No</label>
                                            </div>
                                        </div>
                                        <!--              
                                        <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="m_action_taken" id="actiontakenYes" value="Yes">
                                        <label class="form-check-label" for="actiontakenYes">Yes</label>
                                        </div>                                      
                                        <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="m_action_taken" id="actiontakenNo" value="No" checked>
                                        <label class="form-check-label" for="actiontakenNo">No</label>
                                        </div>
                                                        -->  
                                    </div>

                                    <div class="col-12"> 
                                    <br/>                      
                                    <div class="form-check form-check-inline">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="m_transfer"  name="m_transfer" value="Yes">
                                                <label class="custom-control-label" for="m_transfer">Transferred to other unit</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <label class="m-t-20">Transferred To Division/Department</label>
                                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="m_transfer_division" name="m_transfer_division">
                                                <option value="">Select</option>                                                  
                                                <?php foreach($division as $x){ ?>
                                                <option value="<?=$x->d_id?>"><?=$x->d_name?></option>    
                                                <?php } ?>  
                                        </select> 
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <label class="m-t-20">Transferred To Section/Unit</label>
                                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="m_transfer_section" name="m_transfer_section">
                                                <option value="">Select</option>                                                  
                                                <!--<?php foreach($division as $x){ ?>
                                                <option value="<?=$x->d_id?>"><?=$x->d_name?></option>    
                                                <?php } ?>  
                                                -->
                                        </select> 
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <label class="m-t-20">Transferred Date</label>
                                        <input type="text" class="form-control" placeholder="Enter Transferred Date" id="m_transfer_date" name="m_transfer_date" value="<?=set_value('m_transfer_date')?>">                                        
                                        <?php echo form_error('m_transfer_date'); ?>
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
                                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="m_action" name="m_action" required>
                                                <option value="">Select</option>                                                  
                                                <?php for($i=0;$i<count($m_action);$i++){ ?>
                                                <option value="<?=$m_action[$i]?>"><?=$m_action[$i]?></option>    
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
                                                        <input type="checkbox" class="custom-control-input" id="<?=$m_action[$i]?>" name="m_action[]" value="<?=$m_action[$i]?>">
                                                        <label class="custom-control-label" for="<?=$m_action[$i]?>"><?=$m_action[$i]?></label>
                                                    </div>
                                                </div>
                                            <?php } ?>                                       
                                    </div>

                                    <div class="col-12">
                                        <label class="m-t-20">Remarks</label>                                        
                                        <textarea class="form-control" placeholder="Enter Mail Remarks" id="m_remarks" name="m_remarks" rows="8" required></textarea>
                                    </div>

                                    
                                </div> 
                                <br />
                                        <h5 class="card-title">Further Enquiry Details</h5>
                                       
                                        
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="mt_col1" name="mt_col1" value="Yes">
                                                <label class="custom-control-label" for="mt_col1">Enquiry started / Endorsed to E.O</label>
                                            </div>
                                        </div><br />                                        
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="mt_col3"  name="mt_col3" value="Yes">
                                                <label class="custom-control-label" for="mt_col3">Reply Awaited </label>
                                            </div>
                                        </div><br />
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="mt_col4"  name="mt_col4" value="Yes">
                                                <label class="custom-control-label" for="mt_col4">Reply Received</label>
                                            </div>
                                        </div><br />
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="mt_col5"  name="mt_col5" value="Yes">
                                                <label class="custom-control-label" for="mt_col5">Further Action Taken</label>
                                            </div>
                                        </div><br />
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="mt_col6"  name="mt_col6" value="Yes">
                                                <label class="custom-control-label" for="mt_col6">Enquiry Completed</label>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="m-t-20">Disposed</label>    
                                                <br />

                                                <div class="form-check form-check-inline">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input" id="disposedYes" name="m_disposed" value="Yes">
                                                        <label class="custom-control-label" for="disposedYes">Yes</label>
                                                    </div>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input" id="disposedNo" name="m_disposed" value="No" checked>
                                                        <label class="custom-control-label" for="disposedNo">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--           
                                    <div class="card-body">
                                        <h4 class="card-title">Feedback</h4>
                                        <hr />
                                    <div class="form-check form-check-inline">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="mt_feedback"  name="mt_feedback" value="Yes">
                                                <label class="custom-control-label" for="mt_feedback">Feedback Given</label>
                                            </div>
                                        </div>
                                    <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <label class="m-t-20">Feedback Date</label>
                                        <input type="text" class="form-control" placeholder="Enter Complaint Date" id="mt_feedbackdate" name="mt_feedbackdate" value="">                                                                    
                                    </div>  
                                    </div>  
                                    </div>-->

                            <div class="card-footer">
                             <button type="submit" class="btn waves-effect waves-light btn-primary">Submit</button>
                            </div>
                        </form>
                        </div>

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
