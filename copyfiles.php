<?php

function rcopy($src,$dst){
	if(is_dir($src)){

	} else if(file_exist($src))
		copy($src,$dst);
}

//$copydownload = "C:\Users\CenPriTLP1-PC\Downloads\mpi_cenpri_01_Market Result-RTD Output Displays-Energy Schedules.xls";
$copydownload = "C:\Users\TradingDept\Downloads\mpi_cenpri_01_Market Result-RTD Output Displays-Energy Schedules.xls";
$destination="C:\/xampp\htdocs\EMG\uploads\/mpi.xls";
if(file_exists($copydownload)){
	copy($copydownload,$destination);
	unlink($copydownload);
} else {
	echo "No";
}

$copydownload = "C:\Users\TradingDept\Downloads\mpi_cenpri_03_Market Result-RTD Output Displays-Energy Schedules.xls";
$destination="C:\/xampp\htdocs\EMG\uploads\/mpi.xls";
if(file_exists($copydownload)){
	copy($copydownload,$destination);
	unlink($copydownload);
} else {
	echo "No";
}


?>