<?php

/////////////////////////////////////////Strat Time  Factor ///////////////////

function timeFactor(){
	
	


global $con;
	
	$Username=$con->prepare("SELECT 
	                           Username
						 FROM 
							   users 
	 					 ORDER by 
	 					 	   UserID
	 					  ");
	
	$Username->execute();
	
	$contUser=$Username->rowCount();


	if ($contUser > 0) {
		/// is  function now  delating  from  the  web  site   if  
		//items  has  number 5 and after 2  day
				global $con;

						$TrustStatus=$con->prepare("
							DELETE 
							FROM 
									items 
							WHERE 
									Approve =5
							and 
									Add_Date < NOW() - INTERVAL 2 DAY ");
						
						$TrustStatus->execute();
						
						$contUser=$TrustStatus->rowCount();	
					}
}

/////////////////////////////////////////End Time  Factor ///////////////////


/*
**Get All Function V2.0
**Function to  Get All Fom DataBase Table

*/

function getAllFrom($field,$table,$where=null,$and=null,$orederField,$oredering="DESC"){
	
	
	global $con;
	
	
	
	$getAll=$con->prepare("SELECT $field FROM  $table $where $and ORDER BY $orederField $oredering");
	
	$getAll->execute();
	
	$all=$getAll->fetchAll();
	
	return $all;
	
}










/*
**Check if user not Activated Function V1.0
**Function to  Check  the RegStutes OF The  User 
*/

function checkUserStatus($user){
	
	global $con;
	
	$stmtx=$con->prepare("SELECT 
	                             Username,	RgSttatus
						 FROM 
							   users 
	 					 where 
	 						   Username=? 
	 					  
	  					  and 
	  
	  						   	RgSttatus = 0");
	
	$stmtx->execute(array($user));
	
	$status=$stmtx->rowCount();
	
	return $status;
	
}



/*
**Title Function  v1.0
**That  echo  the page Title In Case The Page
**Has The Variable $pageTitle And Echo Defult Title For Other Pages
*/


function getTitel(){
	
	
	global $pageTitle;
	
	if (isset($pageTitle)) {
		
		echo $pageTitle;
		
		# code...
	}
	else{
		
		echo 'defalut';
		
	}
	
}


/* 
**Home Redirect Function  v2.0
**This  Function  Accept Parameters
**$theMsg=Echo The Error Message[Error|Success|Warning]
**$url=the link you to want To redirect to
**$secound =Seconds Befor Redirecting 
*/



function redirectHome($theMsg,$url=null,$second=3){
	
	if ($url===null) {
		
		
		$url="index.php";
		
		$link="homepage";
		
		
	}
	else{
		
		$url=isset($_SERVER['HTTP_REFERER'])&&$_SERVER['HTTP_REFERER']!==''
		?$_SERVER['HTTP_REFERER']:'index.php';
		
		$link='Pervious Page';
		
		
		
	}
	
	
	echo $theMsg;
	
	echo"<div class='alert alert-info'>you  will  be Redirected To $link  After $second second</div>";
	
	header("refresh:$second;url=$url");
	
}



/*
**Ckeck Items Function v1.0
**Function to ckeck  Item  IN Database[Function Accept Parameters]
**$select =The Item  To select [Example: User .itme, catehory]
**$form =The  Table To Select From [Example: Users ,Items, Catergores]
**$Value=the  value  of Select [Example:osama,Box ,Electronies]
*/

Function  ceckItem($select,$From,$value){
	
	
	
	global $con;
	
	$statement=$con->prepare("SELECT $select FROM $From WHERE $select=?");
	
	$statement->execute(array($value));
	
	$Count=$statement->rowCount();
	
	return $Count;
	
	
}




/*
*/


function test_input($data) {
	
	$data = trim($data);
	
	$data = stripslashes($data);
	
	$data = htmlspecialchars($data);
	
	return $data;
	
}


/*
**Count Number Of Items Function V1.0
**Function to  Count  Number  of  items Rows
**$item=The Item To Count
**$table =The Table To Choose From 
*/



function countItems($itms,$table){
	
	
	global $con;
	
	$stmt2=$con->prepare("SELECT COUNT($itms)FROM $table");
	
	$stmt2->execute();
	
	return $stmt2->fetchColumn();
	
	
}


/*
**Get Latest Record Function V1.0
**Function to  Get The  Latset Item From  DataBase[Users,Items,Comments]
**$Select=Filed  To Select
**$table =The Table To Choose From 
**$limit=Number Of Records To Get
*/

function getLatest($select,$table,$order,$limit=5){
	
	global $con;
	
	$getStmt=$con->prepare("SELECT $select FROM $table   ORDER BY $order DESC LIMIT $limit  ");
	
	$getStmt->execute();
	
	$Rows=$getStmt->fetchAll();
	
	return $Rows;
	
}



?>