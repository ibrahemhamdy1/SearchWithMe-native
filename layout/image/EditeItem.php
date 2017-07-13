<?php ob_start();

session_start();

$pageTitle='EditeItem';
include 'init.php'; 


//Ckeck IF Get Requst item is Numeric&Get The Intger Value Of It
if (isset($_SESSION['user'])) {

	$itemid=isset($_GET['itemid'])&& is_numeric($_GET['itemid'] )? intval($_GET['itemid']): 0;




		echo  "you  are  in the  Edite page";

									# code...
			//Select All Depend on this  ID
			$stmt=$con->prepare("SELECT 
										 items.*,
												  categories.Name 
											AS  
												  category_name ,
												  users.Username
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
											WHERE 
													Item_ID =?
												 
											ORDER BY 
										 			Item_ID  DESC
										 		");
			$stmt->execute(array($itemid));
			//Execute The Data
			//The Row Count
			$count=$stmt->rowCount();
			if ($count >0) {
				# code...

			$item=$stmt->fetch();
				//Start Ckeck IF he is  owner  of  tha page 

				if( $_SESSION['uid'] == $item['Member_ID']){
						//here  we will start to  put  our  Input  to  Edite  the  item

if ($_SERVER['REQUEST_METHOD']=='POST') {

	$formErrors=array();

	$name              = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
	$age               = filter_var($_POST['age'],FILTER_SANITIZE_NUMBER_INT);
	$addres             = filter_var($_POST['addres'],FILTER_SANITIZE_STRING);
	$country           = filter_var($_POST['country'],FILTER_SANITIZE_STRING);
	$LostRelationship  = $_POST['LostRelationship'];
	$gander            = $_POST['gander'];

	$Cat               = $_POST['Categories'] ;
	$tags              = filter_var($_POST['tags'],FILTER_SANITIZE_STRING);
	$ReportNumber	   = filter_var($_POST['ReportNumber'] ,FILTER_SANITIZE_NUMBER_INT);

		if (strlen($name)<4) {
				$formErrors[]='Item Titel Must Be At Least 4 characters';

		}
		if (empty($name)) {
				$formErrors[]='Item name Must not  Be Empty';

		} 
		if (strlen($age)>=3) {
				$formErrors[]='Item age Must Be not more  3 characters';

		}
		if (empty($age)) {
				$formErrors[]='Item age Must not  Be Empty';

		}
		if (strlen($addres)<10) {
				$formErrors[]='Item desc Must Be At Least 10 characters';

		}

		if (strlen($country)<2) {
				$formErrors[]='Item country Must Be At Least 2 characters';

		}
		
		if (empty($LostRelationship)) {
				$formErrors[]='Item Lost Relationship Must not  Be Empty';

		}
		if (empty($gander)) {
				$formErrors[]='Item gander Must not  Be Empty';

		}
		if (empty($Cat)) {
				$formErrors[]='Item categories Must not  Be Empty';

		}

// get the uploaded file name
		$file_name = $_FILES["myFile"]["name"];

		// Upload the file to /upload folder and check if succeeded
		

foreach ( $formErrors  as $Error ) {
								echo '<div class="alert alert-danger">'.$Error.'</div>';
	}



	//Check if there is no Error Proced The Update Operation
		if (empty($formErrors)) 
		{
		//Update The  Userinfo In  Database 

							
								
	    $stmt=$con->prepare("UPDATE 
                  	   				items 
                  	        	SET    
                  	        		Name              = ?,
                  	        		Description       = ?, 
                  	        		age       	      = ?,
                  	        		Country_Made      = ?,
                  	        		gander            = ?,
                  	        		Cat_ID            = ?,
                  	        		Lost_Relationship = ?,
                  	        		tags              = ?,
                  	        		Approve			  = ?
                  	        	WHERE 
                  	        					 		Item_ID=?");
		$stmt->execute(array($name,$addres,$age,$country,$gander,$cat,$LostRelationship,$tags,$ReportNumber,$itemid));

	        //ECHO Success Message
	         if ($stmt) {
	         	$successMsg ='Item is Added Now';
	         }
									


                  		
							}	

}






					?>


					<h1 class="text-center"><?php echo $pageTitle ;?></h1>
<div class="creat-ad blocks">		

	<div class="container ">
		<div class="panel panel-primary">
			<div class="panel-heading"><?php echo $pageTitle ;?></div>
				<div class="panel-body">
					<div  class="row">

<!--########################### Start The Form To  Add A new Item ############################## -->
					
						<div class="col-md-8">
								<form class="form-horizontal main-form"  action="<?php echo $_SERVER['PHP_SELF'].'?itemid='.$item["Item_ID"].'';  ?>" method="POST" enctype="multipart/form-data">
								<!-- Start Username  Field -->
								 <div class="form-group form-group-lg">
									  <label class="col-sm-3 control-label">Name</label>
									    <div class="col-sm-10 col-md-9">
											<input  
												value="<?php echo $item['Name']?>" 
												pattern=".{4,}"
												title="this field Require at least 4 characters"
												type= "text" 
												name="name" 
												class="form-control live" 
											   	placeholder="Name of  the  iteme " 
											   	data-class=".live-titel"
											   	required/>
										</div>
								</div>
									    <!-- End Username  Field -->

									    <!-- Start age  Field -->
								 <div class="form-group form-group-lg">
									  <label class="col-sm-3 control-label">age</label>
									    <div class="col-sm-10 col-md-9">
											<input  
												value="<?php echo $item['age']?>" 
												pattern=".{1,}"
												title="this field Require at least 3 characters"
												type= "number" 
												name="age" 
												class="form-control live" 
											   	placeholder="age of  the  missing " 
											   	data-class=".live-price"
											   	required/>
										</div>
								</div>
									    <!-- End age  Field -->


									    <!-- Start Addres  Field -->
										 <div class="form-group form-group-lg">
										  <label class="col-sm-3 control-label">Addres</label>
										    <div class="col-sm-10 col-md-9">
												<input 
													value="<?php echo $item['Description']?>" 
													pattern=".{10,}"
											        title="this field Require at least 10 characters"
													type= "text" 
													name="addres" 
													class="form-control live" 
												   	
												   	placeholder="Description of  the  iteme " 
												   	data-class=".live-desc"
												   	required/>
											</div>

										 </div>
										<!-- End Addres  Field -->
										
										<!-- Start country  Field -->
										 <div class="form-group form-group-lg">
										  <label class="col-sm-3 control-label">country</label>
										    <div class="col-sm-10 col-md-9">
												<input  
													value="<?php echo $item['Country_Made']?>"
													type= "text" 
													name="country" 
													class="form-control" 
												   	placeholder="country of  the  iteme " required/>
												 </div>

													</div>

										<!-- End country  Field -->		
										<!-- Start LostRelationship   Field -->
										 <div class="form-group form-group-lg">
										  <label class="col-sm-3 control-label">LostRelationship</label>
										    <div class="col-sm-10 col-md-9">
												<select  name="LostRelationship" required>
													<option value="">....</option>
													<option value="father" <?php if($item['Lost_Relationship']=='father'){echo 'selected';} ?> >father</option>
													<option value="mother" <?php if($item['Lost_Relationship']=='mother'){echo 'selected';} ?> >mother</option>
													<option value="sister" <?php if($item['Lost_Relationship']=='sister'){echo 'selected';} ?> >sister</option>
													<option value="pother" <?php if($item['Lost_Relationship']=='pother'){echo 'selected';} ?> >porther</option>
												</select>
										</div>
											</div>
										<!-- End LostRelationship  Field -->
										

										<!-- Start Gender   Field -->
										 <div class="form-group form-group-lg">
										  <label class="col-sm-3 control-label">gander</label>
										    <div class="col-sm-10 col-md-9">
												<select  name="gander" required>
													<option value="">....</option>
													<option value="man" <?php if($item['gander']=='man'){echo 'selected';} ?>   >man</option>
													<option value="women" <?php if($item['women']=='man'){echo 'selected';} ?> >women</option>
													
												</select>
										</div>
											</div>
										<!-- End Gender  Field -->	

										<!-- Start Categories   Field -->
										 <div class="form-group form-group-lg">
										  <label class="col-sm-3 control-label">Categories</label>
										    <div class="col-sm-10 col-md-9">
												<select  name="Categories">
												<option value="">....</option>
													<?php 
													$cats =getAllFrom('*','categories','','','ID');
													
													foreach ($cats as $cat) {
													 echo "<option value='".$cat['Name']."'"; 
													if($item['Cat_ID'] ==  $cat['ID']  ) {echo 'selected';} 
															echo ">".$cat['Name']."</option>";
														}

													?>
													
												</select>
										</div>
											</div>
										<!-- End Categories  Field -->
										<!-- Start Tag  Field -->
											<div class="form-group form-group-lg">
											<label class="col-sm-3 control-label">Tag</label>
											    <div class="col-sm-10 col-md-9">
													<input
														value="<?php echo $item['tags']?>"
														type= "text" 
														name="tags" 
														class="form-control" 
													   	placeholder="saperat  the Tags  with come(,)" 
													   	/>
													 </div>
												</div>	 	

												<div class="form-group form-group-lg ReportNumber">
										  			<label class="col-sm-3 control-label">ReportNumber</label>
										    	<div class="col-sm-10 col-md-9">
													<input
														value="<?php echo $item['Approve']?>"
														type= "text" 
														name="ReportNumber" 
														class="form-control" 
													   	placeholder="ReportNumber" 
													   	/>
												</div>
											</div>

													 <!--Start image-->
											<div class="form-group form-group-lg ReportNumber">

													 <label class="col-sm-3 control-label">Image</label>
												<div class="col-sm-10 col-md-9">
													<input type="file" name="myFile">
												
												</div>
													<!--End image -->
											</div>

										<!-- End Tag  Field -->	
										<!-- Start submit  Field -->
											<div class="form-group ">
											<div class="col-sm-offset-3 col-sm-10 col-md-9">
											<input  type= "submit" value="Add Iteme" class="btn btn-primary btn-sm "/>
											</div>

											</div>
										<!-- End submit  Field -->
											</div>

										    </form>

<!--########################### End The Form To  Add A new Item ############################## -->
<!--########################### Start  the live-prview   Form To  Add A new Item ############################## -->
				
							<div class="col-md-4">
									<div  class="thumbnail item-box live-prview">
										<img  class="img-responsive" src="upload/<?PHP ECHO $item['Image']?>" alt="" height="252.5" width="350.34"/>
										<div class="caption">
									    		<span class="price-Tag">
									    		<span class="live-price"><?PHP ECHO $item['age'].'Y'?></span>
									    		</span>
									  			<h3 class="live-titel"><?PHP ECHO $item['Name']?></h3>
									  			<p class="live-desc"><?PHP ECHO $item['Description']?></p> 
										</div>
									</div>

								 </div>
<!--########################### End  the  live-prview   Form To  Add A new Item ############################## -->
							</div>






					<?php
							
				}
				else {
							echo "you  can not  eite  this  Item"; 
				}
				//Start Ckeck IF he is  owner  of  tha page 

			}else{ $theMsg= "<div class='alert alert-danger'>"."This  ID is  not Exist ".' </div>';
					redirectHome($theMsg,'back');}
}


else{
	
	echo '
			<div class="contaner  text-center">
				<div class=" alert alert-danger">you  can not  Brows  this  page  directly You  will  sent  to the  Login page </div>
				';
header("refresh:2;url=login.php");
}
include $tpl.'footer.php';
ob_end_flush(); 

?>