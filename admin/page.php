<?php
/*
categories => [Manage | Edit | Update|  Add | Insert | Delete | Stats]
*/
$do=isset($_GET['do'])? $_GET['do']:'Manage';

if($do=='Manage'){
	echo 'welcome you are  in Manage Category Page';
	echo '<a href="?do=Insert">add new Category+</a>';

}elseif ($do=='Add') {
	echo "welcome you are  in Add  Category page";

}elseif ($do=='Insert') {
	echo "welcome you are  in Insert  Category page";

}else{
	echo "error There\s No page With this Name";
}


?>