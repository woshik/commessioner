<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $page_section; ?></title>
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="" />
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/logo.png')?>"/>
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>

    <!-- //Meta Tags -->

    <!-- Bootstrap Css -->
    <link href="<?php echo base_url('assets/template/css/bootstrap.css')?>" rel="stylesheet" type="text/css" media="all" />
    <!--// Bootstrap Css -->

    <!-- Style-sheets -->
    <link href="<?php echo base_url('assets/font/siyam-rupali/stylesheet.css')?>" rel="stylesheet">
    <!--// Style-sheets -->

    <!-- Common Css -->
    <link href="<?php echo base_url('assets/template/css/style.css')?>" rel="stylesheet" type="text/css" media="all" />
    <!--// Common Css -->

    <!-- Nav Css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/template/css/style4.css');?>">
    <!--// Nav Css -->

    <!-- Fontawesome Css -->
    <link href="<?php echo base_url('assets/template/css/all.css');?>" rel="stylesheet">
    <!--// Fontawesome Css -->

    <!-- File Input -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/fileinput/css/fileinput.min.css') ?>" />
    <!--// File Input -->

    <?php if($page_section === "মামলা নিয়ন্ত্রণ" || $page_section === "এস.এম.এস" || $page_section === "ই-মেইল ও এস.এম.এস পাঠান" || $page_section === "ই-মেইল ও এস.এম.এস বক্স"){ ?>

        <link rel="stylesheet" href="<?php echo base_url('assets/DataTables/datatables.css') ?>">
      
        <?php if($page_section === "এস.এম.এস" || $page_section === "ই-মেইল ও এস.এম.এস পাঠান"){ ?>

            <link href="<?php echo base_url('assets/editor/summernote-bs4.css') ?>" rel="stylesheet">

        <?php } ?>

        <?php if($page_section === "ই-মেইল ও এস.এম.এস পাঠান"){ ?>
            <!-- Light Box -->
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/lightBox/css/lightbox.min.css') ?>" />
            <!--// Light Box -->
        <?php } ?>
        
    <?php } ?>

    <?php if($page_section === "ড্যাশবোর্ড"){ ?>
        <!-- Calender Css -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/css/pignose.calendar.full.css')?>" />
        <!--// Calender Css -->
    <?php } ?>

    <!--// Style-sheets -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('custom/css/custom.css');?>">

    <!-- Required common Js -->
    <script src="<?php echo base_url('assets/template/js/jquery-2.2.3.min.js');?>"></script>
    <!-- //Required common Js -->

</head>