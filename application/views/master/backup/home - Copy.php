<script type="text/javascript">
    function autoRefreshPage()
    {
        window.location = window.location.href;
    }
    setInterval('autoRefreshPage()', 300000);
</script>
                    <div class="mt-5 pt-5">
                    <br>
                    <div class="card-border special01-gradient animated fadeIn mb-5">
                        <div class="card plain-white">
                            <div class="card-header "><h3 class="animated headShake mt-2"><b><span class="fa fa-eye"></span> IMMEDIATE VIEWER</b></h3></div>
                            <div class="card-body">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="align-left faded-yellow" colspan="8" >
                                                <label class="pl-3" style="font-size: 1.6em">
                                                    <span class="fa fa-calendar"></span> 
                                                </label>
                                                <label class="pl-3" style="font-size: 1.6em">
                                                    <input type="date" value = "<?php if(empty($date)){echo date('Y-m-d'); }else { echo $date;}?>" name="imm_date" onchange="get_date()" id = 'di' class="mb-1" >
                                                </label>
                                            </th>
                                            <th class="align-center faded-green" colspan="3">ANCILLARY OFFERED</th>
                                            <th class="align-center faded-orange" colspan="3">ANCILLARY CONFIRMED</th>
                                        </tr>
                                        <tr>
                                            <th class="align-center faded-spl">Hour</th>
                                            <th class="align-center faded-spl">Capacity</th>
                                            <th class="align-center faded-spl">Actual Load</th>
                                            <th class="align-center faded-spl">Metered Q</th>
                                            <th class="align-center faded-spl">RTD</th>
                                            <th class="align-center faded-spl">EAP</th>
                                            <th class="align-center faded-spl">PEN</th>
                                            <th class="align-center faded-spl">BCQ</th>
                                            <th class="align-center faded-green">Reg</th>
                                            <th class="align-center faded-green">Con</th>
                                            <th class="align-center faded-green">Dis</th>
                                            <th class="align-center faded-orange">Reg</th>
                                            <th class="align-center faded-orange">Con</th>
                                            <th class="align-center faded-orange">Dis</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php 
                                            if(!empty($details)){
                                                foreach($details AS $det){
                                        ?>
                                        <tr>
                                            <td class="align-center" style="">
                                                <a class="btn btn-xs btn-circle <?php echo (($det['count']<12) ? 'btn-danger' : 'special-gradient'); ?>" href="<?php echo base_url(); ?>index.php/reports/dhourly_report/null/<?php echo date('Y-m-d'); ?>/<?php echo $det['time']; ?>" target="_blank">
                                                    <?php echo $det['time'];?>
                                                </a>
                                              
                                            </td>
                                            <td><?php echo number_format($det['cap'],2);?></td>
                                            <td><?php echo number_format($det['actual'],2);?></td>
                                            <td><?php echo number_format($det['mtr'],2);?></td>
                                            <td></td>
                                            <td><?php echo number_format($det['eap'],2); ?></td>
                                            <td></td>
                                            <td><?php echo $det['bcq'];?></td>
                                            <td class="faded-green"></td>
                                            <td class="faded-green"></td>
                                            <td class="faded-green"></td>
                                            <td class="faded-orange"></td>
                                            <td class="faded-orange"></td>
                                            <td class="faded-orange"></td>
                                        </tr>
                                        <?php } } else { ?>
                                        <?php 
                                            for($x=0;$x<=23;$x++){
                                                if($x<10){
                                                $time = '0'.$x;
                                            } else {
                                                $time = $x;
                                            } 
                                        ?>
                                        <tr>
                                            <td class="align-center" style="">
                                                <a class="btn btn-xs btn-circle special-gradient" href="<?php echo base_url(); ?>index.php/reports/dhourly_report/<?php echo date('Y-m-d'); ?>/<?php echo $time;?>" target="_blank">
                                                    <?php echo $time; ?>
                                                </a>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="faded-green"></td>
                                            <td class="faded-green"></td>
                                            <td class="faded-green"></td>
                                            <td class="faded-orange"></td>
                                            <td class="faded-orange"></td>
                                            <td class="faded-orange"></td>
                                        </tr>
                                        <?php } } ?>
                                        <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                    </tbody>
                                </table>
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
                        window.location.href = loc+"index.php/master/home/"+date;
                    }
                </script>

                
            
