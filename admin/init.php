<?php
include 'connect.php';
// Routes

$tpl  ="includes/templetes/";   //Template Directory
$css  ="layout/css/";          //css directory
$func ="includes/functions/";                     //Function Directory
$js   ="layout/js/";          //js directory
$lang ='includes/languags/'; //Language Directory

//include The important files
include $func.'functions.php';
include $lang.'english.php';
include $tpl .'header.php';
timeFactor();

//include Navebar on all pages  expect the  on one with $onNaveBar varible
if (!isset($noNavbar)) {include $tpl."navbar.php";}
