
<div class="page-wrapper">

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Entry Enquiry Details</h4>
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
                                    <li class="breadcrumb-item active" aria-current="page">Entry Enquiry Details</li>
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
            <?php $this->load->view('template/message');?>	
            <div class="container-fluid">

                <div class="row">

                    <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="table-responsive">
                                                <table id="file_export" class="table table-bordered" >
                                                    <thead>
                                                        <tr class='bg-4798e8 text-white'>  
                                                            <th width='20'>Type</th>
                                                            <th>Priority</th>
                                                            <th width='20'>Division/PS</th>
                                                            <th>Subject</th>                                                            
                                                            <th width='50'>Incident Date</th>
                                                            <th width='50'>Complain Date</th>                                                            
                                                            <th width='150'>Duty Officer</th>                                                                                                                        
                                                            <th>Action Taken</th>
                                                            <th width='20'>Disposed</th>
                                                            <th width='130'>Action</th>                                                    
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i=1; foreach($mail as $r) { ?>
                                                            <tr class='alert-primary'>                                                                    
                                                                <td><?=$r->mt_type?></td> 
                                                                <td>                                                               
                                                                            <?php if($r->mt_priority=="1"){?>
                                                                                <img src="<?=base_url()?>assets/images/high.png" alt="user" class="rounded-circle" width="100">
                                                                            <?php } ?>
                                                                            <?php if($r->mt_priority=="2"){?>
                                                                                <img src="<?=base_url()?>assets/images/medium.png" alt="user" class="rounded-circle" width="100">                                                                        
                                                                            <?php } ?>
                                                                            <?php if($r->mt_priority=="3"){?>
                                                                                <img src="<?=base_url()?>assets/images/low.png" alt="user" class="rounded-circle" width="100">                                                                        
                                                                            <?php } ?>
                                                                </td>            
                                                                <td><?=$r->u_title?></td>                                                                
                                                                <td><?=$r->cn_name."-".$r->mt_subject_others?></td>                                                                
                                                                <td><?=date('d-M-Y',strtotime($r->mt_incident_date))?></td>
                                                                <td><?=date('d-M-Y',strtotime($r->mt_date))?></td>                                                                                                                                
                                                                <td><?=$r->do_name?></td>
                                                                <td><?=$r->mt_action_taken?></td>                                                                                                                                                                                                                                                                    
                                                                <td><?=$r->mt_disposed?></td>
                                                                <td><a role="button" href="<?=base_url('Complain/edit?q='.urlencode($this->encrypt->encode($r->mt_id)))?>" class="btn waves-effect waves-light btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>                                                                    </td>
                                                            </tr>
                                                        <?php } ?>     
                                                    </tbody>       
                                                </table>       
                                </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-6">
                    <h4 class="page-title alert alert-primary">Uploaded Documents</h4>
                        <table>
                        <tr>
                        <?php $i=1;foreach($doc as $r){?>
                        <td>
                        <a class="example-image-link" href="<?=base_url().'uploads'.'/'.$r->cd_name?>" data-lightbox="example-set" data-title="Click the right half of the image to move forward."><img class="example-image img-thumbnail" width=100 src="<?=base_url().'uploads'.'/'.$r->cd_name?>" alt=""/></a>
                        <?php //if(in_array('deletescan',$user_permission)){ ?>
                        <p class="text-center"><a class="text-danger" href="<?=base_url('Complain/deleteDocument/?q='.urlencode($this->encrypt->encode($r->cd_id)))?>"> Delete </a></p>
                        <?php //} ?>
                        </td>
                        <?php } ?>
                        </tr>                            
                        </table>
                    </div>    

                    <div class="col-12 col-md-6 col-lg-6">
                        <h4 class="alert alert-primary page-title">Upload Documents</h4>
                        <?php echo $this->session->flashdata('error');?>
                        <?php echo form_open_multipart('Complain/upload_document/'.$mail[0]->mt_id);?>
                        <input type="file" name="userfile" size="20" />
                        <br /><br />
                        <button type="submit" name="remove" id="a_enquiry<?=$i?>" class="btn btn-primary">Upload File</button>                                                            
                        </form>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                    <h4 class="page-title alert alert-primary ">Enquiry Details</h4>

						<div class="col-12 col-md-12 hh-grayBox pt45 pb20">
							<div class="row justify-content-between">

                            <?php $i=1; foreach($enquiry_nodes as $r) { ?>
								<div class="order-tracking <?php if($r->mt_col1=="Yes"){echo "completed";}?>">
									<span class="is-complete"></span>
									<p>Enquiry started<br> / Endorsed to E.O</p>
								</div>
                                <!--
								<div class="order-tracking  <?php if($r->mt_col2=="Yes"){echo "completed";}?>">
									<span class="is-complete"></span>
									<p>Contacted with <br>Service Provider</p>
								</div>
                                -->
								<div class="order-tracking  <?php if($r->mt_col3=="Yes"){echo "completed";}?>">
									<span class="is-complete"></span>
									<p>Reply<br>Awaited</p>
								</div>
                                <div class="order-tracking  <?php if($r->mt_col4=="Yes"){echo "completed";}?>">
									<span class="is-complete"></span>
									<p>Reply<br>Received</p>
								</div>
                                <div class="order-tracking  <?php if($r->mt_col5=="Yes"){echo "completed";}?>">
									<span class="is-complete"></span>
									<p>Further <br>Action Taken</p>
								</div>
                                <div class="order-tracking  <?php if($r->mt_col6=="Yes"){echo "completed";}?>">
									<span class="is-complete"></span>
									<p>Enquiry <br>Completed</p>
								</div>
                                <?php  } ?>
							</div>
						</div>
					
                        <!--                                
                        <div class="card" id="myform">                      
                
                            <div class="card-body">
                                <h4 class="card-title">Entry Enquiry Details</h4>                            

                                <div class="row">
                                    <div class="col-12 col-sm-12">

                                            
                                            <form action="<?=base_url('Complain/saveEnquiry')?>" method="post"> 
                                            
                                                <?php 
                                                    $csrf = array(
                                                    'name' => $this->security->get_csrf_token_name(),
                                                    'hash' => $this->security->get_csrf_hash()
                                                    );
                                                ?>
                                                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                                                

                                                <input type="hidden" value=<?=$mail[0]->mt_id?> name="cq_mt_id" id="cq_mt_id" />          

                                                <div id="dynamic_field" style="width:100%;">      
                                                    <?php $i=1;foreach($enquiry as $r){?>
                                                        <div id="a_enquiry<?=$i?>">
                                                            <div class="row">             
                                                            <div class="col-12 col-md-2">
                                                            <label class="m-t-20">Enquiry Date</label>
                                                            <input type="text" class="form-control cquiry_date" placeholder="Enter Enquiry Date" id="cq_date" name="cq_date[]" value="<?=date('d-M-Y',strtotime($r->cq_date))?>">
                                                            </div>
                                                            <div class="col-12 col-md-2">
                                                            <label class="m-t-20">Enquiry Time</label>
                                                            <input type="text" class="form-control cquiry_time" placeholder="Enter Enquiry Time" id="cq_time" name="cq_time[]" value="<?=date('H:i',strtotime($r->cq_time))?>">
                                                            </div>
                                                            <div class="col-12 col-md-7">
                                                            <label class="m-t-20">Enquiry Details</label>               
                                                            <textarea class="form-control" placeholder="Enter Enquiry Details" id="cq_enquiry" name="cq_enquiry[]" rows="3"><?=$r->cq_enquiry?></textarea>
                                                            </div>              
                                                            <div class="col-12 col-md-1">
                                                            <label class="m-t-20">Remove</label>
                                                            <button type="button" name="remove" id="a_enquiry<?=$i?>" class="btn btn-danger btn-sm btn_remove">Remove</button>
                                                            </div>                
                                                            </div>
                                                        </div>
                                                    <?php $i++;}?>                         
                                                </div>  

                                                <br/>
                                                <button type="submit" class="btn waves-effect waves-light btn-primary">Submit</button>  
                                                <button type="button" name="addenquiry" id="addenquiry" class="btn waves-effect waves-light btn-success"><i class="fas fa-plus"></i> Add Enquiry</button>            
                                                <?php if(in_array('updatemail',$user_permission)){ ?>                                                                        
                                                    <a role="button" target="_blank" href="<?=base_url('Complain/printComplain?q='.urlencode($this->encrypt->encode($mail[0]->mt_id)))?>" class="btn waves-effect waves-light btn-warning" title="Print Report"><i class="fas fa-print"></i> Print Report</a>
                                                <?php } ?>
                                                </form>

                                            
                                    </div>

                                </div>                         
                            </div>
                        </div> -->

                      
                        
                        
                    </div>
                </div>

            </div>
         <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->

<!--                            
1. Enquiry started / Endorsed to E.O
2. Contacted with Service Provider
3. Reply Awaited 
4. Reply Received
5. Further Action Taken
6. Enquiry Completed
-->

<script>
    $('.select2').select2();

        // MAterial Date picker    
        $('#m_date').bootstrapMaterialDatePicker({ 
        weekStart: 0, 
        time: false,
        format: 'DD-MMMM-YYYY'
        });

        $('#m_time').bootstrapMaterialDatePicker({ 
        weekStart: 0, 
        date:false,
        time: true,
        format: 'HH:mm',
        twelvehour: false
        });


</script>    
