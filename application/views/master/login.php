<div class="back-special"></div>
<div class="back-login "></div>
<div class="back-overlay"></div>
<div class="container">
    <div style="padding:12vmax 0px">
        <div class="col-lg-8 col-md-8">
            <center>
                <h1 class=" animated fadeInDown mt-7 pt-2" style="color:#fff;font-size: 6vmax;font-weight: 700;text-shadow:-17px 20px 15px #0000007a">ENERGY MARKET GROUP</h1>
            </center>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="card-border special-gradient animated fadeIn mb-5" style="box-shadow:-17px 20px 15px #0000007a ">
                <div class="card plain-white">
                    <div class="card-header">
                        <h1 class="pr-5 pl-5">Login <span class="animated wobble infinite pull-right fa fa-lock"></span></h1>
                    </div>
                    <div class="card-body">
                        <form method="POST" action = "<?php echo base_url(); ?>index.php/master/login_process">
                            <fieldset>
                                <div class="form-group mt-4">
                                <input class="form-control" placeholder="Username" name = "username"  id="id" type="text" autofocus autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name = "password" id="password" type="password">
                                </div>
                                <?php
                                    $error_msg= $this->session->flashdata('error_msg');  
                                ?>
                                <?php 
                                    if($error_msg){
                                ?>
                                    <div class="alert alert-danger alert-shake animated headShake">
                                        <center><?php echo $error_msg; ?></center>                    
                                    </div>
                                <?php } ?>
                                <center>
                                    <!-- 
                                    <a  href="" value="login" name="submit" class="pl-5 pr-5 btn btn-block special-gradient " >Login</a> -->
                                    <button type="submit" class="pl-5 pr-5 btn btn-block special-gradient">Login</button>
                                </center>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
