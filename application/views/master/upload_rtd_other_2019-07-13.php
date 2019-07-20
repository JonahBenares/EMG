                    <div class="mt-5 pt-5">
                    <br>
                    <div class=" mb-5">
                        <div class="card-border special01-gradient animated fadeIn">
                            <div class="card plain-white">
                                <div class="card-header "><h3 class="mt-2 animated headShake"><b><span class="fa fa-upload"></span> UPLOAD RTD OTHER</b></h3></div>
                                <div class="card-body">
                                    <br>
                                    <form method="POST" action = "<?php echo base_url(); ?>index.php/master/insert_rtd"">
                                    <div class="row">
                                        <div class="col-lg-offset-3 col-lg-1"><h4><b>Date:</b></h4></div>
                                            <div class="col-lg-5"><b><input type="date" name="rtd_date" onchange="get_date()" id = "di" value = "<?php if(empty($date)){echo date('Y-m-d'); }else { echo $date;}?>" class="form-control"></b></div>
                                    </div>
                                    <br> 
                                    <table class="table table-hover table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="align-center faded-spl" width = "1%">Hour</th>
                                                <th class="align-center faded-spl">Unit</th>
                                                <th class="align-center faded-spl">Actual Load</th>
                                                <th class="align-center faded-spl">Metered Q</th>
                                                <th class="align-center faded-spl">BCQ</th>
                                                <th class="align-center faded-spl">Capacity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $a=1;
                                            for($x=1;$x<=24;$x++){ 

                                                if($x<10){
                                                    $time = '0'.$x;
                                                } else {
                                                    $time = $x;
                                                } 
                                            //}
                                            /*$count=count($other);*/
                                           // for($x=0;$x<=24;$x++){
                                            //print_r($other);
                                           // foreach($other AS $t){  
                                        ?>  
                                            <tr >
                                                <td class="align-center faded-green" rowspan="5" style="border-bottom:3px solid #dedede">
                                                    <input type="hidden" name = "other[]" style="border:0px solid #000" value = "<?php if(empty($other)){ } else{ echo $other[$x]['other_id']; }?>" readonly>
                                                    <input type="text" name = "hour[]" style="border:0px solid #000" value = "<?php echo $time;  //if(empty($other)){ echo $time; } else{ echo $other[$x]['rtd_hour']; } ?>" readonly>
                                                </td>
                                              
                                                <td class="align-center">
                                                    <input type="hidden" name = "hour[]" style="border:0px solid #000" value = "<?php if(empty($other)){ echo $time; } else{ echo $other[$x]['rtd_hour']; }?>" readonly>
                                                    <input type="text" name = "unit[]" style="border:0px solid #000;text-align:center" value = "<?php if(empty($other)){ echo '06CENPRI_U01'; } else{ echo $other[$a]['unit']; }?>">
                                                </td>
                                               
                                                <td>
                                                    <input type="text" name = "actual_load[]" style="border:0px solid #000" value = "<?php if(empty($other)){ } else{ echo $other[$a]['actual_load']; }?>">
                                                </td>
                                                <td>
                                                    <input type="text" name = "metered[]" style="border:0px solid #000" value = "<?php if(empty($other)){ } else{ echo $other[$a]['metered_q']; }?>">
                                                </td>
                                                
                                                 <td>
                                                    <input type="text" name = "bcq[]" style="border:0px solid #000" value = "<?php if(empty($other)){ } else{ echo $other[$a]['bcq']; }?>">
                                                </td>
                                                <td>
                                                    <input type="text" name = "capacity[]" style="border:0px solid #000" value = "<?php if(empty($other)){ } else{ echo $other[$a]['capacity'];}?>">
                                                </td>
                                               
                                            </tr>
                                            <?php $a++; ?>
                                            <tr>
                                              
                                                <td class="align-center">
                                                    <input type="hidden" name = "hour[]" style="border:0px solid #000" value = "<?php if(empty($other)){ echo $time; } else{ echo $other[$x]['rtd_hour']; }?>" readonly>
                                                    <input type="text" name = "unit[]" style="border:0px solid #000;text-align:center" value = "<?php if(empty($other)){ echo '06CENPRI_U02'; } else{ echo $other[$a]['unit']; }?>">
                                                </td>
                                                <td>
                                                    <input type="text" name = "actual_load[]" style="border:0px solid #000" value = "<?php if(empty($other)){ } else{ echo $other[$a]['actual_load']; }?>">
                                                </td>
                                                <td>
                                                    <input type="text" name = "metered[]" style="border:0px solid #000" value = "<?php if(empty($other)){ } else{ echo $other[$a]['metered_q']; }?>">
                                                </td>
                                                
                                                 <td>
                                                    <input type="text" name = "bcq[]" style="border:0px solid #000" value = "<?php if(empty($other)){ } else{ echo $other[$a]['bcq']; }?>">
                                                </td>
                                                <td>
                                                    <input type="text" name = "capacity[]" style="border:0px solid #000" value = "<?php if(empty($other)){ } else{ echo $other[$a]['capacity'];}?>">
                                                </td>
                                                
                                            </tr>
                                            <?php $a++; ?>
                                            <tr>
                                                <td class="align-center">
                                                   <input type="hidden" name = "hour[]" style="border:0px solid #000" value = "<?php if(empty($other)){ echo $time; } else{ echo $other[$x]['rtd_hour']; }?>" readonly> 
                                                    <input type="text" name = "unit[]" style="border:0px solid #000;text-align:center" value = "<?php if(empty($other)){ echo '06CENPRI_U03'; } else{ echo $other[$a]['unit']; }?>">
                                                </td>
                                                <td>
                                                    <input type="text" name = "actual_load[]" style="border:0px solid #000" value = "<?php if(empty($other)){ } else{ echo $other[$a]['actual_load']; }?>">
                                                </td>
                                                <td>
                                                    <input type="text" name = "metered[]" style="border:0px solid #000" value = "<?php if(empty($other)){ } else{ echo $other[$a]['metered_q']; }?>">
                                                </td>
                                                
                                                 <td>
                                                    <input type="text" name = "bcq[]" style="border:0px solid #000" value = "<?php if(empty($other)){ } else{ echo $other[$a]['bcq']; }?>">
                                                </td>
                                                <td>
                                                    <input type="text" name = "capacity[]" style="border:0px solid #000" value = "<?php if(empty($other)){ } else{ echo $other[$a]['capacity'];}?>">
                                                </td>
                                            </tr>
                                             <?php $a++; ?>
                                            <tr>
                                                <td class="align-center">
                                                    <input type="hidden" name = "hour[]" style="border:0px solid #000" value = "<?php if(empty($other)){ echo $time; } else{ echo $other[$x]['rtd_hour']; }?>" readonly>
                                                    <input type="text" name = "unit[]" style="border:0px solid #000;text-align:center" value = "<?php if(empty($other)){ echo '06CENPRI_U04'; } else{ echo $other[$a]['unit']; }?>">
                                                </td>
                                                <td>
                                                    <input type="text" name = "actual_load[]" style="border:0px solid #000" value = "<?php if(empty($other)){ } else{ echo $other[$a]['actual_load']; }?>">
                                                </td>
                                                <td>
                                                    <input type="text" name = "metered[]" style="border:0px solid #000" value = "<?php if(empty($other)){ } else{ echo $other[$a]['metered_q']; }?>">
                                                </td>
                                                
                                                 <td>
                                                    <input type="text" name = "bcq[]" style="border:0px solid #000" value = "<?php if(empty($other)){ } else{ echo $other[$a]['bcq']; }?>">
                                                </td>
                                                <td>
                                                    <input type="text" name = "capacity[]" style="border:0px solid #000" value = "<?php if(empty($other)){ } else{ echo $other[$a]['capacity'];}?>">
                                                </td>
                                            </tr>
                                             <?php $a++; ?>
                                            <tr style="border-bottom:3px solid #dedede">
                                                <td class="align-center">
                                                    <input type="text" name = "unit[]" style="border:0px solid #000;text-align:center" value = "<?php if(empty($other)){ echo '06CENPRI_U05'; } else{ echo $other[$a]['unit']; }?>">
                                                </td>
                                                <td>
                                                    <input type="text" name = "actual_load[]" style="border:0px solid #000" value = "<?php if(empty($other)){ } else{ echo $other[$a]['actual_load']; }?>">
                                                </td>
                                                <td>
                                                    <input type="text" name = "metered[]" style="border:0px solid #000" value = "<?php if(empty($other)){ } else{ echo $other[$a]['metered_q']; }?>">
                                                </td>
                                                
                                                 <td>
                                                    <input type="text" name = "bcq[]" style="border:0px solid #000" value = "<?php if(empty($other)){ } else{ echo $other[$a]['bcq']; }?>">
                                                </td>
                                                <td>
                                                    <input type="text" name = "capacity[]" style="border:0px solid #000" value = "<?php if(empty($other)){ } else{ echo $other[$a]['capacity'];}?>">
                                                </td>
                                            </tr>

                                            <?php
                                            $a++;
                                          } //} ?>
                                        </tbody>
                                    </table>
                                    <input type='hidden' name='userid' value="<?php echo $_SESSION['user_id']; ?>">
                                    <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                    <button class="btn btn-md btn-block btn-primary" type = "submit">Upload</button>   
                                </div>
                                </form>
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
                <script type="text/javascript">
                    function get_date(){
                        var date = $('#di').val();
                        var loc= document.getElementById("baseurl").value;
                        window.location.href = loc+"index.php/master/upload_rtd_other/"+date;
                    }
                </script>

                
            
