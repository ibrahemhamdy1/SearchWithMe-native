<?php

session_start   ();     //Start The session

session_unset   ();    //Unset The Data

session_destroy ();   //Destory The  Date

header          ('Location: index.php');
exit();

?>