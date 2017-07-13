<?php 


ob_start();
session_start();
$pageTitle='Iteme'; 


if (isset($_SESSION['Username'])) {


	$do=isset($_GET['do'])?$_GET['do']:'Manage';
		include "init.php"; 
		$do=isset($_GET['do'])?$_GET['do']:'Manage';	

		
//Manage Iteme Page 
	if ($do=='Manage') { 
		 //Manage Iteme Page 

		
		//get  Iteme from Database 

		$stmt=$con->prepare("SELECT 
									  items.*,
									  categories.Name 
								AS  
									  category_name ,
									  users.Username,users.user_last_name

								from 
									  items
								INNER JOIN
									  categories 
								ON   
									  categories.ID=	items.Cat_ID
								INNER JOIN 
									  users 
								ON    
										users.UserID=items.Member_ID	 
								ORDER BY 
							 			Item_ID  DESC
							 		");
		$stmt->execute();
		$items=$stmt->fetchAll();
		if (!empty($items)) {
		

		?>
						
          
            <h1 class="text-center">Mangage Post</h1>
			<div class="container">

				<div class="table-responsive">

					<table class="maintable text-center table table-bordered">
						<tr>
							<td>#ID</td>
							<td>name</td>
							<td>Description</td>
						    <td>age</td>
						    <td>Adding Date</td>
						    <td> Country</td>
						    <td>Lost Relationship</td>
						    <td>gander</td>
						    <td>Catergory</td>
						    <td>Username</td>
						    <td>status</td>
						    <td>Conterl</td>
						    
						</tr>
									<?php  

										foreach ($items as $item ) {
										echo "<tr>";

											echo "<td>".$item['Item_ID']. "</td>";
											echo "<td>".$item['Name']. "</td>";
											echo "<td>".$item['Description']. "</td>";
											echo "<td>".$item['age']." Y". "</td>";
											echo "<td>".$item['Add_Date']."</td>";
											echo "<td>".$item['Country_Made']."</td>";
											echo "<td>".$item['Lost_Relationship']."</td>";
											echo "<td>".$item['gander']."</td>";
											echo "<td>".$item['category_name']."</td>";
											echo "<td>".$item['Username']." ".$item['user_last_name']."</td>";
											echo "<td>".$item['Approve']."</td>";	
											echo "<td>
							<a href='iteme.php?do=Edit&itemid=" . $item['Item_ID'] .  "'class='btn btn-success'><i class='fa fa-edit'></i>Edit</a>
   							<a href='iteme.php?do=Delete&itemid=" . $item['Item_ID'] ."'class='btn btn-danger confirm'><i class='fa fa-close'></i>Delete</a>";
							if ($item['Approve']== 0) {
   							echo "<a 
		   							href='iteme.php?do=Approve&itemid=" . $item['Item_ID'] ."'
		   							class='btn btn-info '>
		   							<i class='fa fa-check'></i>Approve </a>";

								}		
											echo "</td>";


											
										   echo "</tr>";
									}



				  ?>
						
						
					</table>
				</div>
			</div>


	<a href="iteme.php?do=Add" class="btnaddnewMebers btn  btn-sm btn-primary" >
	<i class="fa fa-plus"></i> add new Item</a>


	    

<?php }else{
	        echo '<div class="container">';
	        		echo '<div class="nic-message">there is  no  Iteme  To  show </div>';
	        			echo '<a href="iteme.php?do=Add" class=" btn  btn-sm btn-primary canter" >
	        			<i class="fa fa-plus"></i> add new Item</a>';

	        echo '</div>';
}?>

	<?php  }elseif ($do=='Add') {?>

 <!--  add Iteme Page-->

		 <h1 class="text-center">Add  new  Iteme </h1>
			<div class="container">

			<form class="form-horizontal"  action="?do=Insert" method="POST">
			<!-- Start Username  Field -->
			 <div class="form-group form-group-lg">
			  <label class="col-sm-2 control-label">Name</label>
			    <div class="col-sm-10 col-md-4">
					<input  
						required="required"
						type= "text" 
						name="name" 
						class="form-control" 
					   	
					   	placeholder="Name of  the  iteme "/>
					 </div>

						</div>
				    <!-- End Username  Field -->

				    <!-- Start description  Field -->
					 <div class="form-group form-group-lg">
					  <label class="col-sm-2 control-label">description</label>
					    <div class="col-sm-10 col-md-4">
							<input  
								required="required"
								type= "text" 
								name="description" 
								class="form-control" 
							   	
							   	placeholder="Description of  the  iteme "/>
							 </div>

								</div>
					<!-- End description  Field -->

					<!-- Start price  Field -->
					 <div class="form-group form-group-lg">
					  <label class="col-sm-2 control-label">price</label>
					    <div class="col-sm-10 col-md-4">
							<input  
								required="required"
								type= "text" 
								name="price" 
								class="form-control" 
							   	
							   	placeholder="price of  the  iteme "/>
							 </div>

								</div>
					<!-- End price  Field -->
					<!-- Start country  Field -->
					 <div class="form-group form-group-lg">
					  <label class="col-sm-2 control-label">country</label>
					    <div class="col-sm-10 col-md-4">
							<input  
								required="required"
								type= "text" 
								name="country" 
								class="form-control" 
							   	placeholder="country of  the  iteme "/>
							 </div>

								</div>

					<!-- End country  Field -->		
					<!-- Start status   Field -->
					 <div class="form-group form-group-lg">
					  <label class="col-sm-2 control-label">status</label>
					    <div class="col-sm-10 col-md-4">
							<select  name="status">
								<option value="0">....</option>
								<option value="1">new</option>
								<option value="2">like new</option>
								<option value="3">used</option>
								<option value="4">very old</option>
							</select>
					</div>
						</div>
					<!-- End status  Field -->
					<!-- Start Members   Field -->
					 <div class="form-group form-group-lg">
					  <label class="col-sm-2 control-label">Members</label>
					    <div class="col-sm-10 col-md-4">
							<select  name="Members">
								<option value="0">....</option>

								<?php 
								$allmenbers=getAllFrom("*","users","","","UserID");
								foreach ($allmenbers as $user) {
								 echo "<option value='".$user['UserID']."'>".$user['Username']."</option>";
								}

								?>
								
							</select>
					</div>
						</div>
					<!-- End Members  Field -->
					<!-- Start Categories   Field -->
					 <div class="form-group form-group-lg">
					  <label class="col-sm-2 control-label">Categories</label>
					    <div class="col-sm-10 col-md-4">
							<select  name="Categories">
								<option value="0">....</option>
								<?php 
								$allmenbers=getAllFrom("*","categories","where parent =0","","ID");
								foreach ($allmenbers as $cat) {
								 echo "<option value='".$cat['ID']."'>".$cat['Name']."</option>";
								$childCats=getAllFrom("*","categories","where parent ={$cat['ID']}","","ID");
								foreach ($childCats as $child){
										echo "<option value='".$child['ID']."'>-----".$child['Name']."</option>";

								}
								}

								?>
								
							</select>
					</div>
						</div>
					<!-- End Categories  Field -->
					<!-- Start Tag  Field -->
					 <div class="form-group form-group-lg">
					  <label class="col-sm-2 control-label">Tag</label>
					    <div class="col-sm-10 col-md-4">
							<input  
								type= "text" 
								name="tags" 
								class="form-control" 
							   	placeholder="saperat  the Tags  with come(,)"/>
							 </div>

								</div>

					<!-- End Tag  Field -->	
					<!-- Start submit  Field -->
						<div class="form-group ">
						<div class="col-sm-offset-2 col-sm-10 col-md-4">
						<input  type= "submit" value="Add Iteme" class="btn btn-primary btn-sm "/>
						</div>

						</div>
					<!-- End submit  Field -->
				</div>
					    </form>


	<?php




// start Insert Iteme Page 

	}elseif ($do=='Insert') {

			if ($_SERVER['REQUEST_METHOD']=='POST') {
                  	echo "<h1 class='text-center'>Insert Members</h1>";
                  	echo "<div class='container'>";
                  		
                  		$name         =$_POST['name'];
                  		$description  =$_POST['description'];
                  		$price        =$_POST['price'];
                  		$country	  =$_POST['country'];
                  		$status       =$_POST['status'];
                  		$Member	      =$_POST['Members'];
                  		$Cat	      =$_POST['Categories'];
                  		$tags	      =$_POST['tags'];

                  		//Validate The  Form

                  		$FormErrors=array();

                  		if (empty($name)) {
                  			$FormErrors[]='name  can\'t be  <strong>empty</strong>';
                  		}

                  		if (empty($description)) {

                  			$FormErrors[]='description  can\'t be  <strong>empty</strong>  ';
                  		}
                  		if (empty($price)) {
                  		$FormErrors[]= 'price  can\'t be <strong>empty</strong> ';
                  		}
                  		if (empty($country)) {
                  		$FormErrors[]= 'country can\'t be <strong>empty</strong> ';
                  		}
                  		if ($status==0) {
                  		$FormErrors[]= 'you  must choose the status <strong>empty</strong> ';
                  		}
                  		if ($Member==0) {
                  		$FormErrors[]= 'you  must choose the  <strong>Member</strong> ';
                  		}
                  		if ($Cat==0) {
                  		$FormErrors[]= 'you  must choose the  <strong>Categor</strong> ';

                  		}


                  		// Loop into  Errors Array And Echo It 
							foreach ( $FormErrors  as $Error ) {
								echo '<div class="alert alert-danger">'.$Error.'</div>';
							}

							//Check if there is no Error Proced The Update Operation
							if (empty($FormErrors)) {
							//Update The  Userinfo In  Database 

							
								
	                  	        $stmt=$con->prepare("INSERT INTO 
	        items (Name, 
						age,Description,Addres,Country_Made,Lost_Relationship, 
						gander,Add_Date,Cat_ID,Member_ID,tags,Approve,Image,Lost_Date) 
	        values(:zname,:zage,:zdesc,:zaddres,:zcoun,:zLost_Relationship,:zgander,now(),:zcat,:zmember,:ztags,:zApprove,:zImage,:zlost_date)");

	        $stmt->execute(array(
	        'zname'                  =>$name,
	        'zage'                   =>$age,
	        'zdesc'                	 =>$desc,
	        'zaddres'                =>$addres,

	        
	        'zcoun'                  =>$country,
	        'zLost_Relationship'     =>$LostRelationship,
	        'zgander'	             =>$gander,	
	        'zcat'		             =>$Cat,
	        'zmember'	             =>$_SESSION['uid'],
	        'ztags'                  =>$tags,
	        'zApprove'				 =>$ReportNumber,
	        'zImage'				 =>$data,
	        'zlost_date'			 =>$Lost_Date
	        ));

	                  			//ECHO Success Message
	                  		     $theMsg= "<div class='alert alert-success'>".$stmt->rowCount().'Recored Inserted </div>';
	                  		     redirectHome($theMsg,'back');
									


                  		
							}else{
								$errormag='<div class="alert alert-danger">you have  to  fill all  required </div>';
                  				redirectHome($errormag,'back');
							}

                  	} 

                  	else{
                  		///if he enter the insert direct
                  		$errormag='<div class="alert alert-danger">you  cant  Brows this  page Directly</div>';
                  		redirectHome($errormag);
                  	}

                  	echo "</div>";



// start Edit Iteme Page 

	}elseif ($do=='Edit') {

			// Edit Page...

		//Ckeck IF Get Requst item is Numeric&Get The Intger Value Of It

		$itemid=isset($_GET['itemid'])&& is_numeric($_GET['itemid'] )? intval($_GET['itemid']): 0;
						# code...

		//Select All Depend on this  ID
				$stmt=$con->prepare("SELECT * FROM items where Item_ID=? ");
				$stmt->execute(array($itemid));
		//Execute The Data

				$item=$stmt->fetch();
	   //The Row Count
				$count=$stmt->rowCount();
				//if There is  such ID Show The Form







				if($count>0){?>
					 <!--  Edit Iteme Page-->

					 		

		 <h1 class="text-center">Edit Iteme </h1>
			<div class="container">
				<form class="form-horizontal"  action="?do=Update" method="POST">
				<Input type="hidden" name="itemid" value="<?php echo $itemid?>">

			<form class="form-horizontal"  action="?do=Insert" method="POST">
			<!-- Start Username  Field -->
			 <div class="form-group form-group-lg">
			  <label class="col-sm-2 control-label">Name</label>
			    <div class="col-sm-10 col-md-4">
					<input  
						required="required"
						type= "text" 
						name="name" 
						class="form-control" 
					   	placeholder="Name of  the  iteme "
					   	value="<?php echo  $item['Name']?>"/>
					 </div>

						</div>
				    <!-- End Username  Field -->

				    <!-- Start description  Field -->
					 <div class="form-group form-group-lg">
					  <label class="col-sm-2 control-label">description</label>
					    <div class="col-sm-10 col-md-4">
							<input  
								required="required"
								type= "text" 
								name="description" 
								class="form-control" 
							   	placeholder="Description of  the  iteme "
							   	value="<?php echo  $item['Description']?>"/>
							 </div>

								</div>
					<!-- End description  Field -->

					<!-- Start price  Field -->
					 <div class="form-group form-group-lg">
					  <label class="col-sm-2 control-label">age</label>
					    <div class="col-sm-10 col-md-4">
							<input  
								required="required"
								type= "text" 
								name="age" 
								class="form-control" 
							   	placeholder="price of  the  iteme "
							   	value="<?php echo  $item['age']?>"/>
							 </div>

								</div>
					<!-- End price  Field -->
					<!-- Start country  Field -->
					 <div class="form-group form-group-lg">
					  <label class="col-sm-2 control-label">country</label>
					    <div class="col-sm-10 col-md-4">
							<input  
								required="required"
								type= "text" 
								name="country" 
								class="form-control" 
							   	placeholder="country of  the  iteme "
							   	value="<?php echo  $item['Country_Made']?>"/>
							 </div>

								</div>

					<!-- End country  Field -->		
					<!-- Start status   Field -->
					 <div class="form-group form-group-lg">
					  <label class="col-sm-2 control-label">gander</label>
					    <div class="col-sm-10 col-md-4">
							<select  name="gander">
								<option value="man"  <?php if($item['gander']=='man'){echo 'selected';}?>  >man</option>
								<option value="women"  <?php if($item['gander']=='women' ){echo 'selected';}?>  >women</option>
								
								 ?>


								?>


							</select>
					</div>
						</div>
					<!-- End status  Field -->
					<!-- Start Members   Field -->
					 <div class="form-group form-group-lg">
					  <label class="col-sm-2 control-label">Members</label>
					    <div class="col-sm-10 col-md-4">
							<select  name="Members">
								
								<?php 
								$stmt=$con->prepare("SELECT *FROM users");
								$stmt-> execute();
								$users=$stmt->fetchAll();
								foreach ($users as $user) {
								 echo "<option value='".$user['UserID']."'"; 
								 if($item['Member_ID']==  $user['UserID']  ) {echo 'selected';} 
								 echo">".$user['Username']."-".$user['user_last_name']."</option>";
									
								}

								?>
								
							</select>
					</div>
						</div>
					<!-- End Members  Field -->
					<!-- Start Categories   Field -->
					 <div class="form-group form-group-lg">
					  <label class="col-sm-2 control-label">Categories</label>
					    <div class="col-sm-10 col-md-4">
							<select  name="Categories">
								<option value="0">....</option>
								<?php 
								$stmt2=$con->prepare("SELECT *FROM  categories");
								$stmt2-> execute();
								$cats=$stmt2->fetchAll();
								foreach ($cats as $cat) {
								 echo "<option value='".$cat['ID']."'"; 
								if($item['Cat_ID']==  $cat['ID']  ) {echo 'selected';} 
								echo ">".$cat['Name']."</option>";
									
								}

								?>
								
							</select>
					</div>
						</div>
					<!-- End Members  Field -->

<!-- Start LostRelationship   Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">LostRelationship</label>
							<div class="col-sm-10 col-md-9">
												<select  name="LostRelationship" required>
													<option value="">....</option>
													<option value="father" <?php if($item['Lost_Relationship']=='father'){echo 'selected';}?> >father</option>
													<option value="mother"  <?php if($item['Lost_Relationship']=='mother'){echo 'selected';}?> >mother</option>
													<option value="sister" <?php if($item['Lost_Relationship']=='sister'){echo 'selected';}?>>sister</option>
													<option value="pother" <?php if($item['Lost_Relationship']=='porther'){echo 'selected';}?>>porther</option>
												</select>
										</div>
											</div>
										<!-- End LostRelationship  Field -->
					<!-- Start Tag  Field -->
					 <div class="form-group form-group-lg">
					  <label class="col-sm-2 control-label">Tag</label>
					    <div class="col-sm-10 col-md-4">
							<input  
								type= "text" 
								name="tags" 
								class="form-control" 
							   	placeholder="saperat  the Tags  with come(,)" 
							   	value="<?php echo $item['tags']?>"/>
							 </div>

								</div>

					<!-- End Tag  Field -->	

					<!-- Start submit  Field -->
						<div class="form-group ">
						<div class="col-sm-offset-2 col-sm-10 col-md-4">
						<input  type= "submit" value="Add Iteme" class="btn btn-primary btn-sm "/>
						</div>

						</div>
					</form>


<?php 
//######################################Start Mangage Comments ####################################################-->							
    		//Manage Comments Page 

		$query='';
		if (isset($_GET['page'])&& $_GET['page']=='panding') {
			$query='AND RgSttatus = 0 ';
		}
		//Select  All Users EXcept Admin

		$stmt=$con->prepare("SELECT 
									comments.*,users.Username as memnber 
							 FROM
							 	    comments
							 
							 INNER JOIN
							 		users
							 ON
							 		users.UserID=comments.userid
							  where  item_id= ?");
		$stmt->execute(array($itemid));
		$rows=$stmt->fetchAll();
if (!empty($rows)) {
	# code...

		?>        
	
            <h1 class="text-center">Mangage <?php echo  $item['Name']?> Comments</h1>
				<div class="table-responsive">
					<table class="maintable text-center table table-bordered">
						<tr>
							<td>Comments</td>
						    <td>user Name</td>
						    <td>Add Date</td>
						    <td>Conterl</td>
						</tr>
								<?php  foreach ($rows as $row ) {
										echo "<tr>";

											echo "<td>".$row['comment']. "</td>";
											echo "<td>".$row['memnber']. "</td>";
											echo "<td>". $row['comment_data']."</td>";
											echo "<td>
												<a href='comments.php?do=Edit&comid=" 
												. $row['c_id'] .  "'class='btn btn-success'><i class='fa fa-edit'></i>Edit</a>
					   							<a href='comments.php?do=Delete&comid=" 
					   							. $row['c_id'] ."'class='btn btn-danger confirm'><i class='fa fa-close'></i>Delete</a>";
													if ($row['status']== 0) {
					   							echo "<a 
					   									href='comments.php?do=Aprrove&comid=" 
					   									. $row['c_id'] ."'
					   									class='btn btn-info '><i class='fa fa-check'>
					   									</i>Aprrove </a>";

												}
															echo "</td>";


															
														   echo "</tr>";
//<!--###################################### End Mangage Comments ####################################################-->							
	   
									
									}
										
										?>
										<tr>
										</table>
										<?php } else{echo  '<h1 class="text-center">there  is  no comment  for  '. $item['Name']. '</h1>';}?>
								</div>	
					<!-- End submit  Field -->


               <?php 	}
               //If There is No Such ID Show Error Message
               else{
               	echo "<div class='container'>";

               	$theMsg= '<div class="alert alert-danger">there is no such id</div>';
               	redirectHome($theMsg);
               	echo"</div>";
               }


// start Update Iteme Page 

	}elseif ($do=='Update') {
		echo "<h1 class='text-center'>Update Item</h1>";
                  	echo "<div class='container'>";	

                  	if ($_SERVER['REQUEST_METHOD']=='POST') {
                  		$id               =$_POST['itemid'];
                  		$name             =$_POST['name'];
                  		$description      =$_POST['description'];
                  		$age              =$_POST['age'];
                  		$country          =$_POST['country'];
                  		$gander           =$_POST['gander'];
                  		$Member           =$_POST['Members'];
                  		$LostRelationship =$_POST['LostRelationship'];
                  		$cat              =$_POST['Categories'];
                  		$tags             =$_POST['tags'];



                  		

                  		//Validate The  Form

                  		$FormErrors=array();

                  		if (empty($name)) {
                  			$FormErrors[]='name  can\'t be  <strong>empty</strong>';
                  		}

                  		if (empty($description)) {

                  			$FormErrors[]='description  can\'t be  <strong>empty</strong>  ';
                  		}
                  		if (empty($age)) {
                  		$FormErrors[]= 'age  can\'t be <strong>empty</strong> ';
                  		}
                  		if (empty($country)) {
                  		$FormErrors[]= 'country can\'t be <strong>empty</strong> ';
                  		}
                  		if (empty($gander)) {
                  		$FormErrors[]= 'you  must choose the gander <strong>empty</strong> ';
                  		}
                  		if ($Member==0) {
                  		$FormErrors[]= 'you  must choose the  <strong>Member</strong> ';
                  		}
						if (empty($LostRelationship)) {
                  		$FormErrors[]= 'you  must choose the  <strong>Lost Relationship</strong> ';
                  		}
                  		if ($cat==0) {
                  		$FormErrors[]= 'you  must choose the  <strong>Categor</strong> ';

                  		}


                  		
							


                  		// Loop into  Errors Array And Echo It 
							foreach ( $FormErrors  as $Error ) {
								echo '<div class="alert alert-danger">'.$Error.'</div>';
							}

							//Check if there is no Error Proced The Update Operation
							if (empty($FormErrors)) {
							//Update The Database With This Info?
                  	        $stmt=$con->prepare("UPDATE 
                  	        							items 
                  	        					 SET    
                  	        					 		Name              = ?,
                  	        					 		Description       = ?, 
                  	        					 		age       	      = ?,
                  	        					 		Country_Made      = ?,
                  	        					 		gander            = ?,
                  	        					 		Cat_ID            = ?,
                  	        					 		Member_ID         = ?, 
                  	        					 		Lost_Relationship =?,
                  	        					 		tags              =?
                  	        					 WHERE 
                  	        					 		Item_ID=?");
							$stmt->execute(array($name,$description,$age,$country,$gander,$cat,$Member,$LostRelationship,$tags,$id));

                  			//ECHO Success Message
               				$theMsg="<div class='alert alert-success'>".$stmt->rowCount().'Recored Upadted </div>';
							redirectHome($theMsg,'back');

							}


                  		


                  	} 

              else{
                 
                 $theMsg= '<div class="alert alert-danger">you  cant  Brows this  page Directly</div>';
               	 redirectHome($theMsg);
               	 
                  		
                 }

                  	echo "</div>";




//end  updata page

// start Delete Iteme Page 

	}elseif ($do=='Delete') {
		echo "<h1 class='text-center'>  Delate  Members page</h1>";
        echo "<div class='container'>";	
        //Ckeck IF Get Requst ItemId  is Numeric&Get The Intger Value Of It

		$itemid=isset($_GET['itemid'])&& is_numeric($_GET['itemid'] )? intval($_GET['itemid']): 0;
		
		//Select All Depend on this  ID
				$ckeck=ceckItem('Item_ID','items',$itemid);
		
				
	  
				//if There is  such ID Show The Form
	    if($ckeck>0){

				$stmt=$con->prepare("DELETE FROM items WHERE Item_ID = :zuers");
				$stmt->bindParam(":zuers",$itemid);
				$stmt->execute();
                $theMsg= "<div class='alert alert-success'>".$stmt->rowCount().'Recored Delete </div>';
                redirectHome($theMsg,'back');
                  	
                  }else{
                $theMsg= "<div class='alert alert-danger'>"."This  ID is  not Exist ".' </div>';
					redirectHome($theMsg,'back');
                  	
                  }
                  echo "</div>";			

// end  Delete iteme  page 
// start Activate Iteme Page 

	}elseif ($do=='Approve') {
		echo "<h1 class='text-center'>  Approve  Members page</h1>";
        echo "<div class='container'>";	
        //Ckeck IF Get Requst userid is Numeric&Get The Intger Value Of It

		$itemid=isset($_GET['itemid'])&& is_numeric($_GET['itemid'] )? intval($_GET['itemid']): 0;
		
		//Select All Depend on this  ID
				$ckeck=ceckItem('Item_ID','items',$itemid);
		
				
	  
				//if There is  such ID Show The Form
	    if($ckeck>0){

				$stmt=$con->prepare("UPDATE 
											items 
									 SET 
									 		Approve =1
									 WHERE 
									 		Item_ID = ?");
				$stmt->execute(array($itemid));
                $theMsg= "<div class='alert alert-success'>".$stmt->rowCount().'Recored activated </div>';
                redirectHome($theMsg,'back');
                  	
                  }else{
                	$theMsg= "<div class='alert alert-danger'>"."This  ID is  not Exist ".' </div>';
					redirectHome($theMsg,'back');
                  	
                  }
                  echo "</div>"; 
	}
	include $tpl.'footer.php';
 }else{
 	header('Location: index.php');
 	exit();


}
ob_end_flush(); 






