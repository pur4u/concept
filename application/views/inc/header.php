<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo isset($title) ? $title : 'Default Title' ; ?></title>
        <meta name="description" content="<?php echo isset($description) ? $description : 'Default Description' ; ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="<?php echo base_url('/public/img/apple-touch-icon.png'); ?>">
        <!-- Place favicon.ico in the root directory -->
		
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300italic,300&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo base_url('/public/css/reset.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('/public/css/normalize.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('/public/css/main.css'); ?>">
        <script src="<?php echo base_url('/public/js/vendor/modernizr-2.8.3.min.js'); ?>"></script>
		
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->


        <div id="container">
			<header>
				<img alt="Logo Office" src="<?php echo base_url('/public/img/logo.png'); ?>" width="50" height="17" />
			</header>
