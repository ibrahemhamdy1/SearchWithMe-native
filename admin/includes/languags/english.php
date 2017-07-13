<?php
function  lang($Phrase){
static $lang=array(
'HOME_ADMIN'   =>'Home',
'Categories'   =>'Categories',
'Post'        =>'Post',
'MEMBERS'      =>'members',
'COMMENTS'     =>'Comments',
'STATISTICS'   =>'statistics',
'LOGS'         =>'logs',


	);
return $lang[$Phrase]; 
}

?>