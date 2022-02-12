<div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Dashboard</h4>
                        <div class="d-flex align-items-center">

                        </div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Dashboard</a>
                                    </li>                                    
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

            <div class="row" id="welcome">
                    <div class="col-lg-12">
                        <div class="card  bg-light no-card-border">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="m-r-10">
                                        <img src="<?=base_url()?>assets/images/users/2.jpg" alt="user" width="60" class="rounded-circle" />
                                    </div>
                                    <div>
                                        <h3 class="m-b-0">Welcome <?=$this->session->userdata('userdtls')[0]->u_title?></h3>
                                        <span><?=date("l jS \of F Y h:i:s A")?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============================================================== -->
                <!-- Welcome back  -->
                <!-- ============================================================== -->
               
                <div class="row">
                <?php foreach($all as $r){ ?>
                    <div class="col-12 col-sm-4">
                        <div class="card <?=$r->color?> text-white">
                            <a href="<?=base_url('Cases/caseDetails?q='.urlencode($this->encrypt->encode($r->c_id)))?>" class="text-white">                            
                                <div class="card-body">
                                    <div class="d-flex no-block align-items-center">
                                        <i class="text-white fas fa-briefcase fa-3x"></i>
                                        <div class="m-l-15 m-t-10">
                                            
                                            <h4 class="font-medium m-b-0"><?=$r->c_head?></h4>
                                            <h5><?=$r->ps_name?></h5>
                                           
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php }?>
                    <?php if(in_array('createusers',$user_permission)){ ?>
                    <div class="col-12 col-sm-4">
                        <div class="card bg-secondary text-white">
                            <div class="card-body">
                                <div class="d-flex no-block align-items-center">
                                    <a href="JavaScript: void(0);"><i class="text-white fas fa-user fa-3x"></i></a>
                                        <div class="m-l-15 m-t-10">
                                            <h4 class="font-medium m-b-0">Users</h4>
                                            <h5><?=$users?></h5>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }?>    
                </div>
  <!--
                <div class="row">
                    <div class="col-12 col-sm-12">

                    <div class="container bg-primary text-white">
                        <ul class="slider">
                        <li><p> Case Updates</p></li>                        
                        </ul>
                        <ul class="slider">                        
                        <?php foreach($caseupdate as $r){ ?>
                            <li><p> <?=$r->cu_title?> </p></li>                        
                            <li><p> <?=$r->cu_description?> </p></li>                        
                            <li><p> <?=date('d-M-Y h:i:s A',strtotime($r->cu_datetime))?> </p></li>                        
                            <li><p> <?=$r->cu_title?> </p></li>                        
                        <?php }?>
                        </ul>
                    </div>

                  
                <div id="carouselExampleSlidesOnly" class="carousel slide border bg-light-danger text-black" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <div class="container-fluid">
                        <div class="row p-20 text-center">
                                <div class="col-12 col-sm-12">
                                    <label class="m-20"><h3>Case Updates</h3></label>                                
                                </div>                            
                        </div>
                </div>
            </div>
            <?php foreach($caseupdate as $r){ ?>
            <div class="carousel-item">
                <div class="container-fluid">
                    <div class="row p-b-20">
                            <div class="col-12 col-sm-3">
                                <label class="m-t-20">Title</label>
                                <div><?=$r->cu_title?></div>                                                                   
                            </div>
                            <div class="col-12 col-sm-3">
                                <label class="m-t-20">Description</label>
                                <div><?=$r->cu_description?></div>                                                                   
                            </div>
                            <div class="col-12 col-sm-3">
                                <label class="m-t-20">Updated By</label>
                                <div><?=$r->u_emailid?></div>                                                                   
                            </div>
                            <div class="col-12 col-sm-2">
                                <label class="m-t-20">Updated On</label>
                                <div><?=date('d-M-Y h:i:s A',strtotime($r->cu_datetime))?></div>                                                                   
                            </div>
                            <div class="col-12 col-sm-1"> 
                            <label class="m-t-20">Action</label>                       
                            <a role="button" href="<?=base_url('Cases/view?q='.urlencode($this->encrypt->encode($r->cu_c_id)))?>" class="btn waves-effect waves-light btn-warning">View</a>
                            </div>
                    </div>
                </div>
            </div>           
            <?php } ?>
        
    </div>
</div>
            -->
</div>

         <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->