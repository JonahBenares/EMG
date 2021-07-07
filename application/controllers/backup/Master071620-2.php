<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        date_default_timezone_set("Asia/Manila");
        $this->load->model('super_model');
        function arrayToObject($array){
            if(!is_array($array)) { return $array; }
            $object = new stdClass();
            if (is_array($array) && count($array) > 0) {
                foreach ($array as $name=>$value) {
                    $name = strtolower(trim($name));
                    if (!empty($name)) { $object->$name = arrayToObject($value); }
                }
                return $object;
            } 
            else {
                return false;
            }
        }
    }

    public function index(){  
        $this->load->view('template/header_login');
        $this->load->view('master/login');
        $this->load->view('template/footer');
    }

    public function login_process(){
        $username=$this->input->post('username');
        $password=$this->input->post('password');
        $count=$this->super_model->login_user($username,$password);
        if($count>0){   
            $password1 =md5($this->input->post('password'));
            $fetch=$this->super_model->select_custom_where("users", "username = '$username' AND (password = '$password' OR password = '$password1')");
            foreach($fetch AS $d){
                $userid = $d->user_id;
                $username = $d->username;
            }
            $newdata = array(
               'user_id'=> $userid,
               'username'=> $username,
               'logged_in'=> TRUE
            );
            $this->session->set_userdata($newdata);
           
            echo "<script>window.location ='".base_url()."index.php/master/home'; </script>";
        }
        else{
            $this->session->set_flashdata('error_msg', 'Username And Password Do not Exist!');
            $this->load->view('template/header_login');
            $this->load->view('master/login');
            $this->load->view('template/footer');       
        }
    }

    public function home(){  
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $date1=$this->uri->segment(3);
        $unit=$this->uri->segment(4);
        $data['date'] = $date1;
        $data['unit'] = $unit;
        
        for($x=0;$x<=23;$x++){
             if($x<10){
                $time = '0'.$x;
            } else {
                $time = $x;
            }

            if(!empty($date1)){
                $date = $date1 ." " .$time;
            }else{
                $date = date('Y-m-d').' '. $time;
            }

            if(!empty($unit)){
                $un_info = "AND price_node = '$unit'";
                $un_other = "AND unit = '$unit'";
               
            }else{
                $un_info = "";
                $un_other = "";
            }

            $except = $date1. " " .$time.":00";
            $next = $time+1;
            if($next<10){
                $next = '0'.$next;
            } else {
                $next=$next;
            }

            $include = $date1 . " " .$next.":00";
            if($next =='24'){
                $date2 = date('Y-m-d',strtotime($date1.'+1 day'));   
                $d = $date2 . " 00:00";
                $inc = " OR interval_time = '$d'";
               
            } else {
                $inc ='';
            }
        
          if(!empty($unit)){
                $average = $this->super_model->select_ave_where("rtd_info", "lmp", "(interval_time LIKE '%$date%' OR interval_time = '$include' $inc) AND interval_time != '$except'". $un_info .""); 
             
                $rtd = $this->super_model->select_ave_where("rtd_info", "megawatts", "(interval_time LIKE '%$date%' OR interval_time = '$include' $inc) AND interval_time != '$except'". $un_info .""); 
                $capacity = $this->super_model->select_ave_where("rtd_other", "capacity", "rtd_hour = '$next' AND rtd_date = '$date1' AND capacity !='0' ".$un_other."");
                $anc_offered = $this->super_model->select_ave_where("rtd_other", "anc_offered", "rtd_hour = '$next' AND rtd_date = '$date1' AND anc_offered !='0' ".$un_other."");
                $anc_confirmed = $this->super_model->select_ave_where("rtd_other", "anc_confirmed", "rtd_hour = '$next' AND rtd_date = '$date1' AND anc_confirmed !='0' ".$un_other."");
                $actual_load = $this->super_model->select_ave_where("rtd_other", "actual_load", "rtd_hour = '$next' AND rtd_date = '$date1' AND actual_load !='0' ".$un_other."");
                $mtr = $this->super_model->select_ave_where("rtd_other", "metered_q", "rtd_hour = '$next' AND rtd_date = '$date1' AND metered_q !='0' ".$un_other."");
                $bcq = $this->super_model->select_ave_where("rtd_other", "bcq", "rtd_hour = '$next' AND rtd_date = '$date1' AND bcq !='0' ".$un_other."");
            } else {
                 $ave=array();
                $r=array();
                $ca=array();
                $ac=array();
                $mt=array();
                $bc=array();
                $anc_o[]=array();
                $anc_c[]=array();
                for($a=1;$a<=5;$a++){
                    $ut='06CENPRI_U0'.$a;
                    
                    $r[]= $this->super_model->select_ave_where("rtd_info", "megawatts", "(interval_time LIKE '%$date%' OR interval_time = '$include' $inc) AND interval_time != '$except' AND price_node='$ut'"); 
                    $ca[] = $this->super_model->select_ave_where("rtd_other", "capacity", "rtd_hour = '$time' AND rtd_date = '$date1' AND capacity !='0' AND unit='$ut'");
                    $anc_o[] = $this->super_model->select_ave_where("rtd_other", "anc_offered", "rtd_hour = '$next' AND rtd_date = '$date1' AND anc_offered !='0' AND unit='$ut'");
                    $anc_c[] = $this->super_model->select_ave_where("rtd_other", "anc_confirmed", "rtd_hour = '$next' AND rtd_date = '$date1' AND anc_confirmed !='0' AND unit='$ut'");
                    $ac[] = $this->super_model->select_ave_where("rtd_other", "actual_load", "rtd_hour = '$time' AND rtd_date = '$date1' AND actual_load !='0' AND unit='$ut'");
                    $mt[] = $this->super_model->select_ave_where("rtd_other", "metered_q", "rtd_hour = '$time' AND rtd_date = '$date1' AND metered_q !='0' AND unit='$ut'");
                    $bc[] = $this->super_model->select_ave_where("rtd_other", "bcq", "rtd_hour = '$time' AND rtd_date = '$date1' AND bcq !='0' AND unit='$ut'");
                }

                $average = $this->super_model->select_ave_where("rtd_info", "lmp", "(interval_time LIKE '%$date%' OR interval_time = '$include' $inc) AND interval_time != '$except'". $un_info .""); 
                //echo "(interval_time LIKE '%$date%' OR interval_time = '$include' $inc) AND interval_time != '$except'". $un_info ."<br>";
                $rtd=array_sum($r);
                $capacity=array_sum($ca);
                $actual_load=array_sum($ac);
                $mtr=array_sum($mt);
                $bcq =array_sum($bc);
                $anc_offered =array_sum($anc_o);
                $anc_confirmed =array_sum($anc_c);
            }
            $count_hour=$this->super_model->count_distinct("interval_time", "rtd_info","(interval_time LIKE '%$date%' OR interval_time = '$include' $inc) AND interval_time != '$except'");
            /*echo "(interval_time LIKE '%$date%' OR interval_time = '$include' $inc) AND interval_time != '$except'<br>";
            echo $date . " = ". $count_hour."<br>";*/
            $time=$time+1;
            if($time<=9){
                $time='0'.$time;
            }
            $revenue = $mtr*$average;
            $data['details'][] = array(
                "time"=>$time,
                "eap"=>$average,
                "cap"=>$capacity,
                "rtd"=>$rtd,
                "actual"=>$actual_load,
                "mtr"=>$mtr,
                "bcq"=>$bcq,
                "count"=>$count_hour,
                "revenue"=>$revenue,
                "anc_offered"=>$anc_offered,
                "anc_confirmed"=>$anc_confirmed,
                "unit"=>$unit
            );
        }
        $this->load->view('master/home',$data);
        $this->load->view('template/footer');
    }

    public function upload_rtd_other(){
        $date=$this->uri->segment(3);
        $data['date']= $date;
        /*$hour=$this->input->post('hour');
        $data['hour']=$hour;*/
        /*if(empty($date)){
            $data['test'] = $this->super_model->select_custom_where("rtd_other","rtd_date = '$date1'");
        }else {
            $data['test'] = $this->super_model->select_custom_where("rtd_other","rtd_date = '$date'");
        }*/
        /*$rows=$this->super_model->count_rows("rtd_other");
        if($rows!=0){*/
        $row=$this->super_model->count_rows_where("rtd_other",'rtd_date', $date);
        if($row!=0){
                foreach($this->super_model->select_row_where('rtd_other','rtd_date', $date) AS $rtd){
                    $data['other'][] = array(
                        'other_id'=>$rtd->other_id,
                        'rtd_date'=>$rtd->rtd_date,
                        'rtd_hour'=>$rtd->rtd_hour,
                        'actual_load'=>$rtd->actual_load,
                        'metered_q'=>$rtd->metered_q,
                        'bcq'=>$rtd->bcq,
                        'capacity'=>$rtd->capacity,
                        'anc_offered'=>$rtd->anc_offered,
                        'anc_confirmed'=>$rtd->anc_confirmed,
                        'unit'=>$rtd->unit
                    );
                }
        }else{
            $data['other'] = array();
        }
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('master/upload_rtd_other', $data);
        $this->load->view('template/footer');
    }

    public function insert_rtd(){
        date_default_timezone_set("Asia/Taipei");
        $time = date('g:i:s A');
        $date=$this->uri->segment(3);
        $counter = count($this->input->post('hour'));
        $x = 0;
        for($a=0;$a<=$counter;$a++){
            //$hour=$this->input->post('hour['.$a.']');
            //$rtd_date=$this->input->post('rtd_date['.$a.']');
            //$actual_load=$this->input->post('actual_load['.$a.']');
            //$metered=$this->input->post('metered['.$a.']');
            //$bcq=$this->input->post('bcq['.$a.']');
            //$capacity=$this->input->post('capacity['.$a.']');
            $data = array(
                'rtd_hour'=>$this->input->post('hour['.$a.']'),
                'rtd_date'=>$this->input->post('rtd_date'),
                'actual_load'=>$this->input->post('actual_load['.$a.']'),
                'metered_q'=>$this->input->post('metered['.$a.']'),
                'bcq'=>$this->input->post('bcq['.$a.']'),
                'capacity'=>$this->input->post('capacity['.$a.']'),
                'upload_time'=>$time,
                'unit'=>$this->input->post('unit['.$a.']'),
                'anc_offered'=>$this->input->post('anc_offered['.$a.']'),
                'anc_confirmed'=>$this->input->post('anc_confirmed['.$a.']'),
                'user_id'=>$this->input->post('userid')
            );

            $rtd_date=$this->input->post('rtd_date');
            $id=$this->input->post('other['.$x.']');
            $row=$this->super_model->count_rows_where("rtd_other","other_id",$id);
            //echo $x."<br>";
            //echo $id."<br>";
            if($id!=0){
                if($this->super_model->update_where("rtd_other", $data,'other_id',$id)){
                    echo "<script>alert('Successfully Updated!'); window.location ='".base_url()."index.php/master/upload_rtd_other/$rtd_date'; </script>";
                }
            }else {
                if($this->super_model->insert_into("rtd_other", $data)){
                    echo "<script>alert('Successfully Added!'); window.location ='".base_url()."index.php/master/upload_rtd_other/$rtd_date'; </script>";
                }
            }

            $x++;
        }
    }

    public function dhourly_report(){  
        $time=$this->uri->segment(4);
        $time['time']=$this->uri->segment(4);
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('master/dhourly_report',$data);
        $this->load->view('template/footer');
    }

    public function user_list(){  
        $data['type'] = $this->super_model->select_all("usertype");
        $data['user'] = $this->super_model->select_all("users");
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('master/user_list',$data);
        $this->load->view('template/footer');
    }

    public function user_update(){
        $data['id']=$this->uri->segment(3);
        $id=$this->uri->segment(3);  
        $data['type'] = $this->super_model->select_all("usertype");
        $data['user'] = $this->super_model->select_row_where('users', 'user_id', $id);
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('master/user_update',$data);
        $this->load->view('template/footer');
    }

    public function edit_user(){
        $data = array(
            'username'=>$this->input->post('username'),
            'usertype_id'=>$this->input->post('usertype'),
            'fullname'=>$this->input->post('fname'),
            'status'=>$this->input->post('status')
        );
        $id = $this->input->post('id');
            if($this->super_model->update_where('users', $data, 'user_id', $id)){
            echo "<script>alert('Successfully Updated'); 
                window.location ='".base_url()."index.php/master/user_list'; </script>";
        }
    }

     public function newpass(){
        $newpassword = md5($this->input->post('newpass'));
        $data = array(
            'password'=> $newpassword
        );
        $userid = $this->input->post('userid');

        $password = $this->super_model->select_column_where("users", "password", "user_id", $userid);

        $oldpassword = ($this->input->post('oldpass'));
        $oldpasswordmd5 = md5($this->input->post('oldpass'));
        if($oldpassword == $password){
            if($this->super_model->update_where("users", $data, "user_id" , $userid )){
                echo "<script>alert('Successfully Updated'); location.replace(document.referrer); </script>";
            }
        }else if(md5($oldpasswordmd5) == md5($password)) {
            if($this->super_model->update_where("users", $data,"user_id" , $userid)){
                echo "<script>alert('Successfully Updated'); location.replace(document.referrer); </script>";
            }
        }else{
            echo "<script>alert('Incorrect Old Password!'); location.replace(document.referrer); </script>";
        }
    }

    public function insert_user(){
        $fname = $this->input->post('fullname');
        $usertype = $this->input->post('usertype');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $status = $this->input->post('status');
        $data = array(
            'fullname'=>$fname,
            'usertype_id'=>$usertype,
            'username'=>$username,
            'password'=>md5($password),
            'status'=>$status,
        );
        $row=$this->super_model->count_custom_where('users',"username = '$username'"); 
        if($row<>0){
            echo "<script>alert('This Username is already in the system!'); 
                    window.location ='".base_url()."index.php/master/user_list'; </script>;";
        }
        else{
            if($this->super_model->insert_into("users", $data)){
                echo "<script>alert('Successfully Added!'); 
                window.location ='".base_url()."index.php/master/user_list'; </script>";
            }
        }
    }

    public function export(){
        $date1=$this->uri->segment(3);
        $unit=$this->uri->segment(4);
        require_once(APPPATH.'../assets/js/phpexcel/Classes/PHPExcel/IOFactory.php');
        $objPHPExcel = new PHPExcel();
        $exportfilename="Immediate Viewer.xlsx";

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        if($date!='null'){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "Date: $date1");
        }else{
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "Date:");
        }
        if($unit!='null'){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', "Unit: $unit");
        }else{
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', "Unit:");
        }
        $objPHPExcel->getActiveSheet()->getStyle("A1:K1")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('DFFAAA');
        $objPHPExcel->getActiveSheet()->getStyle("A2:K2")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('36EAFF');
        $objPHPExcel->getActiveSheet()->getStyle("L1:N1")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('83F997');
        $objPHPExcel->getActiveSheet()->getStyle("L2:N2")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('83F997');
        $objPHPExcel->getActiveSheet()->getStyle("O1:R1")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('DFFAAA');
        $objPHPExcel->getActiveSheet()->getStyle("O2:R2")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('DFFAAA');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L1', "ANCILLARY OFFERED");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O1', "ANCILLARY CONFIRMED");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R1', "Revenue");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', "Hour");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', "Capacity");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E2', "Actual Load");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G2', "Metered Q");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I2', "RTD");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J2', "EAP");
        //$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K2', "PEN");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K2', "BCQ");
        //$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M2', "REG");
        //$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N2', "CON");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L2', "DIS");
        //$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P2', "REG");
        //$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q2', "CON");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O2', "DIS");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R2', "Revenue");
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                  'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A1:R1')->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('A2:R2')->applyFromArray($styleArray);
        $num=3;
        for($x=0;$x<=23;$x++){
            if($x<10){
                $time = '0'.$x;
            } else {
                $time = $x;
            } 

            if(!empty($date1)){
                $date = $date1 ." " .$time;
            }else{
                $date = date('Y-m-d').' '. $time;
            }

            if(!empty($unit)){
                $un_info = "AND price_node = '$unit'";
                $un_other = "AND unit = '$unit'";
               
            }else{
                $un_info = "";
                $un_other = "";
            }

            $except = $date1. " " .$time.":00";
            $next = $time+1;
            if($next<10){
                $next = '0'.$next;
            } else {
                $next=$next;
            }

            $include = $date1 . " " .$next.":00";
            if($next =='25'){
                $date1 = date('Y-m-d',strtotime($date1.'+1 day'));   
                $d = $date1 . " 00:00";
                $inc = " OR interval_time = '$d'";
               
            } else {
                $inc ='';
            }
            /*$average = $this->super_model->select_ave_where("rtd_info", "lmp", "interval_time LIKE '%$date%' ". $un_info .""); 
            $rtd = $this->super_model->select_ave_where("rtd_info", "megawatts", "interval_time LIKE '%$date%' ". $un_info ."");
            $capacity = $this->super_model->select_ave_where("rtd_other", "capacity", "rtd_hour = '$time' AND rtd_date = '$date1' AND capacity !='0' ".$un_other."");
            $actual_load = $this->super_model->select_ave_where("rtd_other", "actual_load", "rtd_hour = '$time' AND rtd_date = '$date1' AND actual_load !='0' ".$un_other."");
            $mtr = $this->super_model->select_ave_where("rtd_other", "metered_q", "rtd_hour = '$time' AND rtd_date = '$date1' AND metered_q !='0' ".$un_other."");
            $bcq = $this->super_model->select_ave_where("rtd_other", "bcq", "rtd_hour = '$time' AND rtd_date = '$date1' AND bcq !='0' ".$un_other."");
            $count_hour=$this->super_model->count_distinct("interval_time", "rtd_info","interval_time LIKE '%$date%'");*/
            $average = $this->super_model->select_ave_where("rtd_info", "lmp", "(interval_time LIKE '%$date%' OR interval_time = '$include' $inc) AND interval_time != '$except'". $un_info ."");  
            $rtd = $this->super_model->select_ave_where("rtd_info", "megawatts", "(interval_time LIKE '%$date%' OR interval_time = '$include' $inc) AND interval_time != '$except'". $un_info .""); 
            $capacity = $this->super_model->select_ave_where("rtd_other", "capacity", "rtd_hour = '$next' AND rtd_date = '$date1' AND capacity !='0' ".$un_other."");
            $anc_offered = $this->super_model->select_ave_where("rtd_other", "anc_offered", "rtd_hour = '$next' AND rtd_date = '$date1' AND anc_offered !='0' ".$un_other."");
            $anc_confirmed = $this->super_model->select_ave_where("rtd_other", "anc_confirmed", "rtd_hour = '$next' AND rtd_date = '$date1' AND anc_confirmed !='0' ".$un_other."");
            $actual_load = $this->super_model->select_ave_where("rtd_other", "actual_load", "rtd_hour = '$next' AND rtd_date = '$date1' AND actual_load !='0' ".$un_other."");
            $mtr = $this->super_model->select_ave_where("rtd_other", "metered_q", "rtd_hour = '$next' AND rtd_date = '$date1' AND metered_q !='0' ".$un_other."");
            $bcq = $this->super_model->select_ave_where("rtd_other", "bcq", "rtd_hour = '$next' AND rtd_date = '$date1' AND bcq !='0' ".$un_other."");

            $count_hour=$this->super_model->count_distinct("interval_time", "rtd_info","(interval_time LIKE '%$date%' OR interval_time = '$include' $inc) AND interval_time != '$except'");
            $revenue = $mtr*$average;
            $time=$time+1;
            if($time<=9){
                $time='0'.$time;
            }

            if($capacity==0){
                $capacity='0.00';
            }
            else {
                $capacity = $capacity;
            }

            if($actual_load==0){
                $actual_load='0.00';
            }
            else {
                $actual_load = $actual_load;
            }

            if($mtr==0){
                $mtr='0.00';
            }
            else {
                $mtr = $mtr;
            }

            if($average==0){
                $average='0.00';
            }
            else {
                $average = $average;
            }
            
            if($rtd==0){
                $rtd='0.00';
            }
            else {
                $rtd = $rtd;
            }

            if($anc_offered==0){
                $anc_offered='0.00';
            }
            else {
                $anc_offered = $anc_offered;
            }

            if($anc_confirmed==0){
                $anc_confirmed='0.00';
            }
            else {
                $anc_confirmed = $anc_confirmed;
            }

            if($bcq==0){
                $bcq='0.00';
            }
            else {
                $bcq = $bcq;
            }

            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $time);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$num, $capacity);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$num, $actual_load);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$num, $mtr);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$num, $rtd);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$num, $average);
            //$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$num, '');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$num, $bcq);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$num, $anc_offered);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$num, $anc_confirmed);
            /*$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$num, '');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$num, '');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$num, '');*/
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.$num, $revenue);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$num.":R".$num)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":R".$num)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->getStyle('L'.$num.":N".$num)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('83F997');
            $objPHPExcel->getActiveSheet()->getStyle('O'.$num.":R".$num)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('DFFAAA');
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('L'.$num.":R".$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$num.":B".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('C'.$num.":D".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('E'.$num.":F".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('G'.$num.":H".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('L'.$num.":N".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('O'.$num.":Q".$num);
            $num++;
        }
        $objPHPExcel->getActiveSheet()->mergeCells('A1:D1');
        $objPHPExcel->getActiveSheet()->mergeCells('E1:K1');
        $objPHPExcel->getActiveSheet()->mergeCells('A2:B2');
        $objPHPExcel->getActiveSheet()->mergeCells('C2:D2');
        $objPHPExcel->getActiveSheet()->mergeCells('E2:F2');
        $objPHPExcel->getActiveSheet()->mergeCells('G2:H2');
        $objPHPExcel->getActiveSheet()->mergeCells('L1:N1');
        $objPHPExcel->getActiveSheet()->mergeCells('O1:Q1');
        $objPHPExcel->getActiveSheet()->mergeCells("L2:N2");
        $objPHPExcel->getActiveSheet()->mergeCells("O2:Q2");
        $objPHPExcel->getActiveSheet()->getStyle('L1:O1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A2:R2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true)->setName('Arial Black')->setSize(13);
        $objPHPExcel->getActiveSheet()->getStyle("E1")->getFont()->setBold(true)->setName('Arial Black')->setSize(13);
        //$objPHPExcel->getActiveSheet()->getStyle("E2")->getFont()->setBold(true)->setName('Arial Black')->setSize(13);
        $objPHPExcel->getActiveSheet()->getStyle('A2:R2')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('L1:O1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        if (file_exists($exportfilename))
        unlink($exportfilename);
        $objWriter->save($exportfilename);
        unset($objPHPExcel);
        unset($objWriter);   
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Immediate Viewer.xlsx"');
        readfile($exportfilename);
        //echo "<script>window.location = 'import_items';</script>";
    }
}