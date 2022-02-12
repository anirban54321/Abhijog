<div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Duty Officer</h4>
                        <div class="d-flex align-items-center">

                        </div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Duty Officer</a>
                                    </li>   
                                    <li class="breadcrumb-item active" aria-current="page">All Duty Officer</li>                                 
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
                    <div class="col-12 col-sm-12">
                    <div class="card" id="table">
                            <div class="card-body" id="table-body">
                            <div class="table table-responsive">
                                                <table id="file_export" class="table table-bordered" >
                                                    <thead>
                                                        <tr class='bg-4798e8 text-white'>
                                                            <th>Sl No.</th>                                                            
                                                            <th>Name</th>
                                                            <th>Action</th>                                                          
                                                        </tr>
                                                    </thead>
                                                    <tbody>                                                           
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
    pageLength: 50,      
    scrollY:false,
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
    responsive: true,    
    ajax: {
			type:'GET',
		    url: '<?=base_url('ComplainNature/getComplainNature')?>',								
	      }
});
$('.buttons-print, .buttons-excel').addClass('btn btn-primary mr-1');


    

    

/*

*/
</script>