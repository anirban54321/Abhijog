<div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Create User Group</h4>
                        <div class="d-flex align-items-center">

                        </div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">User Group</a>
                                    </li> 
                                    <li class="breadcrumb-item active" aria-current="page">Create User Group</li>                                   
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

                <!-- ============================================================== -->
                <!-- Welcome back  -->
                <!-- ============================================================== -->
               
                <div class="row">
                    <div class="col-12 col-sm-12">
                    <div class="card" id="myform">                    
                    <form action="<?=base_url('User_Group/saveUserGroup')?>" method="post"> 
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
                                <h4 class="card-title">User Group Details</h4>
                                    
                                <label class="m-t-20">User Group Name</label>
                                <input type="text" class="form-control" placeholder="Enter User Group Name" id="ug_name" name="ug_name" value="<?=set_value('ug_name')?>" autocomplete="off" />                                                                                
                                <?php echo form_error('ug_name'); ?>
                            </div>
                            <div class="card-body">
                            
                            <h4 class="card-title">User Permissions</h4>   

                            <table class="table table-bordered"> 

                            <thead>
                            <tr>
                            <td>
                            Title
                            </td>
                            <td>                            
                            </td>
                            <td>                            
                            </td>
                            <td>                            
                            </td>
                            <td>                            
                            </td>
                            </tr>
                            </thead>
                            <tbody> 
                            <tr>  
                            <td> 
                               Previledge Case                          
                            </td>                          
                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" class="custom-control-input" id="allcase" name="ug_permission[]" value="Yes"  <?php if($r->mt_disposed=='Yes'){echo 'checked';} ?>>
                                                                        <label class="custom-control-label" for="allcase">All Case</label>
                                                                    </div>
                                                                </div>
                            
                            </td>
                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" class="custom-control-input" id="usercase" name="ug_permission[]" value="Yes"  <?php if($r->mt_disposed=='Yes'){echo 'checked';} ?>>
                                                                        <label class="custom-control-label" for="usercase">User Case</label>
                                                                    </div>
                                                                </div>
                            
                            </td>
                            <td>                             
                            </td>                                
                            <td>                             
                            </td>                                
                            <td>                             
                            </td>                                
                            </tr> 
                            <tr>  
                            <td> 
                               DC Comments
                            </td>                          
                            <td>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="alldccomment" name="ug_permission[]" value="alldccomment" />
                                <label class="custom-control-label m-t-20" for="alldccomment">All Cases</label>
                            </div> 
                            </td>
                            <td>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="userdccomment" name="ug_permission[]" value="userdccomment" />
                                <label class="custom-control-label m-t-20" for="userdccomment">User Cases</label>
                            </div> 
                            </td>
                            <td>                             
                            </td>                                
                            <td>                             
                            </td>                                
                            <td>                             
                            </td>                                
                            </tr> 
                            <tr>  
                            <td> 
                               Mail                          
                            </td>                          
                            <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="createmail" name="ug_permission[]" value="createmail" />
                                <label class="custom-control-label m-t-20" for="createmail">Entry</label>
                            </div> 
                            </td>
                            <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="updatemail" name="ug_permission[]" value="updatemail" />
                                <label class="custom-control-label m-t-20" for="updatemail">Update</label>
                            </div> 
                            </td>
                            <td> 
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="deletemail" name="ug_permission[]" value="deletemail" />
                                <label class="custom-control-label m-t-20" for="deletemail">Delete</label>
                            </div>    
                            </td>                                
                            <td> 
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="allmail" name="ug_permission[]" value="allmail" />
                                <label class="custom-control-label m-t-20" for="allmail">All Mails</label>
                            </div>    
                            </td>                                
                            <td> 
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="mailbetweendate" name="ug_permission[]" value="mailbetweendate" />
                                <label class="custom-control-label m-t-20" for="mailbetweendate">Mail Search Between Date</label>
                            </div>    
                            </td>                                
                            </tr>

                            <tr>  
                            <td> 
                               Duty Officer                          
                            </td>                          
                            <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="createdo" name="ug_permission[]" value="createdo" />
                                <label class="custom-control-label m-t-20" for="createdo">Entry</label>
                            </div> 
                            </td>
                            <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="searchdo" name="ug_permission[]" value="searchdo" />
                                <label class="custom-control-label m-t-20" for="searchdo">Search</label>
                            </div> 
                            </td>
                            <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="updatedo" name="ug_permission[]" value="updatedo" />
                                <label class="custom-control-label m-t-20" for="updatedo">Update</label>
                            </div> 
                            </td>
                            <td> 
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="deletedo" name="ug_permission[]" value="deletedo" />
                                <label class="custom-control-label m-t-20" for="deletedo">Delete</label>
                            </div>    
                            </td>                                                                                 
                            </tr>

                            <tr>  
                            <td> 
                               User                    
                            </td>                          
                            <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="user" name="ug_permission[]" value="user" />
                                <label class="custom-control-label m-t-20" for="user">User</label>
                            </div> 
                            </td>                            
                            </tr>

                            <tr>  
                            <td> 
                               User Group                   
                            </td>                          
                            <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="usergroup" name="ug_permission[]" value="usergroup" />
                                <label class="custom-control-label m-t-20" for="usergroup">User Group </label>
                            </div> 
                            </td>                            
                            </tr>

                            </tbody>   
                            </table>

                           </div>
                           <div class="card-footer">
                             <button type="submit" class="btn waves-effect waves-light btn-primary">Save</button>
                            </div>
                        </form> 
                        </div>                                                       
                    </div>
                </div>
            </div>
         <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->

<script>
    $('.select2').select2();
</script>