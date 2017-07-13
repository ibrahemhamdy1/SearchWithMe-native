<?php ob_start();



session_start();



$pageTitle='Profile';



include 'init.php';



///here  if  he  coming  from the item  page  and want  to  see  the  profile of  the  ouner
if(isset($_GET['Member_ID'])){
	
	$userID=$_GET['Member_ID'];
	
	
	$getUser=$con->prepare("SELECT * FROM users WHERE UserID =?");
	
	
	$getUser->execute(array($userID));
	
	
	$info=$getUser->fetchAll();
	
	
	foreach ($info as $infos ) {
		
		# code...
		?>

<h1 class="text-center"><?php echo lang('theowner');?></h1>
<div class="information blocks">		

	<div class="container ">
		<div class="panel panel-primary text-center">

			<div class="panel-heading"></div>
			<!--image -->
			<div class="col-md-4 image">
									<div  class="thumbnail">
									<?php    $imagedata = $infos['image'];

									$base64 = 'data:image/jpeg;base64, '.$imagedata;

									?>
										<img  class="img-responsive  center-block img"  src="<?PHP  
              ECHO $base64 ?>" alt="" max-hight="30px"/>
										
									</div>
								 </div>
			
				<div class="panel-body text-center">
					<ul class="list-unstyled text-center">	
						<li>
							<i class="fa fa-unlock-alt fa-fw"></i>
							 <?php echo lang('name'). ' : '.$infos['Username']." ".$infos['user_last_name'];

?>
						</li>

						<li>
							<i class="fa  fa-mobile fa-fw"></i>
							 <?php echo lang('Mobile'). ' : '.  $infos['User_mobile'];

?>
						</li>

						<li>
							<i class="fa fa-home fa-fw"></i>
							<?php echo lang('city'). ' : '.  $infos['User_city'];

?>
						</li>

						

						
						
						</li>

						
						
					</ul>
</div>
</div>
</div>
</div>
<!--###################################My Ads################################-->
<div id="myad" class="myads">		

	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading"><?php echo lang('ownerAds');?></div>
				<div class="panel-body">
	<?php 
	echo $infos['UserID'];
$MyItems=getAllFrom("*","items","WHERE Member_ID={$infos['UserID']}","","Item_ID","DESC");



if(!empty($MyItems)){
	
	
	echo '<div class="row">';
	
	
	foreach ( $MyItems as $item) {
		
		
		
		echo '<div class="col-sm-6 col-md-3">';
		
		
		echo '<div  class="thumbnail item-box">';
		
		
		if ( $item['Cat_ID']=1 && $item['Cat_ID']!=3 ) {
			echo '<span class="approve-status img-responsive img-thumbnail center-block">'.lang("NOtfound").'</span> ';
			if (empty($item['Approve'])  ) {
			echo '<span class="pull-right">'.lang("NOtApprovedyet").' </span> ';
		}
		}elseif ($item['Cat_ID']!=1) {
			echo '<span class="found-status img-responsive img-thumbnail center-block">'.lang("isFoundnow").'</span> ' ;
			if (empty($item['Approve'])  ) {
			echo '<span class="pull-right">'.lang("NOtApprovedyet").' </span> </br>';
		}
		}
		else{
			echo '<span class="found-status img-responsive img-thumbnail center-block">'.lang("isFoundnow").'</span> ' ;
			if (empty($item['Approve'])  ) {
			echo '<span class="pull-right">'.lang("NOtApprovedyet").' </span> </br>';
		}
		}
	
		
		echo'<span class="price-Tag">'.$item['age']." "."y".'</span>';
		// Start the image  part  of  the  post  the  owner shaer
		if (!empty($item['Image'])) {
			# code...
			
		$imagedata = $item['Image'];

		$base64 = 'data:image/jpeg;base64, '.$imagedata;
		?>
		<img  class="img-responsive  center-block img" src="<?PHP  
              ECHO $base64 ?>" alt="" height="244" width="219"/>

		<?php
		}else{
			echo '<img class="img-responsive img" src="image.png" >';
		}
				// end the image  part  of  the  post  the  owner shaer

		echo '<div class="caption">';
		
		
		echo'<h3> <a href="items.php?itemid='.$item['Item_ID'].'">'.$item['Name'].'</a></h3>';
		
		
		echo '<p>'.$item['Description'].'</p>';
		
		
		echo '<div class="date">'.$item['Add_Date'].'</div>';
		
		
		
		


echo '</div>';


echo '</div>';



echo '</div>';




}


echo '</div>';



}

else{


echo 'there is nothing  to  show  here <a href="newad.php">New Ad</a>';



}


###################################My Ads#######################################

?>
<?php
}

}

else{



if (isset($sessionuser)) {



$do=isset($_GET['do'])?$_GET['do']:'Manage';


$getUser=$con->prepare("SELECT * FROM users WHERE Email=?");


$getUser->execute(array($sessionuser));


$info=$getUser->fetch();


$user_id=$info['UserID'];




if ($do=='Manage') {
	
	
	//M	anage Members Page 
	
	
	
	?>


<h1 class="text-center"><?php echo lang('MyProfile');?> </h1>
<div class="information blocks">		



	<div class="container ">
		<div class="panel panel-primary">
			<div class="panel-heading"><?php echo lang('MyInformation');?></div>
				<div class="panel-body">


				<?php  

		$imagedata = $info['image'];

		$base64 = 'data:image/jpeg;base64, '.$imagedata;


				?>
<div class="text-center"><img  class="img-responsive img-thumbnail   img-circle text-center " src="<?PHP  
              ECHO $base64 ?>" alt=""  height="100" width="100"/>
</div>
					<ul class="list-unstyled">	
						<li>
							<i class="fa fa-unlock-alt fa-fw"></i>
							<?php echo lang('name').':'.$info['Username']." ".$info['user_last_name'];

?>
						</li>

						<li>
							<i class="fa  fa-mobile fa-fw"></i>
							 <?php echo lang('Mobile').':'.$info['User_mobile'];

?>
						</li>

						<li>
							<i class="fa fa-home fa-fw"></i>
							<?php echo  lang('city').':'.$info['User_city'];

?>
						</li>

						<li>
							<i class="fa fa-location-arrow   fa-spinner fa-spin fa-fw"></i>
							 <?php echo lang('addres').':'. $info['User_address'];

?>
						</li>


						<li>
							<i class="fa fa-envelope-o fa-fw"></i>
							<?php echo lang('Email').':'. $info['Email'];

?>
						</li>

						
						</li>

						<li>
							<i class="fa fa-calendar fa-fw"></i>
							<?php echo  lang('RegisterDate').':'.$info['Dated'];

?>
						</li>

						
					</ul>

<?php				echo "<a href='Profile.php?do=Edit' class='btn btn-success'><i class='fa fa-edit'></i>".lang('Edit')."</a>";

?>	
				
			</div>
		</div>

	</div>

	<div id="myad" class="myads">		

	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading"><?php echo lang('MyAds')?></div>
				<div class="panel-body">
	<?php
$MyItems=getAllFrom("*","items","WHERE Member_ID={$info['UserID']}","","Item_ID","DESC");



if(!empty($MyItems)){
	
	
	echo '<div class="row">';
	
	
	foreach ( $MyItems as $item) {
		
		
		
		echo '<div class="col-sm-6 col-md-3">';
		
		
		echo '<div  class="thumbnail item-box">';
		
		
		if ( $item['Cat_ID']=1 && $item['Cat_ID']!=3 ) {
			echo '<span class="approve-status img-responsive img-thumbnail center-block">'.lang("NOtfound").'</span> ';
			if (empty($item['Approve'])  ) {
			echo '<span class="pull-right">'.lang("NOtApprovedyet").' </span> ';
		}
		}elseif ($item['Cat_ID']!=1) {
			echo '<span class="found-status img-responsive img-thumbnail center-block">'.lang("isFoundnow").'</span> ' ;
			if (empty($item['Approve'])  ) {
			echo '<span class="pull-right">'.lang("NOtApprovedyet").' </span> </br>';
		}
		}
		else{
			echo '<span class="found-status img-responsive img-thumbnail center-block">'.lang("isFoundnow").'</span> ' ;
			if (empty($item['Approve'])  ) {
			echo '<span class="pull-right">'.lang("NOtApprovedyet").' </span> </br>';
		}
		}
		
		echo'<span class="price-Tag">'.$item['age']." "."y".'</span>';
		
		// Start the image  part   in the profile
		if (!empty($item['Image'])) {
			# code...
		$imagedata = $item['Image'];

		$base64 = 'data:image/jpeg;base64, '.$imagedata;
		?>
		<img  class="img-responsive img " src="<?PHP  
              ECHO $base64 ?>" alt="" height="244.5" width="219.17"/>

		<?php
		}else{
			echo '<img class="img-responsive img" src="image.png" alt>';
		}
				// end the image  part  the profile

		
		
		
		echo '<div class="caption">';
		
		
		echo'<h3> <a href="items.php?itemid='.$item['Item_ID'].'">'.$item['Name'].'</a></h3>';
		
		
		echo '<p>'.$item['Description'].'</p>';
		
		
		echo '<div class="date">'.$item['Add_Date'].'</div>';
		
		
		
		


echo '</div>';


echo '</div>';



echo '</div>';




}


echo '</div>';



}

else{


echo 'there is nothing  to  show  here <a href="newad.php">New Ad</a>';



}



?>
				
				
			</div>
		</div>

	</div>
</div>

</div> 

<?php 

//======================== Start Edit member  profile=============s
}

elseif ($do=='Edit'){



//Select All Depend on this  ID
$stmt=$con->prepare("SELECT * FROM users where  UserID=? LIMIT  1 ");


$stmt->execute(array($user_id));


//Execute The Data

$row=$stmt->fetch();


//The Row Count
$count=$stmt->rowCount();


//if There is  such ID Show The Form
if($count>0){
	
	?>
					
				
		
						
						<h1 class="text-center"><?php echo lang('EditMembers')?></h1>
						<div class="container">
							<form class="form-horizontal"  action="?do=Update" method="POST">
								<Input type="hidden" name="userid" value="<?php echo $userid?>">
								<!-- Start First  Field -->
									<div class="form-group form-group-lg">
										<label class="col-sm-2 control-label"><?php echo lang('Firstname')?></label>
										<div class="col-sm-10 col-md-4">
											<input  type= "text" name="username" class="form-control"  value="<?php echo $row['Username']?>" autocomplete="off" required="required"/>
									</div>

								</div>
								<!-- End First name  Field -->

								<!-- Start last  Field -->
									<div class="form-group form-group-lg">
										<label class="col-sm-2 control-label"><?php echo lang('lastname')?></label>
										<div class="col-sm-10 col-md-4">
											<input  type= "text" name="user_last_name" class="form-control"  value="<?php echo $row['user_last_name']?>" autocomplete="off" required="required"/>
									</div>

								</div>
								<!-- End last name  Field -->

								<!-- Start Mobile  Field -->
									<div class="form-group form-group-lg">
										<label class="col-sm-2 control-label"><?php echo lang('Mobile')?></label>
										<div class="col-sm-10 col-md-4">
											<input  type= "number" name="Mobile" class="form-control"  value="<?php echo $row['User_mobile']?>" autocomplete="off" required="required"/>
									</div>

								</div>
								<!-- End Mobile  Field -->

								<!-- Start City  Field -->
									<div class="form-group form-group-lg">
										<label class="col-sm-2 control-label"><?php echo lang('city')?></label>
										<div class="col-sm-10 col-md-4">
											<input  type= "text" name="City" class="form-control"  value="<?php echo $row['User_city']?>" autocomplete="off" required="required"/>
									</div>

								</div>
								<!-- End City  Field -->

								<!-- Start addres  Field -->
									<div class="form-group form-group-lg">
										<label class="col-sm-2 control-label"><?php echo lang('addres')?></label>
										<div class="col-sm-10 col-md-4">
											<input  type= "text" name="addres" class="form-control"  value="<?php echo $row['User_address']?>" autocomplete="off" required="required"/>
									</div>

								</div>
								<!-- End addres  Field -->


								<!-- Start password  Field -->
									<div class="form-group form-group-lg">
										<label class="col-sm-2 control-label"><?php echo lang('password')?></label>
										<div class="col-sm-10 col-md-4">

											<input  type= "hidden" name="oldpassword" value="<?php echo $row['Password'];

?>"/>  <input  type= "password" name="newpassword"/>
											<input  type= "password" name="newpassword" class="form-control" autocomplete="new-password" placeholder="Leave it Blank if you dont want to cahang "/>

									</div>

								</div>
								<!-- End password  Field -->

								<!-- Start Email  Field -->
									<div class="form-group form-group-lg">
										<label class="col-sm-2 control-label"><?php echo lang('Email')?></label>
										<div class="col-sm-10 col-md-4">
											<input  type= "Email" name="email"  value="<?php echo $row['Email'];

?>"  class="form-control" required="required"/>
									</div>

								</div>
								<!-- End Email  Field -->

								

								<!-- Start submit  Field -->
									<div class="form-group ">
										<div class="col-sm-offset-2 col-sm-10 col-md-4">
											<input  type= "submit" value="<?php echo lang('save')?>" class="btn btn-primary btn-lg "/>
									</div>

								</div>
								<!-- End submit  Field -->

							</form>
						</div>


               <?php
}


//If There is No Such ID Show Error Message
else{


echo "<div class='container'>";



$theMsg= '<div class="alert alert-danger">there is no such id</div>';


redirectHome($theMsg);


echo"</div>";


}


}

elseif($do=='Update'){



echo "<h1 class='text-center'>Upadate Members</h1>";


echo "<div class='container'>";



if ($_SERVER['REQUEST_METHOD']=='POST') {


$id=$user_id;



$userFirstName  =test_input($_POST['username']);


$userLastName   =test_input($_POST['user_last_name']);


$userMobile     =$_POST['Mobile'];


$userCity       =test_input($_POST['City']);


$userAddres     =test_input($_POST['addres']);





$pass  =$_POST['oldpassword'];



$email =test_input($_POST['email']);




//Password Trick
//Condition ?True:False;



$pass=empty($_POST['newpassword'])?$_POST['oldpassword']:sha1($_POST['newpassword']);



//Validate The  Form


$FormErrors=array();


//userFirstName
if (strlen($userFirstName)<4) {
	
	
	$FormErrors[]='Username  cant be less Then <strong>4 Chrecters</strong></div>';
	
	
}



if (strlen($userFirstName)>20) {
	
	
	
	$FormErrors[]='Username  cant be Moer Then <strong>20 Chrecters</strong>  ';
	
	
}


//Last Name
if (empty($userFirstName)) {
	
	
	$FormErrors[]= 'User   cant Be <strong>empty</strong> ';
	
	
}



if (strlen($userLastName)<4) {
	
	
	$FormErrors[]='Last Name  cant be less Then <strong>4 Chrecters</strong></div>';
	
	
}



if (strlen($userLastName)>20) {
	
	
	
	$FormErrors[]='Last Name  cant be Moer Then <strong>20 Chrecters</strong>  ';
	
	
}


if (empty($userLastName)) {
	
	
	$FormErrors[]= 'Last Name   cant Be <strong>empty</strong> ';
	
	
}



//userMobile
if (strlen($userMobile)>19) {
	
	
	$FormErrors[]='Mobile  cant be Moer Then <strong>19 Chrecters</strong>  ';
	
	
}


if (empty($userMobile)) {
	
	
	$FormErrors[]= ' Mobile  cant Be <strong>empty</strong>';
	
	
}



//userCity
if (strlen($userCity)>19) {
	
	
	$FormErrors[]='user City  cant be Moer Then <strong>19 Chrecters</strong>  ';
	
	
}


if (empty($userCity)) {
	
	
	$FormErrors[]= ' City  cant Be <strong>empty</strong>';
	
	
}



//userAddres
if (empty($userAddres)) {
	
	
	$FormErrors[]= ' user Addres  cant Be <strong>empty</strong>';
	
	
}



//email
if (empty($email)) {
	
	
	$FormErrors[]= ' email  cant Be <strong>empty</strong>';
	
	
}



// Loop into  Errors Array And Echo It 
foreach ( $FormErrors  as $Error ) {
	
	
	echo '<div class="alert alert-danger">'.$Error.'</div>';
	
	
}



//Check if there is no Error Proced The Update Operation
if (empty($FormErrors)) {
	
	
	$stmt2=$con->prepare("SELECT 
															*
													  From
													  	  users
													  Where 
													  	  Username=?
													  And
													  	   UserID!=?	    
																");
	
	
	$stmt2->execute(array($user,$id));
	
	
	$count=$stmt2->rowCount();
	
	
	if ($count==1) {
		
		
		Echo '<div class="alert alert-danger">Sorry This UserIsExist</div>';
		
		
		redirectHome('back');
		
		
		
	}
	
	else{
		
		
		
		//U		pdate The Database With This Info?
		$stmt=$con->prepare("UPDATE users SET Username = ?,user_last_name =?,User_mobile = ?,User_city = ?,User_address = ?,Email = ?, Password = ? WHERE UserID= ?");
		
		
		$stmt->execute(array($userFirstName,$userLastName,$userMobile,$userCity,$userAddres,$email,$pass,$id));
		
		
		
		//E		CHO Success Message
		
		
		$theMsg="<div class='alert alert-success'>".$stmt->rowCount().'Recored Upadted </div>';
		
		echo $theMsg;
		
		echo"<div class='alert alert-info'>now you we will end  your  session  will  be Redirected To  LogIn After  1 second LogIn with your  new change</div>";
		
		header("refresh:2;url=LogOut.php");
		
	}
	
	
	
	
	
	
	/*	
							
*/
	
	
}







}



else{



$theMsg= '<div class="alert alert-danger">you  cant  Brows this  page Directly</div>';


redirectHome($theMsg);




}



echo "</div>";


//=============================================//End Upadate page//=============================================

}








}

else{


header('Location: login.php');


exit();


}

}

include $tpl.'footer.php';


ob_end_flush();



?>