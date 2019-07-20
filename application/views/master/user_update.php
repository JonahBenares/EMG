                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header special-gradient">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title f-white" id="myModalLabel">Add User</h4>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action = "<?php echo base_url();?>index.php/master/insert_user">
                                        <div class="form-group">
                                            <p>
                                                <label>Full Name</label>
                                                <input type="text" name="fullname" class="form-control">
                                            </p>
                                            <p>
                                                <select name="usertype" class="form-control">
                                                    <option selected="" disabled="">--Select Usertype--</option>
                                                    <option value="1">Admin</option>
                                                    <option value="0">Staff</option>
                                                </select>
                                            </p>
                                            <p>
                                                <label>Username</label>
                                                <input type="text" name="username" class="form-control">
                                            </p>
                                            <p>
                                                <label>Password</label>
                                                <input type="password" name="password" class="form-control password">
                                            </p>
                                            <p>
                                                <label>Confirm Password</label>
                                                <input type="password" name="confirm" onchange = "val_cpass()" class="form-control confirm_password" required="">
                                                <div  class = "alert alert-danger" id="cpass_msg" style = "display:none;text-align:center;">
                                                    <h6 style="color:red">Confirm Password not Match!</h6>
                                                </div>
                                            </p>
                                            <p>
                                                <select name="status" class="form-control">
                                                    <option selected="" disabled="">--Select Status--</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </p>                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            <button type="submit" id = "btn_save" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 pt-5">
                    <br>
                    <div class="col-lg-10 col-lg-offset-1">
                        <div class="card-border special01-gradient animated fadeIn mb-5">
                            <div class="card plain-white">
                                <div class="card-header ">
                                    <h3 class="mt-2">
                                        <b>User List</b>
                                        <div class="pull-right mb-3">
                                            <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#myModal">Add New User</button>
                                        </div>
                                    </h3>

                                </div>
                                <div class="card-body">                                    
                                    <div style="padding: 10px 300px">
                                        <center><h4><span class="fa fa-pencil animated wobble infinite"></span> UPDATE USER</h4></center>
                                        <hr>    
                                        <form method="POST" action = "<?php echo base_url();?>index.php/master/edit_user">
                                            <?php foreach($user AS $use){ ?>
                                            <div class="form-group">
                                                <p>
                                                    <label>Full Name: </label>
                                                    <input type="text" name="fname" class="form-control" placeholder="Full Name" value = "<?php echo $use->fullname;?>">
                                                </p>
                                                <p>
                                                    <label>Usertype: </label>
                                                    <select name="usertype" class="form-control">
                                                        <option selected="" value = "" disabled="">--Select Usertype--</option>
                                                        <?php foreach($type AS $type){ ?>
                                                        <option value = "<?php echo $type->usertype_id;?>" <?php echo (($use->usertype_id == $type->usertype_id) ? ' selected' : '');?>><?php echo $type->usertype_name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </p>
                                                <p>
                                                    <label>Username: </label>
                                                    <input type="text" name="username" class="form-control" placeholder="Username" value = "<?php echo $use->fullname;?>">
                                                </p>
                                                <p>
                                                    <label>Status: </label>
                                                    <select name="status" class="form-control">
                                                        <option selected="" disabled="">--Select Status--</option>
                                                        <option value="1" <?php echo (($use->status == '1') ? ' selected' : ''); ?>>Active</option>
                                                        <option value="0" <?php echo (($use->status == '0') ? ' selected' : ''); ?>>Inactive</option>
                                                    </select>
                                                </p>
                                                <button type = "submit" name="submit" class="btn btn-primary btn-md btn-block" >Update</button> 
                                                <input type = "hidden" name = "id" value = "<?php echo $id; ?>">
                                            </div>
                                            <?php } ?>
                                        </form>
                                    </div>                                                                
                                </div>
                            </div>
                        </div>
                     </div>
                    <!-- <a class="nimvelo-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="purple-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="seablue-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="blooker20-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="sexyblue-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="purplelove-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="dimigo-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="skyline-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="sel-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                  r  <a class="sky-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="coolblues-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="megatron-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="moonlit-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="ibiza-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="frost-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="special-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="special01-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="btn-floating btn-outlined btn-sm sexyblue-gradient"><center><i class="fa fa-user"></i></center></a> -->
                </div>
<script>
    function val_cpass() {
        var password = $(".password").val();
        var confirm_password = $(".confirm_password").val();

        if(password != confirm_password) {
            $("#cpass_msg").show();
            $("#cpass_msg").html("Confirm password not match!");
            $("#btn_save").hide();
        }
        else{
            $("#cpass_msg").hide();
            $("#btn_save").show();
        }
    }
</script>
                
            
