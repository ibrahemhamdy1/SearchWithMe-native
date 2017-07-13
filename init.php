<?php 
//Erro Reporting 

ini_set('display_errors', 'On');
error_reporting(E_ALL);
$sessionuser='';
if (isset($_SESSION['user'])) {
$sessionuser=$_SESSION['user'];

}


include 'admin/connect.php';
// Routes

$tpl  ="includes/templetes/";   //Template Directory
$css  ="layout/css/";          //css directory
$func ="includes/functions/";                     //Function Directory
$js   ="layout/js/";          //js directory
$lang ='includes/languags/'; //Language Directory

//include The important files
include $func.'functions.php';

if(isset($_GET['lang'])){
	$langs=$_GET['lang'];
	$_SESSION['lang']=$langs;
	setcookie("lang", $langs,time()+(3600*24*30));
}elseif (isset($_SESSION['lang'])) {
	$langs =$_SESSION['lang'];
}elseif (isset($_COOKIE['lang'])) {
	$langs =$_COOKIE['lang'];
}else{
	$langs ='en';
}

switch ($langs) {
	case 'ar':
		$lang_file='arabic.php';

		break;
	case 'en':
		$lang_file='english.php';

		break;
	default:
		$lang_file='english.php';
		break;
}
include $lang.$lang_file;
// if (isset($_GET['lang']) == 'ar'){
// include $lang.'arabic.php';

// }elseif (isset($_GET['lang']) == 'en'){

// include  $lang.'english.php';

// }else{
// 	include $lang.'english.php';

// }

include $tpl .'header.php';



timeFactor();
