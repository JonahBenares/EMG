<?php
    if (isset($this->session->userdata['logged_in'])) {
        $username = ($this->session->userdata['logged_in']['username']);
        $password = ($this->session->userdata['logged_in']['password']);
    } else {
        echo "<script>alert('You are not logged in. Please login to continue.'); 
            window.location ='".base_url()."index.php/master/index'; </script>";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>ENERGY MARKET GROUP</title>
        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style3.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/mdb.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font/css/font-awesome.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/design.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.min.css">        
        <!-- Our Custom CSS -->
        <!-- Scrollbar Custom CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.mCustomScrollbar.min.css">        
    </head>