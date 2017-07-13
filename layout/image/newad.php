<?php ob_start();

session_start();

$pageTitle='Creat new Post';

include 'init.php'; 

if (isset($_SESSION['user'])) {

if ($_SERVER['REQUEST_METHOD']=='POST') {

	$formErrors=array();

	$name              = filter_var  ($_POST['name'],FILTER_SANITIZE_STRING);
	$age               = filter_var  ($_POST['age'],FILTER_SANITIZE_NUMBER_INT);
	$desc             = filter_var   ($_POST['desc'],FILTER_SANITIZE_STRING);
	$addres             = filter_var ($_POST['addres'],FILTER_SANITIZE_STRING);
	$country           = filter_var  ($_POST['country'],FILTER_SANITIZE_STRING);
	$LostRelationship  = $_POST['LostRelationship'];
	$gander            = $_POST['gander'];

	$Cat               = filter_var ($_POST['Categories'] ,FILTER_SANITIZE_NUMBER_INT);
	$tags              = filter_var ($_POST['tags'],FILTER_SANITIZE_STRING);
	$ReportNumber	   = filter_var ($_POST['ReportNumber'] ,FILTER_SANITIZE_NUMBER_INT);

	$Lost_Date		   =$_POST['missingdata'];

		if (strlen($name)<4) {
				$formErrors[]=lang('MustBeAtLeast4');

		}
		if (empty($name)) {
				$formErrors[]=lang('notBeEmpty'); 

		} 
		if (strlen($age)>=3) {
				$formErrors[]=lang('MustBenotmore3');

		}
		if (empty($age)) {
				$formErrors[]=lang('ageMustnotBeEmpty');

		}
		if (strlen($desc)<10) {
				$formErrors[]=lang('descMustnotBeEmpty');

		}

		if (strlen($addres)<10) {
				$formErrors[]=lang('descMustnotBeEmpty');

		}
		if (strlen($country)<2) {
				$formErrors[]=lang('countryMustBeAt');

		}
		
		if (empty($LostRelationship)) {
				$formErrors[]=lang('LostRelationshipMust');

		}
		if (empty($gander)) {
				$formErrors[]=lang('ganderMustnot');

		}
		if (empty($Cat)) {
				$formErrors[]=lang('categoriesMustnot'); 

		}
		if (empty($Lost_Date)) {
				$formErrors[]=lang('Lost Date cant  be emtpy ' ); 

		}
		

// get the uploaded file name

	$file_name =$_FILES['myFile']['name'];
    $file_tmp= $_FILES['myFile']['tmp_name'];
    $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
    $base64 = file_get_contents($file_tmp);
    $data =base64_encode($base64);
// There is an argument that this is unnecessary with base64 encoded data, but
// better safe than sorry :)
		


	// 	// Upload the file to /upload folder and check if succeeded
	// 	if(move_uploaded_file($_FILES["myFile"]["tmp_name"],  'upload/'.$file_name)){
	// // Print image url, you can save that url into Database
			
	// 	}else{
	// 		$formErrors[]=lang('photo');
	// 	}

	//Check if there is no Error Proced The Update Operation
		if (empty($formErrors)) 
		{
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
	         if ($stmt) {
	         	$successMsg =lang('ItemisAddedNow');
	         }
									


                  		
							}	

}

?>
<h1 class="text-center"><?php echo lang('newPost') ;?></h1>
<div class="creat-ad blocks">		

	<div class="container ">
		<div class="panel panel-primary">
			<div class="panel-heading"><?php echo lang('newPost') ;?></div>
				<div class="panel-body">
					<div  class="row">

<!--########################### Start The Form To  Add A new Item ############################## -->
					
						<div class="col-md-8">
								<form class="form-horizontal main-form"  action="<?php echo $_SERVER['PHP_SELF']  ?>" method="POST" enctype="multipart/form-data">
								<!-- Start Username  Field -->
								 <div class="form-group form-group-lg">
									  <label class="col-sm-3 control-label"><?php echo lang('name') ;?></label>
									    <div class="col-sm-10 col-md-9">
											<input  
												pattern=".{4,}"
												title="this field Require at least 4 characters"
												type= "text" 
												name="name" 
												class="form-control live" 
											   	placeholder="<?php echo lang('pNameoftheiteme')?> " 
											   	data-class=".live-titel"
											   	required/>
										</div>
								</div>
									    <!-- End Username  Field -->

									    <!-- Start age  Field -->
								 <div class="form-group form-group-lg">
									  <label class="col-sm-3 control-label"><?php echo lang('age') ;?></label>
									    <div class="col-sm-10 col-md-9">
											<input  
												pattern=".{1,}"
												title="this field Require at least 3 characters"
												type= "number" 
												name="age" 
												class="form-control live" 
											   	placeholder="<?php echo lang('age')?>  " 
											   	data-class=".live-price"
											   	required/>
										</div>
								</div>
									    <!-- End age  Field -->

									    <!-- Start desc  Field -->
										 <div class="form-group form-group-lg">
										  <label class="col-sm-3 control-label"><?php echo lang('desc') ;?></label>
										    <div class="col-sm-10 col-md-9">
												<input  
													pattern=".{10,}"
											        title="this field Require at least 10 characters"
													type= "text" 
													name="desc" 
													class="form-control live" 
												   	
												   	placeholder=" <?php echo lang('pdesc')?>" 
												   	data-class=".live-desc"
												   	required/>
											</div>

										 </div>
										<!-- End Addres  Field -->


									    <!-- Start Addres  Field -->
										 <div class="form-group form-group-lg">
										  <label class="col-sm-3 control-label"><?php echo lang('addres') ;?></label>
										    <div class="col-sm-10 col-md-9">
												<input  
													pattern=".{10,}"
											        title="this field Require at least 10 characters"
													type= "text" 
													name="addres" 
													class="form-control live" 
												   	
												   	placeholder=" <?php echo lang('paddres')?>" 
												   	
												   	required/>
											</div>

										 </div> 
										 <!-- Start pmissing data Field -->
										 <div class="form-group form-group-lg">
										  <label class="col-sm-3 control-label">data </label>
										    <div class="col-sm-10 col-md-9">
												<input  
													
													type= "text" 
													name="missingdata" 
													class="form-control live" 
												   	
												   	placeholder=" data when he  was  missing" 
												   	
												   	required/>
											</div>

										 </div>
										<!-- End pmissing data  Field -->
										
										<!-- Start country  Field -->
										 <div class="form-group form-group-lg">
										  <label class="col-sm-3 control-label"><?php echo lang('country') ;?></label>
										    <div class="col-sm-10 col-md-9">
												<input  
													
													type= "text" 
													name="country" 
													class="form-control" 
												   	placeholder=" <?php echo lang('pcountry')?> " required/>
												 </div>

													</div>

										<!-- End country  Field -->		
										<!-- Start LostRelationship   Field -->
										 <div class="form-group form-group-lg">
										  <label class="col-sm-3 control-label"><?php echo lang('LostRelationship:') ;?></label>
										    <div class="col-sm-10 col-md-9">
												<select  name="LostRelationship" required>
													<option value="">....</option>
													<option value="father"><?php echo lang('father');?></option>
													<option value="mother"><?php echo lang('mother') ;?></option>
													<option value="sister"><?php echo lang('sister') ;?></option>
													<option value="pother"><?php echo lang('brther') ;?></option>
												</select>
										</div>
											</div>
										<!-- End LostRelationship  Field -->
										

										<!-- Start Gender   Field -->
										 <div class="form-group form-group-lg">
										  <label class="col-sm-3 control-label"><?php echo lang('gander') ;?></label>
										    <div class="col-sm-10 col-md-9">
												<select  name="gander" required>
													<option value="">....</option>
													<option value="man"><?php echo lang('man')?></option>
													<option value="women"><?php echo lang('women')?></option>
													
												</select>
											</div>
											</div>
										<!-- End Gender  Field -->	

										<!-- Start Categories   Field -->
										 <div class="form-group form-group-lg">
										  <label class="col-sm-3 control-label"><?php echo lang('category:') ;?></label>
										    <div class="col-sm-10 col-md-9">
												<select  name="Categories">
												<option value="">....</option>
													<?php 
													$cats =getAllFrom('*','categories','where Name!="found "','','ID');
													
													foreach ($cats as $cat) {
													 echo "<option value='".$cat['ID']."'>".$cat['Name']."</option>";
														
													}

													?>
													
												</select>
										</div>
											</div>
										<!-- End Categories  Field -->
										<!-- Start Tag  Field -->
											<div class="form-group form-group-lg">
											<label class="col-sm-3 control-label"><?php echo lang('tags:') ;?></label>
											    <div class="col-sm-10 col-md-9">
													<input  
														type= "text" 
														name="tags" 
														class="form-control" 
													   	placeholder="<?php echo lang('pTags')?>" 
													   	/>
													 </div>
												</div>	 	

												<div class="form-group form-group-lg ReportNumber">
										  			<label class="col-sm-3 control-label"><?php echo lang('ReportNumber') ;?></label>
										    	<div class="col-sm-10 col-md-9">
													<input  
														type= "text" 
														name="ReportNumber" 
														class="form-control" 
													   	placeholder="<?php echo lang('pReportNumber')?>" 
													   	/>
												</div>
											</div>

													 <!--Start image-->
											<div class="form-group form-group-lg ReportNumber">

													 <label class="col-sm-3 control-label"><?php echo lang('Image') ;?></label>
												<div class="col-sm-10 col-md-9">
													<input type="file" name="myFile">
												
												</div>
													<!--End image -->
											</div>

										<!-- End Tag  Field -->	
										<!-- Start submit  Field -->
											<div class="form-group ">
											<div class="col-sm-offset-3 col-sm-10 col-md-9">
											<input  type= "submit" value="<?php echo lang('AddIteme');?>" class="btn btn-primary btn-sm "/>
											</div>

											</div>
										<!-- End submit  Field -->
											</div>

										    </form>

<!--########################### End The Form To  Add A new Item ############################## -->
<!--########################### Start  the live-prview   Form To  Add A new Item ############################## -->
				
							<div class="col-md-4">
									<div  class="thumbnail item-box live-prview">
										<img  class="img-responsive"src="image.png" alt=""/>
										<div class="caption">
									    		<span class="price-Tag">
									    		<span class="live-price"><?php echo lang('age');?></span>
									    		</span>
									  			<h3 class="live-titel"><?php echo lang('name');?></h3>
									  			<p class="live-desc"><?php echo lang('pdesc');?></p> 
										</div>
									</div>

								 </div>
<!--########################### End  the  live-prview   Form To  Add A new Item ############################## -->
							</div>
							<!-- Start Looping Through Errors-->
							<?php
								if (!empty($formErrors)) {
									foreach ($formErrors as $error ) {
										echo '<div class="alert alert-danger">'.$error.'</div>';
										
									}
								}
								if (isset($successMsg)) {echo  '<div Class="alert alert-success text-center">'.$successMsg.'<div>';}

							?>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php 
	} else{
		header('Location: login.php');
		exit();
	}
include $tpl.'footer.php';
ob_end_flush(); 

?>