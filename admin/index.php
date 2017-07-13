<?php 
session_start();
$noNavbar='';
$pageTitle='Login';
if(isset($_SESSION['Username'])){

	header('Location: dashbord.php');
}
include "init.php"; 

if($_SERVER['REQUEST_METHOD']=='POST'){


	$username=$_POST['user'];
	$password=$_POST['pass'];
	$hashedpass=sha1($password);
	//check if  the user Exist In Datebase
	$stmt=$con->prepare("SELECT 
	                             UserID,Username,Password 
						 FROM 
							   users 
	 					 where 
	 						   Username=? 
	 					  and 
	 						   password=?
	  					  and 
	  
	  						   GroupID=1
	                      LIMIT  1 ");
	$stmt->execute(array($username,$hashedpass));
	$row=$stmt->fetch();
	$count=$stmt->rowCount();
	//if  count >0 this Mean the Datebase Contain Record aboit this Username
	if ($count>0) {
		print_r($row);
        $_SESSION['Username']= $username;  //Register Session Name
        $_SESSION['ID']=$row['UserID'];    //Register Session ID

         header('Location: dashbord.php'); //Redirect to  Dashbord page
         exit(); 

		# code...
	}else{
		echo "we dont  have this  emial";
	}
}

?>


<form class="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">

	<h4 class="text-center">Admin login</h4>

<input class="form-control input-lg" type="text" name= "user" placeholder="Username" autocomplete="off"/>
<input class="form-control input-lg" type="password" name ="pass" placeholder="Password" autocomplete="new-password"/>
<input class="btn btn-lg btn-primary btn-block " type="submit" value="Login">

<?php include $tpl.'footer.php';?>