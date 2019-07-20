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
                                                    <?php foreach($type AS $type){ ?>
                                                    <option value="<?php echo $type->usertype_id; ?>"><?php echo $type->usertype_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </p>
                                            <p>
                                                <label>Username</label>
                                                <input type="text" name="username" class="form-control">
                                            </p>
                                            <p>
                                                <label>Password</label>
                                                <input type="password" name="password" class="form-control password1">
                                            </p>
                                            <p>
                                                <label>Confirm Password</label>
                                                <input type="password" name="confirm_password" onchange = "val_cpass()" class="form-control confirm_password1">
                                                <div  class = "alert alert-danger" id="cpass_msg1" style = "display:none;text-align:center;">
                                                </div>
                                            </p>
                                            <p>
                                                <select name="status" class="form-control">
                                                    <option selected="" value = "" disabled="">--Select Status--</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </p>                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            <button type="submit" id = "btn_saved" class="btn btn-primary">Save changes</button>
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

                                    <br>                                      
                                    <table class="table table-hover table-bordered" id="allTable">
                                        <thead>
                                            <tr>
                                                <th width="5%"></th>
                                                <th class="align-center">Full Name</th>
                                                <th class="align-center">Username</th>
                                                <th width="5%" class="align-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($user AS $use){ ?>
                                            <tr>
                                                <td class="align-center">
                                                    <?php if($use->usertype_id == '1'){ ?>
                                                    <label class="label amber">Admin</label>
                                                    <?php } else { ?>
                                                    <label class="label deep-orange">Staff</label>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if($use->status == '1'){ ?>
                                                    <span class="fa fa-circle green-text"></span> <?php echo $use->fullname;?>
                                                    <?php } else { ?>
                                                    <span class="fa fa-circle default-text "></span> <?php echo $use->fullname;?></td>
                                                    <?php } ?>
                                                <td><?php echo $use->username;?></td>
                                                <td class="align-center">
                                                    <a href="<?php echo base_url();?>index.php/master/user_update/<?php echo $use->user_id;?>" class="btn btn-xs btn-info">
                                                        <span class="fa fa-pencil"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>                                    
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
        var password = $(".password1").val();
        var confirm_password = $(".confirm_password1").val();

        if(password != confirm_password) {
            $("#cpass_msg1").show();
            $("#cpass_msg1").html("Confirm password not match!");
            $("#btn_saved").hide();
        }
        else{
            $("#cpass_msg1").hide();
            $("#btn_saved").show();
        }
    }
</script>

                
            
