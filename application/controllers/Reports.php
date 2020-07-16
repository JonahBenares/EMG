<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

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

      public function dhourly_report(){  
        $data['unit']=$this->uri->segment(3);
        $data['date']=$this->uri->segment(4);
        $data['time1']=$this->uri->segment(5);

        $unit= $this->uri->segment(3);       
        $date= $this->uri->segment(4);
        $time1= $this->uri->segment(5);
        

        if($time1 == 'null'){
            $time1 = '';
        } 

        if($date=='null'){
            $date = '';
        }
        if(!empty($time1)){
            $interval = $date ." ". $time1;
            $sql="";
            if($unit!='null'){
               $sql.= " price_node = '$unit' AND";
            }

            if($interval!='null' || !empty($interval)){
               $except = $date . " " .$time1.":00";
               $next = $time1+1;
               if($next<10){
                    $next = '0'.$next;
               } else {
                $next=$next;
               }
               $include = $date . " " .$next.":00"; 

                if($next =='24'){
                $date1 = date('Y-m-d',strtotime($date.'+1 day'));   
                $d = $date1 . " 00:00";
                $inc = " OR interval_time = '$d'";
               
                } else {
                    $inc ='';
                }

               $sql.= " (interval_time LIKE '%$interval%' OR interval_time = '$include' $inc) AND interval_time != '$except' AND";
            }
            $query=substr($sql,0,-3);
        } else if(empty($time1)){
            $date1 = date('Y-m-d',strtotime($date.'+1 day'));   
            $interval = $date;
            $sql="";
            if($unit!='null'){
               $sql.= " price_node = '$unit' AND";
            }

            if($interval!='null' || !empty($interval)){
               $except = $date . " " ."00:00";
              
               $include = $date1 . " " ."00:00"; 
               $sql.= " (interval_time LIKE '%$interval%' OR interval_time = '$include') AND interval_time != '$except' AND";
            }
            $query=substr($sql,0,-3);
        }
        // /echo $query;
        $count=$this->super_model->custom_query("SELECT * FROM rtd_info WHERE $query");
        if($count!=0){
            foreach($this->super_model->custom_query("SELECT * FROM rtd_info WHERE $query ORDER BY interval_time, price_node DESC") AS $all){
              /*  $next = date('H:i',strtotime($all->interval_time));
                if($next == '00:00'){
                    $date1 = date('Y-m-d',strtotime($all->interval_time.'-1 day'));   
                }else {
                    $date1 = date('Y-m-d',strtotime($all->interval_time));
                }
                $next = $date1." ".$next;*/

                $data['info'][] = array(
                    'interval'=>$all->interval_time,
                    'node'=>$all->price_node,
                    'mw'=>$all->megawatts,
                    'lmp'=>$all->lmp,
                    'loss'=>$all->loss_factor
                );
           }
        }

        /*$interval = $date . " " .$time;*/
        /*$data['info']=$this->super_model->select_custom_where("rtd_info", "interval_time LIKE '%$interval%'");*/
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('report/dhourly_report',$data);
        $this->load->view('template/footer');
    }

    public function export(){
        $unit=$this->uri->segment(3);
        $date=$this->uri->segment(4);
        $time1=$this->uri->segment(5);
        if($time1 == 'null'){
            $time1 = '';
        }
        require_once(APPPATH.'../assets/js/phpexcel/Classes/PHPExcel/IOFactory.php');
        $objPHPExcel = new PHPExcel();
        $exportfilename="Detailed Hourly Report.xlsx";

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        if($unit!='null'){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "Unit: $unit");
        }else{
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "Unit:");
        }
        if($date!='null'){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', "Date: $date");
        }else{
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', "Date:");
        }
        if($time!='null'){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E2', "Time: $time1");
        }else{
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E2', "Time:");
        }
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', "Interval Time");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', "Price Node");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E3', "Megawatts");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G3', "LMP");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I3', "Loss Factor");
        $num=4;
        if($unit !='null' && $date!='null' && $time!='null'){
            $interval = $date ." ". $time1;
            if($interval!='null' || !empty($interval)){
               $except = $date . " " .$time1.":00";
               $next = $time1+1;
               if($next<10){
                    $next = '0'.$next;
               } else {
                $next=$next;
               }
               $include = $date . " " .$next.":00"; 
            }
            foreach($this->super_model->custom_query("SELECT * FROM rtd_info WHERE (interval_time LIKE '%$interval%' OR interval_time = '$include') AND interval_time != '$except' AND price_node = '$unit'") AS $all){
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $all->interval_time);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$num, $all->price_node);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$num, $all->megawatts);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$num, $all->lmp);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$num, $all->loss_factor);
                $objPHPExcel->getActiveSheet()->mergeCells('A'.$num.":B".$num);
                $objPHPExcel->getActiveSheet()->mergeCells('C'.$num.":D".$num);
                $objPHPExcel->getActiveSheet()->mergeCells('E'.$num.":F".$num);
                $objPHPExcel->getActiveSheet()->mergeCells('G'.$num.":H".$num);
                $objPHPExcel->getActiveSheet()->mergeCells('I'.$num.":J".$num);
                $objPHPExcel->getActiveSheet()->getStyle('C'.$num.":K".$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $num++;
            }
        }else if($date!='null' && $time1!='null'){
            $interval = $date ." ". $time1;
            foreach($this->super_model->custom_query("SELECT * FROM rtd_info WHERE interval_time LIKE '%$interval%'") AS $all){
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $all->interval_time);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$num, $all->price_node);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$num, $all->megawatts);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$num, $all->lmp);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$num, $all->loss_factor);
                $objPHPExcel->getActiveSheet()->mergeCells('A'.$num.":B".$num);
                $objPHPExcel->getActiveSheet()->mergeCells('C'.$num.":D".$num);
                $objPHPExcel->getActiveSheet()->mergeCells('E'.$num.":F".$num);
                $objPHPExcel->getActiveSheet()->mergeCells('G'.$num.":H".$num);
                $objPHPExcel->getActiveSheet()->mergeCells('I'.$num.":J".$num);
                $objPHPExcel->getActiveSheet()->getStyle('C'.$num.":K".$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $num++;
            }
        }
        $objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
        $objPHPExcel->getActiveSheet()->mergeCells('E1:G1');
        $objPHPExcel->getActiveSheet()->mergeCells('A3:B3');
        $objPHPExcel->getActiveSheet()->mergeCells('C3:D3');
        $objPHPExcel->getActiveSheet()->mergeCells('E3:F3');
        $objPHPExcel->getActiveSheet()->mergeCells('G3:H3');
        $objPHPExcel->getActiveSheet()->mergeCells('I3:J3');
        $objPHPExcel->getActiveSheet()->getStyle('A3:I3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true)->setName('Arial Black')->setSize(13);
        $objPHPExcel->getActiveSheet()->getStyle("E1")->getFont()->setBold(true)->setName('Arial Black')->setSize(13);
        $objPHPExcel->getActiveSheet()->getStyle("E2")->getFont()->setBold(true)->setName('Arial Black')->setSize(13);
        $objPHPExcel->getActiveSheet()->getStyle('A3:I3')->getFont()->setBold(true);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        if (file_exists($exportfilename))
        unlink($exportfilename);
        $objWriter->save($exportfilename);
        unset($objPHPExcel);
        unset($objWriter);   
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Detailed Hourly Report.xlsx"');
        readfile($exportfilename);
        //echo "<script>window.location = 'import_items';</script>";
    }

    public function generateDate(){
       if(!empty($this->input->post('date'))){
            $date = $this->input->post('date');
       } else {
            $date = "null";
       }
       if(!empty($this->input->post('unit'))){
            $unit = $this->input->post('unit');
       }else{
        $unit = "null";
       }

       if(!empty($this->input->post('hour'))){
            $hour = $this->input->post('hour');
       }else{
        $hour = "null";
       }
    ?>
    <script>
        window.location.href ='<?php echo base_url(); ?>index.php/reports/dhourly_report/<?php echo $unit;?>/<?php echo $date;?>/<?php echo $hour;?>'
    </script> 
    <?php
    }
}
?>