<?php
sleep(1);
session_start();

$func ="includes/functions/"; 
include $func.'functions.php';
include 'admin/connect.php';


//$pageTitle=lang('Login');
if(isset($_SESSION['user'])){
	header('Location: index.php');
}


if($_SERVER['REQUEST_METHOD']=='POST'){
	
		# code...
	
			
			$userfirstname      =$_POST['email'];
			$pass               =$_POST['password'];
			
			$hashedpass=sha1($pass);
			//check if  the user Exist In Datebase
			$stmt=$con->prepare("SELECT 
			                           	* 
								 FROM 
									  	users 
			 					 where 
			 						  	 Email = ? 
			 					  and 
			 						   	password=?
			  					  
			  
			  						 ");
			$stmt->execute(array($userfirstname ,$hashedpass));
			$Get=$stmt->fetch();
			$count=$stmt->rowCount();
			//if  count >0 this Mean the Datebase Contain Record aboit this Username
			if ($count>0) {
		        $_SESSION['user']= $Get['Email'] ; 
		        $_SESSION['userImage']=$Get['image'];
		                 //Register Session Name
				$_SESSION['uid']=$Get['UserID'];  //Register Session UserID		
				echo "success";
		       
				# code...
			
			}else{
				echo "failed";
			}
 
			
	 exit();	
	 
}
 
?>
