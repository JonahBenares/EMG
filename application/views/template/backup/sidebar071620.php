    <body>
        <div class="wrapper">
            <!-- Topbar Holder --> 
            <nav class="navbar navbar-default nav-fixed special-gradient">
                <div class="col-lg-6 col-xs-1 col-sm-6">
                    <h3 class="mt-4 ml-3">
                        <a  id="sidebarCollapse" class="text-w">
                            <i class="fa fa-bars " aria-hidden="true"></i>
                        </a>
                    </h3>
                </div>
                <div class="col-lg-6 col-xs-11 col-sm-6">                    
                    <div class="pull-right">       
                        <a class="text-w"><?php echo date("F d, Y")?> - <?php echo date("g:i A")?></a> ||                
                        <a class="blooker20-gradient btn-sm btn-floating mr-1"><i class="fa fa-bell animated bell infinite"></i></a>
                        <a class="dimigo-gradient btn-sm btn-floating " data-toggle="dropdown" data-target="#" href="/page.html"><i class="fa fa-user"></i></a>
                        <ul class="dropdown-menu  animated fadeInRight" role="menu" aria-labelledby="dLabel">
                            <li><a href="#" class="p-1 pl-3"><h5 class="m-1">Profile</h5></a></li>
                            <li><a href="#" class="p-1 pl-3" data-toggle="modal" data-target="#changePass"><h5 class="m-1">Change Password</h5></a></li>
                            <li><a href="#" class="p-1 pl-3"><h5 class="m-1">Setting</h5></a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo base_url(); ?>" class="p-1 pl-3"><h5 class="m-1">Logout</h5></a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="modal fade" id="changePass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header special-gradient">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title f-white" id="myModalLabel">Change Password</h4>
                                </div>
                                <div class="modal-body">
                                    <form method = "POST" action = "<?php echo base_url();?>index.php/master/newpass">
                                        <div class="form-group">
                                            <p>
                                                <label>Old Password</label>
                                                <input type="password" name="oldpass" class="form-control ">
                                            </p>     
                                            <br>
                                            <p>
                                                <label>New Password</label>
                                                <input type="password" name="newpass" class="form-control password">
                                            </p>
                                            <br>
                                            <p>
                                                <label>Retype Password</label>
                                                <input type="password" name="confirm_password" onchange = "val_cpass()" class="form-control confirm_password">
                                                <div  class = "alert alert-danger" id="cpass_msg" style = "display:none;text-align:center;">
                                                </div>
                                            </p>                                        
                                        </div>
                                        <div class="modal-footer">
                                            <input type='hidden' name='userid' value="<?php echo $_SESSION['user_id']; ?>">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            <button type="submit" id = "btn_save" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

            <!-- Sidebar Holder --> 
            <?php $date = date("Y-m-d"); ?>
            <nav id="sidebar">
                <li class="list-unstyled ibiza-gradient p-1"></li>
                <!-- <div id="dismiss">
                    <i class="fa fa-arrow-left"></i>
                </div> -->
                <!-- <div class="sidebar-header">                    
                     <h3>Bootstrap Sidebar</h3>   
                </div>   -->  
                <ul class="list-unstyled components">

                    <center><h4 class="animated pulse infinite" ><b>ENERGY MARKET GROUP</b></h4></center> 
                    <br>
                    <li class="ibiza-gradient p-1"></li>
                    <li >
                        <a href="<?php echo base_url(); ?>index.php/master/home/<?php echo $date?>">Home</a>
                    </li>
                    <li>
                        <!-- <a href="#">About</a> -->
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Masterfile</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li><a href="<?php echo base_url(); ?>index.php/master/user_list">Users</a></li>
                            <!-- <li><a href="#">Page 2</a></li>
                            <li><a href="#">Page 3</a></li> -->
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/master/upload_rtd_other/<?php echo $date ?>">Upload RTD Other</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/reports/dhourly_report">Detailed Hourly Report</a>
                    </li>

                </ul>
                
            </nav>
            <div class="overlay"></div>

            <!-- Page Content Holder -->
            <div class="container-fluid" >
<script>
    function val_cpass() {
        var password = $(".password").val();
        var confirm_password = $(".confirm_password").val();

        if(password != confirm_password) {
            $("#cpass_msg").show();
            $("#cpass_msg").html("Retype password not match!");
            $("#btn_save").hide();
        }
        else{
            $("#cpass_msg").hide();
            $("#btn_save").show();
        }
    }
</script>
                