<?PHP
/*
================================================
==Category Page 

================================================
*/
ob_start();
session_start();
$pageTitle='Categories'; 


if (isset($_SESSION['Username'])) {


$do=isset($_GET['do'])?$_GET['do']:'Manage';
	include "init.php"; 
	
//Manage Members Page 
	if ($do=='Manage') {  

			$sort='ASC';

			$sort_array=array('ASC','DESC');

			if (isset($_GET['sort'])&&in_array($_GET['sort'], $sort_array)) {

				$sort=$_GET['sort'];
			}

			$stmt2=$con->prepare("SELECT *FROM  categories  where parent =0 ORDER BY Odering $sort");

			$stmt2->execute();

			$cats=$stmt2->fetchAll();

			if (!empty($cats)) { ?>


				<h1 class="text-center">Mange Categories</h1>
				<div class="container categories ">
					<div class="panel panel-default">
						<div class="panel-heading"> manage Category
							<div class="option pull-right">
								Ordering :
								<a class="<?php if($sort=='ASC'){echo 'active';}?>" href="?sort=ASC">ASC </a>
								<a class="<?php if($sort=='DESC'){echo 'active';}?>" href="?sort=DESC">DESC</a>
								View:<span class='active' data-view="full">Full</span>|
								<span  data-view="classic">Classic</span>
							</div>



						</div>
							
							<div class="panel-body">
								<?php
								
								foreach ($cats as $cat ) {
								echo "<div class='cat'>";
								echo "<div class='hidden-buttons'>";
									 echo"<a href='catageiers.php?do=Edite&catid=".$cat['ID']." 'class='btn  btn-xs btn-primary'><i class='fa fa-edite'>Edit</i></a>"; 
									 echo"<a href='catageiers.php?do=Delete&catid=".$cat['ID']." 'class='confirm btn  btn-xs btn-danger'><i class='fa fa-edite'>delete</i></a>"; 
									 echo "</div>";
									 echo"<h3>".$cat['Name'].'</h3>';
									 echo "<div class='full-view'>";
											echo "<p>";if(empty($cat['Description'])){
											echo '<p>this  Category has  no  decripation </p></br>';}else{echo $cat['Description'].'</p></br> ';}
											if($cat['Visibility']==1){echo '<span class="Visibility"> Hidden</span>';}
											if($cat['Allow_Comment']==1){echo '<span class="commenting">commenting</span>';};
											if ($cat['Allow_Ads']==1) {echo '<span class="advertises">ads disabled</span> ';}
											
												//Get Child Catagories
							
												$ChildCats=getAllFrom("*","categories","WHERE parent = {$cat['ID']}","","ID","ASC");
										        if (!empty($ChildCats)) 
										        {
										        	echo "<h4 class='child-head'>Child Categories</h4>";
										        	echo "<ul class='list-unstyled child-cats'>";

												        foreach ($ChildCats as $c) 
												        {
												        	echo "<li class='child-link'><a  href='catageiers.php?do=Edite&catid=".$c['ID']."'>".$c['Name'] ."</a>
												        		  <a href='catageiers.php?do=Delete&catid=".$c['ID']." 'class='show-delete confirm'>Delete</a>
												        	</li>";
												        }
												    echo"</ul>";

												}
									echo"</div>";

							echo "</div>";
							
							
								echo  "<hr>";
							}
								?>


							</div>

					</div>
					<a class="add-category btn btn-primary" href="catageiers.php?do=Add"><i class="fa fa-plus"></i>Add New  Categoery</a>

				</div>
<?php }else{
	        echo '<div class="container">';
	        		echo '<div class="nic-message">there is  no category  To  show </div>';
	        			echo '<a href="catageiers.php?do=Add" class=" btn  btn-sm btn-primary canter" >
	        			<i class="fa fa-plus"></i> add new Item</a>';

	        echo '</div>';
}?>
		<?php }elseif ($do=='Add') {?>


			 <!--  add Categories Page-->

		 <h1 class="text-center">Add Categories</h1>
			<div class="container">
							<form class="form-horizontal"  action="?do=Insert" method="POST">

			<form class="form-horizontal"  action="?do=Insert" method="POST">
			<!-- Start Username  Field -->
			 <div class="form-group form-group-lg">
			  <label class="col-sm-2 control-label">Name</label>
			    <div class="col-sm-10 col-md-4">
					<input  type= "text" name="name" class="form-control" 
					  autocomplete="off" required="required" placeholder="name of  the  Categories"/>
					 </div>

						</div>
				    <!-- End Username  Field -->


					  <!-- Start Descripation   Field -->
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Descripation</label>
								<div class="col-sm-10 col-md-4">
								 <input  type= "text" name="descripation" class="form-control"  placeholder="Descripa the Categories " />

						</div>

						</div>
				<!-- End Descripation  Field -->

				<!-- Start Odering  Field -->
					<div class="form-group form-group-lg">
					<label class="col-sm-2 control-label">Ordering</label>
					<div class="col-sm-10 col-md-4">
						<input  type= "text" name="ordering"    class="form-control"   placeholder="number to Arranger the Categories "/>
					</div>

					</div>
					<!-- End Odering  Field -->

					<!-- Start Category Type  -->
					<div class="form-group form-group-lg">
					<label class="col-sm-2 control-label">Paernt</label>
					<div class="col-sm-10 col-md-6">
						 <select name="parent">
						 	<option value="0">None</option>
						 	<?php
						 	$allCats=getAllFrom("*","categories","WHERE parent=0","","ID","ASC");
						 	foreach ($allCats as $cat ) {
						 		echo "<option value='".$cat['ID']."'>".$cat['Name']."</option>";
						 	}

						 	?>
						 </select>
					</div>

					</div>
					<!-- End Category Type    -->

					<!-- Start  Visible  Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Visible</label>
						<div class="col-sm-10 col-md-6">
							

							<div>
								<input id="vis-yes" type="radio" name="visibility" value="0" checked/>
								<label  for="vis-yes" >yes</label>

							</div>

							<div>
								<input id="vis-no" type="radio" name="visibility" value="1" />
								<label  for="vis-no" >no</label>

							</div>
						

				        </div>

					</div>
						<!-- End Visible Field -->

						<!-- Start  Comment  Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Commenting</label>
						<div class="col-sm-10 col-md-6">
							

							<div>
								<input id="com-yes" type="radio" name="commenting" value="0" checked/>
								<label  for="com-yes" >yes</label>

							</div>

							<div>
								<input id="com-no" type="radio" name="commenting" value="1" />
								<label for="com-no" >no</label>

							</div>
						

				        </div>

					</div>
						<!-- End Comment Field -->


						<!-- Start  Ads  Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label"> AllowAds</label>
						<div class="col-sm-10 col-md-6">
							

							<div>
								<input id="ads-yes" type="radio" name="ads" value="0" checked/>
								<label  for="ads-yes" >yes</label>

							</div>

							<div>
								<input id="ads-no" type="radio" name="ads" value="1" />
								<label  for="ads-no" >no</label>

							</div>
						

				        </div>

					</div>
					<!-- Start submit  Field -->
						<div class="form-group ">
						<div class="col-sm-offset-2 col-sm-10 col-md-4">
						<input  type= "submit" value="Add Categories" class="btn btn-primary btn-lg "/>
						</div>

						</div>
					<!-- End submit  Field -->
				</div>
					    </form>


	<?php	}elseif ($do=='Insert') {


			if ($_SERVER['REQUEST_METHOD']=='POST') {
                  	echo "<h1 class='text-center'>Insert categories</h1>";
                  	echo "<div class='container'>";
                  		
                  		$name     =$_POST['name'];
                  		$dec      =$_POST['descripation'];
                  		$parent   =$_POST['parent'];
                  		$order    =$_POST['ordering'];
                  		$Visible  =$_POST['visibility'];
                  		$comment  = $_POST['commenting'];
                  		$ads      =$_POST['ads'];


                  		
							
				//Ckeck if  Catagory  Eixts in Database 

							$check=ceckItem("Name","categories",$name);
							if ($check==1) {
									$theMsg= "<div class='alert alert-danger'>Sorry this  catoegery Is Exist </div>";

									redirectHome($theMsg,'back');
								}else{

	                  	        $stmt=$con->prepare("INSERT INTO 
	                  	        	 categories(Name,Description,parent,Odering,
	                  	        	Visibility,Allow_Comment,Allow_Ads) 
	                  	        	values(:zname,:zdesc,:zparent,:zorder,:zvis,:zcomment,:zads) ");

	                  	        $stmt->execute(array(
	                  	        	'zname'   => $name,
	                  	        	'zdesc'   => $dec,
	                  	        	'zparent' => $parent,
	                  	        	'zorder'  => $order,
	                  	        	'zvis'    => $Visible,
	                  	        	'zcomment'=> $comment,
	                  	        	'zads'    => $ads
	                  	        	));

	                  			//ECHO Success Message
	                  		     $theMsg= "<div class='alert alert-success'>".$stmt->rowCount().'Recored Inserted </div>';
	                  		     redirectHome($theMsg,'back');
									}


                  		
							

                  	} 

                  	else{
                  		///if he enter the insert direct
                  		$errormag='<div class="alert alert-danger">you  cant  Brows this  page Directly</div>';
                  		redirectHome($errormag,'back',5);
                  	}

                  	echo "</div>";

                  






//=====================================Edite  page  of Categorires==================================
				
		}elseif ($do=='Edite') {




		//Ckeck IF Get Requst Catid is Numeric&Get The Intger Value Of It

		$catid=isset($_GET['catid'])&& is_numeric($_GET['catid'] )? intval($_GET['catid']): 0;
						# code...
		
		//Select All Depend on this  ID
				$stmt=$con->prepare("SELECT * FROM categories where  ID=? ");
				$stmt->execute(array($catid));
		//Execute The Data

				$cat=$stmt->fetch();
	   //The Row Count
				$count=$stmt->rowCount();
				//if There is  such ID Show The Form
				if($count>0){?>
						
			





		 <h1 class="text-center">Edite  Categories</h1>
			<div class="container">
				<form class="form-horizontal"  action="?do=Upadate" method="POST">

			<form class="form-horizontal"  action="?do=Upadate" method="POST">
				<Input type="hidden" name="catid" value="<?php echo $catid?>">

			<!-- Start Username  Field -->
			 <div class="form-group form-group-lg">
			  <label class="col-sm-2 control-label">Name</label>
			    <div class="col-sm-10 col-md-4">
					<input  type= "text" name="name" class="form-control" 
					   required="required" placeholder="name of  the  Categories"  value="<?php echo $cat['Name']?>"/>
					 </div>

						</div>
				    <!-- End Username  Field -->


					  <!-- Start Descripation   Field -->
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Descripation</label>
								<div class="col-sm-10 col-md-4">
								 <input  type= "text" name="descripation" class="form-control"  placeholder="Descripa the Categories " value="<?php echo $cat['Description']?>" />

						</div>

						</div>
				<!-- End Descripation  Field -->
				
				<!-- Start Category Type  -->
				
					<div class="form-group form-group-lg">
					<label class="col-sm-2 control-label">Paernt</label>
					<div class="col-sm-10 col-md-6">
						 <select name="parent">
						 	<option value="0">None</option>
						 	<?php 
						 	$allCats=getAllFrom("*","categories","WHERE parent=0","","ID","ASC");
						 	foreach ($allCats as $c ) {
						 		echo "<option value='".$c['ID']."'";
						 		if ($cat['parent']==$c['ID']) {echo 'selected';}
						 		echo ">".$c['Name']."</option>";
						 	}

						 	?>
						 </select>
					</div>

					</div> 
					<!-- End Category Type    -->
					
				<!-- Start Odering  Field -->
					<div class="form-group form-group-lg">
					<label class="col-sm-2 control-label">Ordering</label>
					<div class="col-sm-10 col-md-4">
						<input  type= "text" name="ordering"    class="form-control"   placeholder="number to Arranger the Categories " value="<?php echo $cat['Odering']?>"/>
					</div>

					</div>
					<!-- End Odering  Field -->

					<!-- Start  Visible  Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Visible</label>
						<div class="col-sm-10 col-md-6">
							

							<div>
								<input id="vis-yes" type="radio" name="visibility" value="0" <?php if($cat['Visibility']==0 ){echo 'checked';}?>/>
								<label  for="vis-yes" >yes</label>

							</div>

							<div>
								<input id="vis-no" type="radio" name="visibility" value="1" <?php if($cat['Visibility']==1 ){echo 'checked';}?> />
								<label  for="vis-no" >no</label>

							</div>
						

				        </div>

					</div>
						<!-- End Visible Field -->

						<!-- Start  Comment  Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Commenting</label>
						<div class="col-sm-10 col-md-6">
							

							<div>
								<input id="com-yes" type="radio" name="commenting" value="0" <?php if($cat['Allow_Comment']==0 ){echo 'checked';}?>/>
								<label  for="com-yes" >yes</label>

							</div>

							<div>
								<input id="com-no" type="radio" name="commenting" value="1"  <?php if($cat['Allow_Comment']==1 ){echo 'checked';}?>/>
								<label for="com-no" >no</label>

							</div>
						

				        </div>

					</div>
						<!-- End Comment Field -->


						<!-- Start  Ads  Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label"> AllowAds</label>
						<div class="col-sm-10 col-md-6">
							

							<div>
								<input id="ads-yes" type="radio" name="ads" value="0" <?php if($cat['Allow_Ads']==0 ){echo 'checked';}?>/>
								<label  for="ads-yes" >yes</label>

							</div>

							<div>
								<input id="ads-no" type="radio" name="ads" value="1" <?php if($cat['Allow_Ads']==1 ){echo 'checked';}?>/>
								<label  for="ads-no" >no</label>

							</div>
						

				        </div>

					</div>
					<!-- Start submit  Field -->
						<div class="form-group ">
						<div class="col-sm-offset-2 col-sm-10 col-md-4">
						<input  type= "submit" value="save" class="btn btn-primary btn-lg "/>
						</div>

						</div>
					<!-- End submit  Field -->
				</div>
					    </form>



               <?php	}
               //If There is No Such ID Show Error Message
               else{
               	echo "<div class='container'>";

               	$theMsg= '<div class="alert alert-danger">there is no such id</div>';
               	redirectHome($theMsg);
               	echo"</div>";
               }


//=============================================//Start Upadate page for catagiers//=============================================


			
}elseif ($do=='Upadate') {



/////////////






				echo "<h1 class='text-center'>Upadate Members</h1>";
                  	echo "<div class='container'>";	

                  	if ($_SERVER['REQUEST_METHOD']=='POST') {
                  		$id  	  =$_POST['catid'];
                  		$name     =$_POST['name'];
                  		$dec      =$_POST['descripation'];
                  		$parent   =$_POST['parent'];
                  		$order    =$_POST['ordering'];
                  		$Visible  =$_POST['visibility'];
                  		$comment  =$_POST['commenting'];
                  		$ads      =$_POST['ads'];
                  		
						
							//Update The Database With This Info?
                  	        $stmt=$con->prepare("UPDATE 
                  	        							categories 	 
                  	        					 SET    Name            = ?,
                  	        					 	    Description     = ?, 
                  	        					 	    Odering         = ?,
                  	        					 	    parent          = ?,
                  	        					 	    Visibility      = ?,
                  	        					 	    Allow_Comment   = ?,
                  	        					 	    Allow_Ads       = ?
                  	        					 WHERE   
                  	        							 ID= ?");




                  			$stmt->execute(array($name ,$dec,$order,$parent,$Visible,$comment,$ads,$id));

                  			//ECHO Success Message

                  			
                  			$theMsg="<div class='alert alert-success'>".$stmt->rowCount().'Recored Upadted </div>';
							redirectHome($theMsg,'back');

							


                  		


                  	} 

              else{
                 
                 $theMsg= '<div class="alert alert-danger">you  cant  Brows this  page Directly</div>';
               	 redirectHome($theMsg);
               	 
                  		
                 }

                  	echo "</div>";






///////////////////////////

				
                  }
//=============================================//End Upadate page//=============================================

//=============================================//Strat  Delate page//=============================================

			

	elseif ($do=='Delete') {





echo "<h1 class='text-center'>  Delate  Catagoryies page</h1>";
        echo "<div class='container'>";	
        //Ckeck IF Get Requst catid is Numeric&Get The Intger Value Of It

		$catid=isset($_GET['catid'])&& is_numeric($_GET['catid'] )? intval($_GET['catid']): 0;
		
		//Select All Depend on this  ID
				$ckeck=ceckItem('ID','categories',$catid);
		
				
	  
				//if There is  such ID Show The Form
	    if($ckeck>0){

				$stmt=$con->prepare("DELETE FROM   categories  WHERE ID = :zuers");
				$stmt->bindParam(":zuers",$catid);
				$stmt->execute();
                $theMsg= "<div class='alert alert-success'>".$stmt->rowCount().'Recored Delete </div>';
                redirectHome($theMsg,'back');
                  	
                  }else{
                $theMsg= "<div class='alert alert-danger'>"."This  ID is  not Exist ".' </div>';
					redirectHome($theMsg,'back');
                  	
                  }
                  echo "</div>";
			
		}

//=============================================//End  Delate page//=============================================

		include $tpl.'footer.php';
	}else{

		header('Location:index.php');
		exit();
	}
		
		ob_end_flush();
?>