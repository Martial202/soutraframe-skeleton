<?php
require_once '../models/Validator.php';
require_once 'securite.php';

?>


<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Stack admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, stack admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>BURO STORE</title>
    <link rel="apple-touch-icon" href="<?= RACINE ?>assets/logo/logobleu.jpg">
    <link rel="shortcut icon" type="image/x-icon" href="<?= RACINE ?>assets/logo/logobleu.jpg">
    <link
        href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?= RACINE ?>app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?= RACINE ?>app-assets/vendors/css/forms/selects/select2.min.css">

    <link rel="stylesheet" type="text/css" href="<?= RACINE ?>app-assets/vendors/css/extensions/unslider.css">
    <link rel="stylesheet" type="text/css" href="<?= RACINE ?>app-assets/vendors/css/weather-icons/climacons.min.css">
    <link rel="stylesheet" type="text/css" href="<?= RACINE ?>app-assets/fonts/meteocons/style.css">
    <link rel="stylesheet" type="text/css" href="<?= RACINE ?>app-assets/vendors/css/charts/morris.css">
    <link rel="stylesheet" type="text/css" href="<?= RACINE ?>app-assets/vendors/css/tables/datatable/datatables.min.css">

    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?= RACINE ?>app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?= RACINE ?>app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="<?= RACINE ?>app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="<?= RACINE ?>app-assets/css/components.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?= RACINE ?>app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="<?= RACINE ?>app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="<?= RACINE ?>app-assets/fonts/simple-line-icons/style.css">
    <link rel="stylesheet" type="text/css" href="<?= RACINE ?>app-assets/css/pages/timeline.css">
    <!-- END: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?= RACINE ?>app-assets/css/pages/page-users.css">

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?= RACINE ?>assets/css/style.css">
    <!-- END: Custom CSS -->
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?= RACINE ?>app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?= RACINE ?>app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="<?= RACINE ?>app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="<?= RACINE ?>app-assets/css/components.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?= RACINE ?>app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="<?= RACINE ?>app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="<?= RACINE ?>app-assets/css/plugins/forms/wizard.css">
    <link rel="stylesheet" type="text/css" href="<?= RACINE ?>app-assets/css-rtl/plugins/file-uploaders/dropzone.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?= RACINE ?>app-assets/css/pages/app-contacts.css">
    <!-- END: Page CSS-->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

    <!-- <link rel="stylesheet" type="text/css" href="<?= RACINE ?>app-assets/css/plugins/pickers/daterange/daterange.css"> -->
    <!-- END: Page CSS-->
    <style>
        .logo {
            text-align: center;
            font-family: 'Orbitron', sans-serif;
            color: #003b95;
            margin: 10px;
        }

        .logo .buro {
            font-size: 15px;
            font-weight: bold;
            letter-spacing: 8px;
            margin-bottom: 0px;
        }

        .logo .store {
            font-size: 15px;
            font-weight: 300;
            letter-spacing: 10px;
            margin-top: -20px;
        }

        /* Ajoute dans ton fichier CSS principal */
        .dot-green {
            display: inline-block;
            /* margin-left: 5px; */
            vertical-align: middle;
        }

        .hidden {
            display: none !important;
        }
    </style>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu"
    data-col="2-columns">


    <!-- nav -->
    <?php

    //    if(SIGN === "USER"){ 
    require_once '../public/inc/sub_header/super_admin.php';
    //    }

    //    if(SIGN === "AGENT"){
    //     require_once '../public/inc/sub_header/agent.php';
    //    }
    ?>

    <!-- fin nav -->