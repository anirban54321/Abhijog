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
                                <div id="org_chart" style="overflow-y:scroll;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
<script>

/*
scrollY:"350px",
    scrollX:true,
    scrollCollapse: true,
    fixedColumns: true,
*/
</script>

