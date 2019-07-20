                    <div class="mt-5 pt-5">
                    <br>
                    <div class="col-lg-10 col-lg-offset-1">
                        <div class="card-border special01-gradient animated fadeIn mb-5">
                            <div class="card plain-white">
                                <div class="card-header "><h3 class="mt-2 animated headShake"><b>Detailed Hourly Report</b></h3></div>
                                <div class="row pb-3 pt-3 ml-1 mr-1  faded-spl">
                                        <form method="POST" action="<?php echo base_url(); ?>index.php/reports/generateDate">
                                           <div class="col-lg-3 col-lg-offset-1">
                                                <label for="">Unit:</label>
                                                <b>
                                                    <select name="unit" class="form-control white" id="">
                                                        <option value="" selected="">--SELECT UNIT--</option>
                                                        <option value="06CENPRI_U01" >06CENPRI_U01</option>
                                                        <option value="06CENPRI_U02" >06CENPRI_U02</option>
                                                        <option value="06CENPRI_U03" >06CENPRI_U03</option>
                                                        <option value="06CENPRI_U04" >06CENPRI_U04</option>
                                                        <option value="06CENPRI_U05" >06CENPRI_U05</option>
                                                    </select>
                                                </b>
                                            </div>
                                            <div class="col-lg-3">
                                                <label for="">Date:</label>
                                                <b><input type="date" name="date" class="form-control white" value="<?php echo (!empty($date) ? $date : ''); ?>" required>
                                                </b>
                                            </div>
                                            <div class="col-lg-3">
                                                <label for="">Hour:</label>
                                                <b>
                                                    <select name="hour" class="form-control white" id="">
                                                        <option value = ""></option>
                                                        <?php 
                                                            for($x=0;$x<=23;$x++){ 
                                                                if($x<10){
                                                                    $time = '0'.$x;
                                                                } else {
                                                                    $time = $x;
                                                                } 
                                                        ?>  
                                                            <option value="<?php echo $time;?>" ><?php echo $time;?>:00</option>
                                                        <?php } ?>
                                                    </select>
                                                </b>
                                            </div>
                                            <br>
                                            <div class="col-lg-1"><button class="btn btn-success btn-md">Generate</button></div>
                                        </form>
                                </div>
                                <div class="card-body">     
                                    <?php if(empty($info)){ ?>                                       
                                        <h2 class="mb-1"><span class="fa fa-clock-o animated rotate"></span><b> <?php if(empty($unit) || $unit == 'null'){ echo 'Unit'; }else{ echo $unit; }?></b>
                                           <a href = "<?php echo base_url(); ?>index.php/reports/export/<?php echo $unit?>/<?php echo $date?>/<?php echo $time1;?>" class="btn btn-md btn-warning pull-right">Export to Excel</a>
                                            <!--<button class="btn btn-md btn-warning pull-right">Export</button>-->
                                        </h2>
                                        <h4 class="mt-1 ml-5 pl-2"><?php if($date == 'null'){ }else { echo $date; }?> - <?php if($time1 == 'null'){ }else{ echo $time1; }?></h4>
                                    <?php } else if(!empty($info)){ ?>                                       
                                        <h2 class="mb-1"><span class="fa fa-clock-o animated rotate"></span><b> <?php if(empty($unit) || $unit == 'null'){ echo 'Unit'; }else{ echo $unit; }?></b>
                                            <a href = "<?php echo base_url(); ?>index.php/reports/export/<?php echo $unit?>/<?php echo $date?>/<?php echo $time1;?>" class="btn btn-md btn-warning pull-right">Export to Excel</a>
                                        </h2>
                                        <h4 class="mt-1 ml-5 pl-2"><?php if($date == 'null'){ }else { echo $date; }?> - <?php if($time1 == 'null'){ }else{ echo $time1; }?></h4>
                                    <?php }else if(!empty($date)){ ?>
                                        <h2 class="mb-1"><span class="fa fa-clock-o animated rotate"></span><b> <?php if($unit == 'null'){ echo 'Unit'; }else{ echo $unit; }?></b>
                                           <a href = "<?php echo base_url(); ?>index.php/reports/export/<?php echo $unit?>/<?php echo $date?>/<?php echo $time1;?>" class="btn btn-md btn-warning pull-right">Export to Excel</a>
                                        </h2>
                                        <h4 class="mt-1 ml-5 pl-2"><?php if($date == 'null'){ }else { echo $date; }?> - <?php if($time1 == 'null'){ }else{ echo $time1; }?></h4>
                                    <?php } else{ ?>
                                        <h2 class="mb-1"><span class="fa fa-clock-o animated rotate"></span><b> <?php if($unit == 'null'){ echo 'Unit'; }else{ echo $unit; }?></b>
                                           <a href = "<?php echo base_url(); ?>index.php/reports/export/<?php echo $unit?>/<?php echo $date?>/<?php echo $time1;?>" class="btn btn-md btn-warning pull-right">Export to Excel</a>
                                        </h2>
                                        <h4 class="mt-1 ml-5 pl-2"><?php if($date == 'null'){ }else { echo $date; }?> - <?php if($time1 == 'null'){ }else{ echo $time1; }?></h4>
                                    <?php } ?>
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="align-center">Interval Time</th>
                                                <th class="align-center">Price Node</th>
                                                <th class="align-center">MW</th>
                                                <th class="align-center">LMP</th>
                                                <th class="align-center">Loss Factor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($date)){ 
                                                if(!empty($info)){
                                                foreach($info AS $i){ ?>
                                            <tr>
                                                <td><?php echo $i['interval']; ?></td>
                                                <td><?php echo $i['node']; ?></td>
                                                <td><?php echo $i['mw']; ?></td>
                                                <td><?php echo $i['lmp']; ?></td>
                                                <td><?php echo $i['loss']; ?></td>
                                            </tr>
                                            <?php } } }?>
                                        </tbody>
                                    </table>                                    
                                </div>
                            </div>
                        </div>
                     </div>

                    <!-- <h2 class="textgrad">Collapsible Sidebar Using Bootstrap 3</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                    <div class="line"></div>

                    <h3>Lorem Ipsum Dolor</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                    <div class="line"></div>

                    <h2>Lorem Ipsum Dolor</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                    <div class="line"></div>

                    <h3>Lorem Ipsum Dolor</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> -->
                    <!-- <a class="nimvelo-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="purple-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="seablue-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="blooker20-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="sexyblue-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="purplelove-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="dimigo-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="skyline-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="sel-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="sky-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="coolblues-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="megatron-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="moonlit-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="ibiza-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="frost-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="special-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="special01-gradient btn-sm btn-floating "><i class="fa fa-user"></i></a>
                    <a class="btn-floating btn-outlined btn-sm sexyblue-gradient"><center><i class="fa fa-user"></i></center></a> -->
                </div>

                
            
