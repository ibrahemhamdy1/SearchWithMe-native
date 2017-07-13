<?php

session_start();
include 'init.php';

$pageTitle=lang('Login');
if(isset($_SESSION['user'])){
	header('Location: index.php');
}

if($_SERVER['REQUEST_METHOD']=='POST'){
	if (isset($_POST['login'])) {
		# code...
	
			
			$userfirstname      =$_POST['username'];
			$pass               =$_POST['password'];
			
			$hashedpass=sha1($pass);
			//check if  the user Exist In Datebase
			$stmt=$con->prepare("SELECT 
			                           	UserID,Username,Password,image 
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
		        $_SESSION['user']= $Get['Username'] ; 
		        $_SESSION['userImage']=$Get['image'];
		                 //Register Session Name
				$_SESSION['uid']=$Get['UserID'];  //Register Session UserID		
		        header('Location: index.php'); //Redirect to  Dashbord page
		        exit(); 

				# code...
			
		}else{echo '<div class ="container center"  >';
					echo  '<div class="alert alert-danger text-center"> We  do  not  have  this UserName in  our  Website </div>';	
				echo '</div">'; 
			}
	}else{
		///if  it  comes  from  the  Signup Post
		$fromErrors=array();

		$userFirtstname  = $_POST['username'];
		$userlastname    = $_POST['lastname'];
		$userMobile      = $_POST['Mobile'];
		$userCity        = $_POST['City'];
		$useraddres      = $_POST['addres'];

		$password        = $_POST['password'];
		$password2 		 = $_POST['password2'];
		$email     		 = $_POST['email'];
		#$image 			 =$_POST['myFile'];
		//Start Image  Upload Staff
		

			# code...

		//End Image  Upload Staff

			if (isset($userFirtstname))
			 {
			 	$filterFirtstname =filter_var($userFirtstname,FILTER_SANITIZE_STRING);
				 	if(strlen($filterFirtstname)<2) {
				 		$fromErrors[]='username Must  be  Larger than 2 Characters ';

				 	}
			 }

			 if (isset($userlastname))
			 {
			 	$filterlastname =filter_var($userlastname,FILTER_SANITIZE_STRING);
				 	if(strlen($filterlastname)<2) {
				 		$fromErrors[]='username Must  be  Larger than 2 Characters ';

				 	}
			 }
				 
			if (isset($userMobile))
			{
			 	if (empty($userMobile)) {
					$fromErrors[]='your Mobile Password Cant Be Empty ';
			 	}
			}

			if (isset($userCity))
			 {
			 	$filterlastname =filter_var($userCity,FILTER_SANITIZE_STRING);
				 	if(strlen($filterlastname)<1) {
				 		$fromErrors[]='userCity Must  be  Larger than 1 Characters ';

				 	}

				 	if (empty($userCity)) {
					$fromErrors[]='your City Password Cant Be Empty ';
			 	}
			 }
			 		
			 if (isset($useraddres))
			 {
			 	$filterlastname =filter_var($useraddres,FILTER_SANITIZE_STRING);
				 	if(strlen($filterlastname)<5) {
				 		$fromErrors[]='useraddres Must  be  Larger than 5 Characters ';

				 	}
				 	if (empty($useraddres)) {
					$fromErrors[]='your addres Password Cant Be Empty ';
			 	}
			 }
			 		
			 	
			 if (isset($password)&&isset($password2))
			 {
			 	if (empty($password)) {
			 		$fromErrors[]='sorry Password Cant Be Empty ';

			 	}
			 	
				 	if (sha1($password) !== sha1($password2)) {
				 		$fromErrors[]="Sorry  password  not  match ";
				 	}
			 }

			 if (isset($email))
			 {
			 	$filterEmail =filter_var($email,FILTER_SANITIZE_STRING);
				 	if (filter_var($filterEmail,FILTER_VALIDATE_EMAIL)!= true) {
				 		$fromErrors[]='This  Email Is not Valid ';
				 	}

				 	
			 }
			 	
		$file_name = $_FILES["myFile"]["name"];

		// Upload the file to /upload folder and check if succeeded
		if(move_uploaded_file($_FILES["myFile"]["tmp_name"],  'upload/'.$file_name)){
	// Print image url, you can save that url into Database
		}else{
			$fromErrors[]='the  image  we  need  the  image ';
		}
				

				//Check if there is no Error Proced The Update Operation
				if (empty($fromErrors)) {
				//Update The  Userinfo In  Database 

					$check=ceckItem("Username","users",$userFirtstname);
					if ($check==1) {
				 		$fromErrors[]='This  User Is Exists ';

							
					}	else{
						// get the uploaded file name
					
	                  	$stmt=$con->prepare("INSERT INTO 
	                  							users(Username,user_last_name,User_mobile,User_city,User_address,Password,Email,RgSttatus,Dated,image) 
	                  						values(:zfirstuserName,:zuser_last_name,:zUser_mobile,:zUser_city,:zUser_address,:zpass,:zemail,0,now(),:zimage)");

	                  	$stmt->execute(array(
	                  	    'zfirstuserName'  =>$userFirtstname,
	                  	    'zuser_last_name' =>$userlastname,
	                  	    'zUser_mobile'    =>$userMobile,
	                  	    'zUser_city'      =>$userCity,
	                  	    'zUser_address'   =>$useraddres,
	                  	    'zpass'           =>sha1($password),
	                  	    'zemail'          =>$email,
	                  	    'zimage'		  =>$file_name
	                  	    ));

		                //ECHO Success Message
		                 $successMsg=lang('Congrats');
					}

						
                  		
							}

		}

}
?>
<div class="container login-page" style="margin-top:70px;">
	<h1 class="text-center">
		<span class="selected " data-class="login"><?php echo lang('Login')?></span>|
		<span data-class="signup"><?php echo lang('signup')?></span>
	</h1>
	<form class="login"   action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data" >
		<div class="input-container">
			<input 
				class="form-control"
				type="email" 
				name="username" 
				autocomplete="off"
				placeholder="<?php echo lang('palaceHolderforUsername')?>" required="required">
		</div>

		<div class="input-container">
			<input 
				class="form-control" 
				type="password" 
				name="password"
				autocomplete="new-password"
				placeholder="<?php echo lang('palaceHolderforpassword')?>" required="required">
		</div>	
		<input class="btn btn-primary btn-block" type="submit" value="<?php echo lang('Login')?>" name="login">
	</form>
<!-- ############signup#############################################################-->
	<form class="signup"   action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
		<div class="input-container">
			<input 
				pattern=".{4,8}" 
				title="Username Must  Be Between 4 Chars" 
				class="form-control"
				type="text" 
				name="username" 
				autocomplete="off"
				placeholder="<?php echo lang('firstname')?>"  required>
		</div>
		<div class="input-container">
			<input 
				pattern=".{4,8}" 
				title="Username Must  Be Between 4 Chars" 
				class="form-control"
				type="text" 
				name="lastname" 
				autocomplete="off"
				placeholder="<?php echo lang('lastname')?>"  required>
		</div>




		<div class="input-container">
			<input 
				pattern=".{4,12}" 
				title="Mobile Must  Be Between 4 Chars" 
				class="form-control"
				type="number" 
				name="Mobile" 
				autocomplete="off"
				placeholder="<?php echo lang('YourMobile')?>"  required>
		</div>

		<div class="input-container">
			<input 
				pattern=".{2,12}" 
				title="City Must  Be Between s Chars" 
				class="form-control"
				type="text" 
				name="City" 
				autocomplete="off"
				placeholder="<?php echo lang('YourCity')?> "  required>
		</div>

		<div class="input-container">
			<input 
				pattern=".{2,50}" 
				title="addres Must  Be Between s Chars" 
				class="form-control"
				type="text" 
				name="addres" 
				autocomplete="off"
				placeholder="<?php echo lang('Youraddres')?> "  required>
		</div>
		



		<div class="input-container">
			<input 
					minlength="4" 
					class="form-control" 
					type="password" 
					name="password"
					autocomplete="new-password"
					placeholder=" <?php echo lang('Complexpassword')?> "  required="required">
		</div>
		<div class="input-container">
			<input 
			minlength="4" 
			class="form-control" 
			type="password" 
			name="password2"
			autocomplete="new-password"
			placeholder=" <?php echo lang('againpassword')?> " required="required" >
		</div>
		<div class="input-container">	
			<input 
			class="form-control" 
			type="email" 
			name="email"
			placeholder=" <?php echo lang('validEmail')?>"  required="required">
		</div>	

		
<!--Start image-->
		
		<input type="file" name="myFile">
<!--End image -->

		<input class="btn btn-success btn-block"  name="signup" type="submit" value="<?php echo lang('submit')?>">
	</form>


<!-- End  Signup form -->
<div class="the-errors    text-center">
<?php 
if (!empty( $fromErrors)) {
		foreach ($fromErrors as $error ) {
			echo '<div class="msg error">'.$error.' </div> ';
		}
}
if (isset($successMsg)) {
	echo  '<div Class="msg success">'.$successMsg.'<div>';
}
?>
</div>
</div>
<?php 
include $tpl.'footer.php'

?>