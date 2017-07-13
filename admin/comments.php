<?php  
/*
================================================
==Menage Comments Page 
==you can Edit|Delet|Aprrove Comments From Here 
================================================
*/
ob_start();
session_start();
$pageTitle='Comments'; 
if (isset($_SESSION['Username'])) {
$do=isset($_GET['do'])?$_GET['do']:'Manage';
	include "init.php"; 
	
	//=====================================////Start  Manage 	Page============================================================== -->

	if ($do=='Manage') { 
	 //Manage Comments Page 

		$query='';
		if (isset($_GET['page'])&& $_GET['page']=='panding') {
			$query='AND RgSttatus = 0 ';
		}
		//get  data from Database 

		$stmt=$con->prepare("SELECT 
									comments.*,items.Name as Item_Name,users.Username as memnber,users.user_last_name as lastName
							 FROM
							 	    comments
							 INNER JOIN
							 		items
							 ON
							 		items.Item_ID=comments.item_id
							 INNER JOIN
							 		users
							 ON
							 		users.UserID=comments.userid
							ORDER BY 
							 		c_id  DESC	
							  ");
		$stmt->execute();
		$comments=$stmt->fetchAll();
		if (!empty($comments)) {
			# code...
		
		?>
						
          
            <h1 class="text-center">Mangage Comments</h1>
			<div class="container">

				<div class="table-responsive">

					<table class="maintable text-center table table-bordered">
						<tr>
							<td>#ID</td>
							<td>Comments</td>
							<td>Item Name</td>
						    <td>user Name</td>
						    <td>Add Date</td>
						    <td>Conterl</td>

						</tr>
								<?php  foreach ($comments as $comment ) {
										echo "<tr>";

											echo "<td>".$comment['c_id']. "</td>";
											echo "<td>".$comment['comment']. "</td>";
											echo "<td>".$comment['Item_Name']. "</td>";
											echo "<td>".$comment['memnber']." ".$comment['lastName']. "</td>";
											echo "<td>".$comment['comment_data']."</td>";
											echo "<td>
												<a href='comments.php?do=Edit&comid=" 
												. $comment['c_id'] .  "'class='btn btn-success'><i class='fa fa-edit'></i>Edit</a>
					   							<a href='comments.php?do=Delete&comid=" 
					   							. $comment['c_id'] ."'class='btn btn-danger confirm'><i class='fa fa-close'></i>Delete</a>";
													if ($comment['status']== 0) {
					   							echo "<a 
					   									href='comments.php?do=Aprrove&comid=" 
					   									. $comment['c_id'] ."'
					   									class='btn btn-info '><i class='fa fa-check'>
					   									</i>Aprrove </a>";

												}
															echo "</td>";


															
														   echo "</tr>";
									}



				  ?>
						
						
					</table>
				</div>
			</div>


	<?php 
			}else{
					echo '<div class="container">';
	        		echo '<div class="nic-message">there is  no  Comments  To  show </div>';
	        		
	        echo '</div>';
                 }

	?>


	    <?php }elseif ($do=='Edit') {
	   // Edit comment

		//Ckeck IF Get Requst comment-id is Numeric&Get The Intger Value Of It

		$comid=isset($_GET['comid'])&& is_numeric($_GET['comid'] )? intval($_GET['comid']): 0;
						# code...
		
		//Select All Depend on this  ID
				$stmt=$con->prepare("SELECT * FROM comments where  c_id=? LIMIT  1 ");
				$stmt->execute(array($comid));
		//Execute The Data

				$row=$stmt->fetch();
	   //The Row Count
				$count=$stmt->rowCount();
				//if There is  such ID Show The Form
				if($count>0){?>
					
				
		
						
						<h1 class="text-center">Edit comment</h1>
						<div class="container">
							<form class="form-horizontal"  action="?do=Update" method="POST">
								<Input type="hidden" name="comid" value="<?php echo $comid?>">
								<!-- Start Comment  Field -->
									<div class="form-group form-group-lg">
										<label class="col-sm-2 control-label">Comment</label>
										<div class="col-sm-10 col-md-6">
										<textarea class="form-control" name="comment" > <?php echo $row['comment']?></textarea>
									</div>

								</div>
								<!-- End Comment  Field -->

								<!-- Start submit  Field -->
									<div class="form-group ">
										<div class="col-sm-offset-2 col-sm-10 col-md-4">
											<input  type= "submit" value="Edit Comment" class="btn btn-primary btn-lg "/>
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

	                  		$comid    =$_POST['comid'];
	                  		$comment  =test_input($_POST['comment']);;

                  		
							
							//Update The Database With This Info?
                  	        $stmt=$con->prepare("UPDATE comments SET comment = ? WHERE c_id= ?");
                  			$stmt->execute(array($comment,$comid));

                  			//ECHO Success Message

                  			
                  			$theMsg="<div class='alert alert-success'>".$stmt->rowCount().'Recored Upadted </div>';
							redirectHome($theMsg,'back',5);

							


                  		


                  	} 

              else{
                 
                 $theMsg= '<div class="alert alert-danger">you  cant  Brows this  page Directly</div>';
               	 redirectHome($theMsg);
               	 
                  		
                 }

                  	echo "</div>";
//=============================================//End Upadate comment//=============================================

//=======================================//Start  the approve  Page==============================================================


    }

    elseif($do == 'Aprrove') {
		echo "<h1 class='text-center'>  activate  Members page</h1>";
        echo "<div class='container'>";	
        //Ckeck IF Get Requst userid is Numeric&Get The Intger Value Of It

		$comid=isset($_GET['comid'])&& is_numeric($_GET['comid'] )? intval($_GET['comid']): 0;
		
		//Select All Depend on this  ID
				$ckeck=ceckItem('c_id','comments',$comid);
		
				
	  
				//if There is  such ID Show The Form
	       if($ckeck>0){

				$stmt=$con->prepare("UPDATE comments SET status =1 WHERE c_id = ?");
				$stmt->execute(array($comid));
                $theMsg= "<div class='alert alert-success'>".$stmt->rowCount().'Comment  Aprroved </div>';
                redirectHome($theMsg,'back');
                  	
                  }else{
                $theMsg= "<div class='alert alert-danger'>"."This  ID is  not Exist ".' </div>';
					redirectHome($theMsg);
                  	
                  }
                  echo "</div>";              }



//=============================================//End approve page//=============================================

//=======================================//Start  the Delete Page==============================================================


    elseif ($do='Delate') {

        echo "<h1 class='text-center'>  Delate  Comment </h1>";
        echo "<div class='container'>";	
        //Ckeck IF Get Requst comid is Numeric&Get The Intger Value Of It

		$comid=isset($_GET['comid'])&& is_numeric($_GET['comid'] )? intval($_GET['comid']): 0;
		
		//Select All Depend on this  ID
				$ckeck=ceckItem('c_id','comments',$comid);
		
				
	  
				//if There is  such ID Show The Form
	    if($ckeck>0){

				$stmt=$con->prepare("DELETE FROM comments WHERE c_id = :zid");
				$stmt->bindParam(":zid",$comid);
				$stmt->execute();
                $theMsg= "<div class='alert alert-success'>".$stmt->rowCount().'Recored Delete </div>';
                redirectHome($theMsg,'back');
                  	
                  }else{
                $theMsg= "<div class='alert alert-danger'>"."This  ID is  not Exist ".' </div>';
					redirectHome($theMsg);
                  	
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