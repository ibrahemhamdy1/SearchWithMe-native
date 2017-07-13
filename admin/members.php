<?php  
/*
================================================
==Menage members Page 
==you can Add|Edit|Delet Members From Here 
================================================
*/
ob_start();
session_start();
$pageTitle='members'; 
if (isset($_SESSION['Username'])) {
$do=isset($_GET['do'])?$_GET['do']:'Manage';
	include "init.php"; 
	
	//=====================================////Start  Manage 	Page============================================================== -->

	if ($do=='Manage') { 
	 //Manage Members Page 

		$query='';
		if (isset($_GET['page'])&& $_GET['page']=='panding') {
			$query='AND RgSttatus = 0 ';
		}
		//get  data from Database 

		$stmt=$con->prepare("SELECT *FROM users WHERE GroupID !=1 $query  ORDER BY UserID  DESC");
		$stmt->execute();
		$rows=$stmt->fetchAll();
if (!empty($rows)) {
	# code...

		?>
						
          
            <h1 class="text-center">Mangage Members</h1>
			<div class="container">

				<div class="table-responsive">

					<table class="maintable text-center table table-bordered">
						<tr>
							<td>#ID</td>
							<td>Username</td>
							<td>Mobile</td>
							<td>City</td>
							<td>addres</td>
							<td>Email</td>
						    <td>Registerd Date</td>
						    <td>Conterl</td>

						</tr>
									<?php  foreach ($rows as $row ) {
										echo "<tr>";

											echo "<td>".$row['UserID']. "</td>";
											echo "<td>".$row['Username']." ".$row['user_last_name']. "</td>";
											echo "<td>".$row['User_mobile']. "</td>";
											echo "<td>".$row['User_city']. "</td>";
											echo "<td>".$row['User_address']. "</td>";
											echo "<td>".$row['Email']. "</td>";

											echo "<td>". $row['Dated']."</td>";
											echo "<td>
							<a href='members.php?do=Edit&userid=" . $row['UserID'] .  "'class='btn btn-success'><i class='fa fa-edit'></i>Edit</a>
   							<a href='members.php?do=Delete&userid=" . $row['UserID'] ."'class='btn btn-danger confirm'><i class='fa fa-close'></i>Delete</a>";
								if ($row['RgSttatus']== 0) {
   							echo "<a 
   									href='members.php?do=activate&userid=" . $row['UserID'] ."'
   									class='btn btn-info '><i class='fa fa-check'>
   									</i>activate </a>";

								}
											echo "</td>";


											
										   echo "</tr>";
									}



				  ?>
						
										</table>
				</div>
			</div>


	<a href="members.php?do=Add" class="btnaddnewMebers btn btn-primary" ><i class="fa fa-plus"></i> add new Mebers</a>
	<?php }else{
	        echo '<div class="container">';
	        		echo '<div class="nic-message">there is  no  record To  show </div>';
	        		echo '	<a href="members.php?do=Add" 
	        				class=" btn btn-primary" >
	        				<i class="fa fa-plus"></i> add new Mebers</a>
';
	        echo '</div>';
}
?>

	    <?php }elseif ($do=='Add') {
	    				?>
        <!--  add Members Page-->

		 <h1 class="text-center">Add Members</h1>
			<div class="container">
			<form class="form-horizontal"  action="?do=Insert" method="POST">

			<!-- Start firstName  Field -->
			 <div class="form-group form-group-lg">
			  <label class="col-sm-2 control-label">firstName</label>
			    <div class="col-sm-10 col-md-4">
					<input  type= "text" name="firstName" class="form-control"   autocomplete="off" required="required" placeholder="User name to login into Shop"/>
					 </div>

						</div>
				    <!-- End firstName  Field -->

				    <!-- Start lastName  Field -->
			 <div class="form-group form-group-lg">
			  <label class="col-sm-2 control-label">lastName</label>
			    <div class="col-sm-10 col-md-4">
					<input  type= "text" name="lastName" class="form-control"   autocomplete="off" required="required" placeholder="User name to login into Shop"/>
					 </div>

						</div>
				    <!-- End lastName  Field -->
					  <!-- Start password  Field -->
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">password</label>
								<div class="col-sm-10 col-md-4">
								 <input  type= "password" name="password" class="password form-control" autocomplete="new-password" required="required" placeholder="Password  Must be hard and  complex" />

									<i class="show-pass fa fa-eye fa-2x"></i>
						</div>

						</div>
				<!-- End password  Field -->

				<!-- Start Email  Field -->
					<div class="form-group form-group-lg">
					<label class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10 col-md-4">
						<input  type= "Email" name="email"    class="form-control" required="required"  placeholder="Email must  be  Valid"/>
					</div>

					</div>
					<!-- End Email  Field -->

					

						<!-- Start submit  Field -->
						<div class="form-group ">
						<div class="col-sm-offset-2 col-sm-10 col-md-4">
						<input  type= "submit" value="Add Member" class="btn btn-primary btn-lg "/>
						</div>

						</div>
								<!-- End submit  Field -->

					    </form>
</div>



<!--=====================================//End  TO Add ============================================================== -->


	  <?php 

     
//=======================================//Start  TO Insert==============================================================
}elseif ($do=='Insert') {
		

                  	if ($_SERVER['REQUEST_METHOD']=='POST') {
                  	echo "<h1 class='text-center'>Insert Members</h1>";
                  	echo "<div class='container'>";
                  		
                  		$firstName =test_input($_POST['firstName']);
                  		$lastName  =test_input($_POST['lastName']);
                  		$pass      =test_input($_POST['password']);
                  		$email     =test_input($_POST['email']);
                  		$hashpass = sha1($_POST['password']);

                  		//Validate The  Form

                  		$FormErrors=array();

                  		if (strlen($firstName)<4) {
                  			$FormErrors[]='Username  cant be less Then <strong>4 Chrecters</strong></div>';
                  		}

                  		if (strlen($firstName)>20) {

                  			$FormErrors[]='Username  cant be Moer Then <strong>20 Chrecters</strong>  ';
                  		}
                  		if (empty($firstName)) {
                  		$FormErrors[]= 'User   cant Be <strong>empty</strong> ';
                  		}




                  		if (strlen($lastName)<4) {
                  			$FormErrors[]='Username  cant be less Then <strong>4 Chrecters</strong></div>';
                  		}

                  		if (strlen($lastName)>20) {

                  			$FormErrors[]='Username  cant be Moer Then <strong>20 Chrecters</strong>  ';
                  		}
                  		if (empty($lastName)) {
                  		$FormErrors[]= 'User   cant Be <strong>empty</strong> ';
                  		}





                  		if (empty($pass)) {
                  		$FormErrors[]= 'pass   cant Be <strong>empty</strong> ';
                  		}

                  		

                  		if (empty($email)) {
                  		$FormErrors[]= ' email  cant Be <strong>empty</strong>';
                  		}

                  		// Loop into  Errors Array And Echo It 
							foreach ( $FormErrors  as $Error ) {
								echo '<div class="alert alert-danger">'.$Error.'</div>';
							}

							//Check if there is no Error Proced The Update Operation
							if (empty($FormErrors)) {
							//Update The  Userinfo In  Database 

							$check=ceckItem("Username","users",$user);
							if ($check==1) {
									$theMsg= "<div class='alert alert-danger'>we have the same  uesername chooes anther one </div>";

									redirectHome($theMsg,'back');
								}else{

								
	                  	        $stmt=$con->prepare("INSERT INTO 
	                  	        	users(Username,user_last_name,Password,Email,RgSttatus,Dated) 
	                  	        	values(:zfirstName,:zuser_last_name,:zpass,:zemail,1,now()) ");

	                  	        $stmt->execute(array(
	                  	        	'zfirstName'     =>$firstName,
	                  	        	'zuser_last_name'=>$lastName,
	                  	        	'zpass'          =>$hashpass,
	                  	        	'zemail'         =>$email
	                  	        	));

	                  			//ECHO Success Message
	                  		     $theMsg= "<div class='alert alert-success'>".$stmt->rowCount().'Recored Inserted </div>';
	                  		     redirectHome($theMsg,'back');
									}


                  		
							}

                  	} 

                  	else{
                  		///if he enter the insert direct
                  		$errormag='<div class="alert alert-danger">you  cant  Brows this  page Directly</div>';
                  		redirectHome($errormag,'back',5);
                  	}

                  	echo "</div>";

                  







//
//=======================================//End  TO Insert==============================================================

//=======================================//Start  TO Edit==============================================================


	   }elseif ($do=='Edit') {
	   // Edit Page...

		//Ckeck IF Get Requst userid is Numeric&Get The Intger Value Of It

		$userid=isset($_GET['userid'])&& is_numeric($_GET['userid'] )? intval($_GET['userid']): 0;
						# code...
		
		//Select All Depend on this  ID
				$stmt=$con->prepare("SELECT * FROM users where  UserID=? LIMIT  1 ");
				$stmt->execute(array($userid));
		//Execute The Data

				$row=$stmt->fetch();
	   //The Row Count
				$count=$stmt->rowCount();
				//if There is  such ID Show The Form
				if($count>0){?>
					
				
		
						
						<h1 class="text-center">Edit Members</h1>
						<div class="container">
							<form class="form-horizontal"  action="?do=Update" method="POST">
								<Input type="hidden" name="userid" value="<?php echo $userid?>">
								<!-- Start First  Field -->
									<div class="form-group form-group-lg">
										<label class="col-sm-2 control-label">First name</label>
										<div class="col-sm-10 col-md-4">
											<input  type= "text" name="username" class="form-control"  value="<?php echo $row['Username']?>" autocomplete="off" required="required"/>
									</div>

								</div>
								<!-- End First name  Field -->

								<!-- Start last  Field -->
									<div class="form-group form-group-lg">
										<label class="col-sm-2 control-label">last name</label>
										<div class="col-sm-10 col-md-4">
											<input  type= "text" name="user_last_name" class="form-control"  value="<?php echo $row['user_last_name']?>" autocomplete="off" required="required"/>
									</div>

								</div>
								<!-- End last name  Field -->

								<!-- Start Mobile  Field -->
									<div class="form-group form-group-lg">
										<label class="col-sm-2 control-label">Mobile</label>
										<div class="col-sm-10 col-md-4">
											<input  type= "number" name="Mobile" class="form-control"  value="<?php echo $row['User_mobile']?>" autocomplete="off" required="required"/>
									</div>

								</div>
								<!-- End Mobile  Field -->

								<!-- Start City  Field -->
									<div class="form-group form-group-lg">
										<label class="col-sm-2 control-label">City</label>
										<div class="col-sm-10 col-md-4">
											<input  type= "text" name="City" class="form-control"  value="<?php echo $row['User_city']?>" autocomplete="off" required="required"/>
									</div>

								</div>
								<!-- End City  Field -->

								<!-- Start addres  Field -->
									<div class="form-group form-group-lg">
										<label class="col-sm-2 control-label">addres</label>
										<div class="col-sm-10 col-md-4">
											<input  type= "text" name="addres" class="form-control"  value="<?php echo $row['User_address']?>" autocomplete="off" required="required"/>
									</div>

								</div>
								<!-- End addres  Field -->


								<!-- Start password  Field -->
									<div class="form-group form-group-lg">
										<label class="col-sm-2 control-label">password</label>
										<div class="col-sm-10 col-md-4">

											<input  type= "hidden" name="oldpassword" value="<?php echo $row['Password']; ?>"/>
											<input  type= "password" name="newpassword" class="form-control" autocomplete="new-password" placeholder="Leave it Blank if you dont want to cahang "/>

									</div>

								</div>
								<!-- End password  Field -->

								<!-- Start Email  Field -->
									<div class="form-group form-group-lg">
										<label class="col-sm-2 control-label">Email</label>
										<div class="col-sm-10 col-md-4">
											<input  type= "Email" name="email"  value="<?php echo $row['Email'];?>"  class="form-control" required="required"/>
									</div>

								</div>
								<!-- End Email  Field -->

								

								<!-- Start submit  Field -->
									<div class="form-group ">
										<div class="col-sm-offset-2 col-sm-10 col-md-4">
											<input  type= "submit" value="Edit Members" class="btn btn-primary btn-lg "/>
									</div>

								</div>
								<!-- End submit  Field -->

							</form>
						</div>


               <?php	}
               //If There is No Such ID Show Error Message
               else{
               	echo "<div class='container'>";

               	$theMsg= '<div class="alert alert-danger">there is no such id</div>';
               	redirectHome($theMsg);
               	echo"</div>";
               }

//=============================================//Start Upadate page//=============================================
                  }elseif ($do=='Update') {
                  	echo "<h1 class='text-center'>Upadate Members</h1>";
                  	echo "<div class='container'>";	

                  	if ($_SERVER['REQUEST_METHOD']=='POST') {
                  		$id=$_POST['userid'];

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

								}else{

									//Update The Database With This Info?
                  	        $stmt=$con->prepare("UPDATE users SET Username = ?,user_last_name =?,User_mobile = ?,User_city = ?,User_address = ?,Email = ?, Password = ? WHERE UserID= ?");
                  			$stmt->execute(array($userFirstName,$userLastName,$userMobile,$userCity,$userAddres,$email,$pass,$id));

                  			//ECHO Success Message

                  			
                  			$theMsg="<div class='alert alert-success'>".$stmt->rowCount().'Recored Upadted </div>';
							redirectHome($theMsg,'back');
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

//=======================================//Start  the activate Page==============================================================


    }

    elseif($do == 'activate') {
		echo "<h1 class='text-center'>  activate  Members page</h1>";
        echo "<div class='container'>";	
        //Ckeck IF Get Requst userid is Numeric&Get The Intger Value Of It

		$userid=isset($_GET['userid'])&& is_numeric($_GET['userid'] )? intval($_GET['userid']): 0;
		
		//Select All Depend on this  ID
				$ckeck=ceckItem('userid','users',$userid);
		
				
	  
				//if There is  such ID Show The Form
	    if($ckeck>0){

				$stmt=$con->prepare("UPDATE users SET RgSttatus =1 WHERE UserID = ?");
				$stmt->execute(array($userid));
                $theMsg= "<div class='alert alert-success'>".$stmt->rowCount().'Recored activated </div>';
                redirectHome($theMsg);
                  	
                  }else{
                $theMsg= "<div class='alert alert-danger'>"."This  ID is  not Exist ".' </div>';
					redirectHome($theMsg);
                  	
                  }
                  echo "</div>";              }



//=============================================//End activate page//=============================================

//=======================================//Start  the Delete Page==============================================================


    elseif ($do='Delate') {

        echo "<h1 class='text-center'>  Delate  Members page</h1>";
        echo "<div class='container'>";	
        //Ckeck IF Get Requst userid is Numeric&Get The Intger Value Of It

		$userid=isset($_GET['userid'])&& is_numeric($_GET['userid'] )? intval($_GET['userid']): 0;
		
		//Select All Depend on this  ID
				$ckeck=ceckItem('userid','users',$userid);
		
				
	  
				//if There is  such ID Show The Form
	    if($ckeck>0){

				$stmt=$con->prepare("DELETE FROM users WHERE UserID = :zuers");
				$stmt->bindParam(":zuers",$userid);
				$stmt->execute();
                $theMsg= "<div class='alert alert-success'>".$stmt->rowCount().'Recored Delete </div>';
                redirectHome($theMsg);
                  	
                  }else{
                $theMsg= "<div class='alert alert-danger'>"."This  ID is  not Exist ".' </div>';
					redirectHome($theMsg,'back');
                  	
                  }
                  echo "</div>";

              }
//=======================================//End  the Delete Page==============================================================
//=======================================//Start the Activate Page==============================================================



//=======================================//End the Activate Page==============================================================

       include $tpl.'footer.php';
	     # code...


}else{
header('Location: index.php'); 

}
ob_end_flush();
?>