
<div class="page-wrapper">

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Search Complaints</h4>
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
                        <li class="breadcrumb-item active" aria-current="page">Search Complaints</li>
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
<div class="container-fluid">
    <div class="row">   
        <div class="col-sm-12 col-md-12 col-lg-12">                
        <div class="card" id="myform">
        <form action="<?=base_url('Complain/searchComplain')?>" method="post"> 

           
            <div class="card-body">
            
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <label class="m-t-20">Date From</label>
                        <input type="text" class="form-control" placeholder="Enter Mail Date" id="date1" name="date1">                                                            
                    </div>
                    <div class="col-12 col-sm-6">
                        <label class="m-t-20">Date To</label>
                        <input type="text" class="form-control" placeholder="Enter Mail Date" id="date2" name="date2">                                                            
                    </div>
                </div>
                
            </div>
            <div class="card-footer">
                <button type="button" id="search_submit" class="btn waves-effect waves-light btn-warning">View Stats</button>
                <button type="submit" class="btn waves-effect waves-light btn-primary">Search Details</button>
            </div>
            </div> 
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div id="curve_chart8" style="min-height:350px;"></div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div id="pie_chart3" style="min-height:350px;"></div>
                    </div>
                    <div class="col-12 col-sm-12">
                        <div id="curve_chart9" style="min-height:350px;"></div>
                    </div>

                </div>
            </form>           
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<script>
// MAterial Date picker    
        $('#date1').bootstrapMaterialDatePicker({ 
        weekStart: 0, 
        time: false,
        format: 'DD-MMMM-YYYY'
        });

        $('#date2').bootstrapMaterialDatePicker({ 
        weekStart: 0, 
        time: false,
        format: 'DD-MMMM-YYYY'
        });

</script>    
