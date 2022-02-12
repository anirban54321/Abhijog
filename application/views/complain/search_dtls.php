<?php  //echo "chart details page"; die;?>
<div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">

                        <?php if(isset($date1)){?>
                        <h4 class="page-title">All Complaints between <span class="text-primary"><?=date('d-M-Y',strtotime($date1))?></span> and <span class="text-primary"><?=date('d-M-Y',strtotime($date2))?></span></h4>
                        <?php } else { ?>
                        <h4 class="page-title">All Complaints</h4>
                        <?php } ?>

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
                                    <li class="breadcrumb-item active" aria-current="page">All Complaints</li>
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
                <!-- ============================================================== -->
                <!-- Welcome back  -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" id="table">
                            <div class="card-body" id="table-body">
                            <div class="table-responsive">
                            <table id="file_export" class="table table-bordered" >
                                                    <thead>
                                                        <tr class='bg-4798e8 text-white'>
                                                            <th width='20'>Sl No.</th>
                                                            <th width='20'>Division/PS</th>
                                                            <th width='20'>Priority</th>
                                                            <th width='20'>Type</th>
                                                            <th>Category</th>                                                            
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
                                                                <?php if($r->mt_reenquiry=='Reenquiry'){?>
                                                                    <tr class='alert-primary'>
                                                                        <td><i class="fas fa-flag-checkered fa-2x text-primary"></i><br/> <?=$i++?></td>                                                                        
                                                                        <td><?=$r->u_title?></td>
                                                                        <td class="text-center">
                                                                                <?php if($r->mt_priority=="1"){?>
                                                                                    <img src="<?=base_url()?>assets/images/high.png" alt="user" class="rounded-circle" width="70" alt="High">High
                                                                                <?php } ?>
                                                                                <?php if($r->mt_priority=="2"){?>
                                                                                    <img src="<?=base_url()?>assets/images/medium.png" alt="user" class="rounded-circle" width="70" alt="Medium"> Medium                                                                        
                                                                                <?php } ?>
                                                                                <?php if($r->mt_priority=="3"){?>
                                                                                    <img src="<?=base_url()?>assets/images/low.png" alt="user" class="rounded-circle" width="70" alt="Low"> Low                                                                       
                                                                                <?php } ?>
                                                                        </td>
                                                                        <td><?=$r->mt_type?></td>
                                                                        <td><?=$r->cn_name."-".$r->mt_subject_others?></td>
                                                                        <td><?=date('d-m-Y',strtotime($r->mt_incident_date))!='01-01-1970'?date('d-m-Y',strtotime($r->mt_incident_date)):''?></td>
                                                                        <td><?=date('d-m-Y',strtotime($r->mt_date))!='01-01-1970'?date('d-m-Y',strtotime($r->mt_date)):''?></td>
                                                                        <td><?=$r->do_name?></td>
                                                                        <td><?=$r->mt_action_taken?></td>                                                                    
                                                                        <td><?=$r->mt_disposed?></td>
                                                                        <td>
                                                                        <?php if(in_array('updatemail',$user_permission)){ ?>
                                                                            <a role="button" href="<?=base_url('Complain/edit?q='.urlencode($this->encrypt->encode($r->mt_id)))?>" class="btn waves-effect waves-light btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>                                                                    
                                                                        <?php } ?>                                                                    
                                                                        <?php if(in_array('updatemail',$user_permission)){ ?>
                                                                            <a role="button" href="<?=base_url('Complain/enquiry?q='.urlencode($this->encrypt->encode($r->mt_id)))?>" class="btn waves-effect waves-light btn-success btn-sm" title="Enquiry"><i class="fas fa-search"></i></a>                                                                    
                                                                        <?php } ?>                                                                    
                                                                        <?php if(in_array('deletemail',$user_permission)){ ?>                                                                      
                                                                            <a role="button" href="<?=base_url('Complain/deleteMail?q='.urlencode($this->encrypt->encode($r->mt_id)))?>" class="btn waves-effect waves-light btn-danger btn-sm" title="Delete"><i class="fas fa-times"></i></a>
                                                                        <?php } ?>
                                                                        <?php if(in_array('updatemail',$user_permission)){ ?>                                                                        
                                                                                <a role="button" target="_blank" href="<?=base_url('Complain/printComplain?q='.urlencode($this->encrypt->encode($r->mt_id)))?>" class="btn waves-effect waves-light btn-primary btn-sm" title="Print"><i class="fas fa-print"></i></a>
                                                                            <?php } ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?> 
                                                                <?php if($r->mt_disposed=='Yes' && $r->mt_reenquiry!='Reenquiry'){?>    
                                                                <tr class='alert-success'>
                                                                    <td><?=$i++?></td>
                                                                    <td><?=$r->u_title?></td>
                                                                    <td class="text-center">
                                                                            <?php if($r->mt_priority=="1"){?>
                                                                                <img src="<?=base_url()?>assets/images/high.png" alt="user" class="rounded-circle" width="70" alt="High">High
                                                                            <?php } ?>
                                                                            <?php if($r->mt_priority=="2"){?>
                                                                                <img src="<?=base_url()?>assets/images/medium.png" alt="user" class="rounded-circle" width="70" alt="Medium">Medium
                                                                            <?php } ?>
                                                                            <?php if($r->mt_priority=="3"){?>
                                                                                <img src="<?=base_url()?>assets/images/low.png" alt="user" class="rounded-circle" width="70" alt="Low">Low                                                                      
                                                                            <?php } ?>
                                                                    </td>
                                                                    <td><?=$r->mt_type?></td>
                                                                    <td><?=$r->cn_name."-".$r->mt_subject_others?></td>
                                                                    <td><?=date('d-m-Y',strtotime($r->mt_incident_date))!='01-01-1970'?date('d-m-Y',strtotime($r->mt_incident_date)):''?></td>
                                                                    <td><?=date('d-m-Y',strtotime($r->mt_date))!='01-01-1970'?date('d-m-Y',strtotime($r->mt_date)):''?></td>
                                                                    <td><?=$r->do_name?></td>
                                                                    <td><?=$r->mt_action_taken?></td>                                                                    
                                                                    <td><?=$r->mt_disposed?></td>
                                                                    <td>
                                                                    <?php if(in_array('updatemail',$user_permission)){ ?>
                                                                        <a role="button" href="<?=base_url('Complain/edit?q='.urlencode($this->encrypt->encode($r->mt_id)))?>" class="btn waves-effect waves-light btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>                                                                    
                                                                    <?php } ?>                                                                    
                                                                    <?php if(in_array('updatemail',$user_permission)){ ?>
                                                                        <a role="button" href="<?=base_url('Complain/enquiry?q='.urlencode($this->encrypt->encode($r->mt_id)))?>" class="btn waves-effect waves-light btn-success btn-sm" title="Enquiry"><i class="fas fa-search"></i></a>                                                                    
                                                                    <?php } ?>                                                                    
                                                                    <?php if(in_array('deletemail',$user_permission)){ ?>                                                                      
                                                                        <a role="button" href="<?=base_url('Complain/deleteMail?q='.urlencode($this->encrypt->encode($r->mt_id)))?>" class="btn waves-effect waves-light btn-danger btn-sm" title="Delete"><i class="fas fa-times"></i></a>
                                                                    <?php } ?>
                                                                    <?php if(in_array('updatemail',$user_permission)){ ?>                                                                        
                                                                            <a role="button" target="_blank" href="<?=base_url('Complain/printComplain?q='.urlencode($this->encrypt->encode($r->mt_id)))?>" class="btn waves-effect waves-light btn-primary btn-sm" title="Print"><i class="fas fa-print"></i></a>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                                <?php } elseif($r->mt_disposed=='No' && $r->mt_reenquiry!='Reenquiry'){ ?>    
                                                                    <tr class='alert-danger'>
                                                                        <td><?=$i++?></td>
                                                                        <td><?=$r->u_title?></td>
                                                                        <td class="text-center">
                                                                            <?php if($r->mt_priority=="1"){?>
                                                                                <img src="<?=base_url()?>assets/images/high.png" alt="user" class="rounded-circle" width="70" alt="High">High
                                                                            <?php } ?>
                                                                            <?php if($r->mt_priority=="2"){?>
                                                                                <img src="<?=base_url()?>assets/images/medium.png" alt="user" class="rounded-circle" width="70" alt="Medium">Medium                                                                        
                                                                            <?php } ?>
                                                                            <?php if($r->mt_priority=="3"){?>
                                                                                <img src="<?=base_url()?>assets/images/low.png" alt="user" class="rounded-circle" width="70" alt="Low">Low                                                                        
                                                                            <?php } ?>
                                                                        </td>
                                                                        <td><?=$r->mt_type?></td>
                                                                        <td><?=$r->cn_name."-".$r->mt_subject_others?></td>
                                                                        <td><?=date('d-m-Y',strtotime($r->mt_incident_date))!='01-01-1970'?date('d-m-Y',strtotime($r->mt_incident_date)):''?></td>
                                                                        <td><?=date('d-m-Y',strtotime($r->mt_date))!='01-01-1970'?date('d-m-Y',strtotime($r->mt_date)):''?></td>                                                                        
                                                                        <td><?=$r->do_name?></td>
                                                                        <td><?=$r->mt_action_taken?></td>
                                                                        <td><?=$r->mt_disposed?></td>
                                                                        <td>
                                                                        <?php if(in_array('updatemail',$user_permission)){ ?>                                                                        
                                                                            <a role="button" href="<?=base_url('Complain/edit?q='.urlencode($this->encrypt->encode($r->mt_id)))?>" class="btn waves-effect waves-light btn-warning btn-sm"  title="Edit"><i class="fas fa-edit"></i></a>                                                                        
                                                                        <?php } ?>  
                                                                        <?php if(in_array('updatemail',$user_permission)){ ?>
                                                                            <a role="button" href="<?=base_url('Complain/enquiry?q='.urlencode($this->encrypt->encode($r->mt_id)))?>" class="btn waves-effect waves-light btn-success btn-sm" title="Enquiry"><i class="fas fa-search"></i></a>                                                                    
                                                                        <?php } ?>                                                                        
                                                                        <?php if(in_array('deletemail',$user_permission)){ ?>                                                                        
                                                                            <a role="button" href="<?=base_url('Complain/deleteMail?q='.urlencode($this->encrypt->encode($r->mt_id)))?>" class="btn waves-effect waves-light btn-danger btn-sm" title="Delete"><i class="fas fa-times"></i></a>
                                                                        <?php } ?>
                                                                        <?php if(in_array('updatemail',$user_permission)){ ?>                                                                        
                                                                            <a role="button" target="_blank" href="<?=base_url('Complain/printComplain?q='.urlencode($this->encrypt->encode($r->mt_id)))?>" class="btn waves-effect waves-light btn-primary btn-sm" title="Print"><i class="fas fa-print"></i></a>
                                                                        <?php } ?>
                                                                        </td>
                                                                    </tr>    
                                                                <?php } ?>            
                                                            <?php } ?>     
                                                    </tbody>       
                                                </table>       
                            </div>                            
                            </div>
                        </div>
                </div>
                
            </div>
            </div>
         <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
<script>

$('#file_export').DataTable({   
    dom: 'Bfrtip',       
    paging:true,  
    pageLength: 50,      
    buttons: [
            { 
				extend: 'pdf', 
				text:'<i class="fa fa-file-pdf"></i> Pdf',
                className: 'btn btn-danger btn-sm btn-flat btn-raised',
                orientation: 'landscape',
                pageSize: 'LEGAL'				
			},
            { 
				extend: 'excel', 
				text:'<i class="far fa-file-excel"></i> Excel',
				className: 'btn btn-success btn-sm btn-flat btn-raised'				
			}
    ],
    rowReorder: {
            selector: 'td:nth-child(2)'
        },
    scrollY:false,
    responsive: true,          
});
$('.buttons-print, .buttons-excel').addClass('btn btn-primary mr-1');

/*
scrollY:"350px",
    scrollX:true,
    scrollCollapse: true,
    fixedColumns: true,
*/
</script>

