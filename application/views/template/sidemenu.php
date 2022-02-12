


<aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li>
                            <!-- User Profile-->
                            <div class="user-profile dropdown m-t-20">
                                <div class="user-pic">
                                    <img src="<?=base_url()?>assets/images/users/2.jpg" alt="users" class="rounded-circle img-fluid" />
                                </div>
                                <div class="user-content hide-menu m-t-10">
                                    <h5 class="m-b-10 user-name font-medium"><?=$this->session->userdata('userdtls')[0]->u_title?></h5>
                                    <!--<a href="javascript:void(0)" class="btn btn-circle btn-sm m-r-5" id="Userdd" role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="ti-settings"></i>
                                    </a>-->
                                    <a href="<?=base_url('Login/logout')?>" title="Logout" class="btn btn-circle btn-sm">
                                        <i class="ti-power-off"></i>
                                    </a>
                                    <div class="dropdown-menu animated flipInY" aria-labelledby="Userdd">
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="ti-wallet m-r-5 m-l-5"></i> My Balance</a>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="ti-email m-r-5 m-l-5"></i> Inbox</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">
                                            <i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End User Profile-->
                        </li>
                        <!-- User Profile-->
                        
                        <?php if(in_array('usercase',$user_permission)){ ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=base_url('Dashboard/PS')?>" aria-expanded="false">
                                <i class="fas fa-home fa-2x"></i>
                                &nbsp;&nbsp;&nbsp;  <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>                        
                        <?php }?>
                        <?php if(in_array('allcase',$user_permission)){ ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=base_url('Dashboard/Superior')?>" aria-expanded="false">
                                <i class="fas fa-home fa-2x"></i>
                                &nbsp;&nbsp;&nbsp;  <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>    
                        <?php  }?>

                        <li class="sidebar-item">
                            
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="fas fa-envelope fa-2x"></i>
                                &nbsp;&nbsp;&nbsp; <span class="hide-menu">Complaint</span>
                            </a>
                           
                            <ul aria-expanded="false" class="collapse  first-level">
                                <?php if(in_array('createmail',$user_permission)){ ?>
                                <li class="sidebar-item">
                                    <a href="<?=base_url('Complain/create')?>" class="sidebar-link">
                                        <i class="icon-Record"></i>
                                        <span class="hide-menu"> Entry </span>
                                    </a>
                                </li>
                                <?php } ?>
                                 <!--   
                                <?php if(in_array('allmail',$user_permission)){ ?>
                                <li class="sidebar-item">
                                    <a href="<?=base_url('Complain')?>" class="sidebar-link">
                                        <i class="icon-Record"></i>
                                        <span class="hide-menu">All Mails</span>
                                    </a>
                                </li>                               
                                <?php } ?>
                                -->
                                <?php if(in_array('mailbetweendate',$user_permission)){ ?>
                                <li class="sidebar-item">
                                    <a href="<?=base_url('Complain/search')?>" class="sidebar-link">
                                        <i class="icon-Record"></i>
                                        <span class="hide-menu">Search Between Date</span>
                                    </a>
                                </li>  
                                <?php } ?>
                            </ul>
                        </li>

                        <li class="sidebar-item">
                            
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="fas fa-user fa-2x"></i>
                                &nbsp;&nbsp;&nbsp; <span class="hide-menu">Duty Officer</span>
                            </a>
                           
                            <ul aria-expanded="false" class="collapse  first-level">
                                <?php if(in_array('createdo',$user_permission)){ ?>
                                <li class="sidebar-item">
                                    <a href="<?=base_url('DutyOfficer/create')?>" class="sidebar-link">
                                        <i class="icon-Record"></i>
                                        <span class="hide-menu"> Entry </span>
                                    </a>
                                </li>
                                <?php } ?>
                                <?php if(in_array('searchdo',$user_permission)){ ?>
                                <li class="sidebar-item">
                                    <a href="<?=base_url('DutyOfficer')?>" class="sidebar-link">
                                        <i class="icon-Record"></i>
                                        <span class="hide-menu"> Search </span>
                                    </a>
                                </li>
                                <?php } ?>
                            </ul>
                        </li>

                        <li class="sidebar-item">
                            
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="fas fa-envelope fa-2x"></i>
                                &nbsp;&nbsp;&nbsp; <span class="hide-menu">Nature Of Complaints</span>
                            </a>
                           
                            <ul aria-expanded="false" class="collapse  first-level">
                                <?php if(in_array('createdo',$user_permission)){ ?>
                                <li class="sidebar-item">
                                    <a href="<?=base_url('ComplainNature/create')?>" class="sidebar-link">
                                        <i class="icon-Record"></i>
                                        <span class="hide-menu"> Entry </span>
                                    </a>
                                </li>
                                <?php } ?>
                                <?php if(in_array('searchdo',$user_permission)){ ?>
                                <li class="sidebar-item">
                                    <a href="<?=base_url('ComplainNature')?>" class="sidebar-link">
                                        <i class="icon-Record"></i>
                                        <span class="hide-menu"> Search </span>
                                    </a>
                                </li>
                                <?php } ?>
                            </ul>
                        </li>

                        
                        <?php if(in_array('user',$user_permission)){ ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="fas fa-user fa-2x"></i>
                                &nbsp;&nbsp;&nbsp; <span class="hide-menu">Users</span>
                            </a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item">
                                    <a href="<?=base_url('Users/create')?>" class="sidebar-link">
                                        <i class="icon-Record"></i>
                                        <span class="hide-menu"> Create </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="<?=base_url('Users')?>" class="sidebar-link">
                                        <i class="icon-Record"></i>
                                        <span class="hide-menu"> All Users </span>
                                    </a>
                                </li>                                
                                <li class="sidebar-item">
                                    <a href="<?=base_url('Users/userlog')?>" class="sidebar-link">
                                        <i class="icon-Record"></i>
                                        <span class="hide-menu"> User Log </span>
                                    </a>
                                </li>  
                                <li class="sidebar-item">
                                    <a href="<?=base_url('Complain/orgChart')?>" class="sidebar-link">
                                        <i class="icon-Record"></i>
                                        <span class="hide-menu"> Org Chart</span>
                                    </a>
                                </li>  
                            </ul>
                        </li>
                        <?php } ?>
                        <?php if(in_array('usergroup',$user_permission)){ ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="fas fa-users fa-2x"></i>
                                &nbsp;&nbsp;&nbsp; <span class="hide-menu">User Group</span>
                            </a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item">
                                    <a href="<?=base_url('User_Group/create')?>" class="sidebar-link">
                                        <i class="icon-Record"></i>
                                        <span class="hide-menu"> Create</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="<?=base_url('User_Group')?>" class="sidebar-link">
                                        <i class="icon-Record"></i>
                                        <span class="hide-menu"> All User Group</span>
                                    </a>
                                </li>                                
                            </ul>
                        </li>
                        <?php } ?>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>