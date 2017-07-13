<?php 
session_start();
if (isset($_SESSION['Username'])) {
	$pageTitle='dashbord';

	include "init.php"; 
	$unmUsers=5;
	$latestUsers=getLatest("*","users","UserID",$unmUsers);

	$numItem=6;//Number of Latest Items
	$latestItems =getLatest("*",'items','Item_ID',$numItem);

	$numComments=4; //Number Of Comments

		/*Start Dashbord Page*/	
	?>
<div  class="home-stats">
		<div class="container home-stats text-center">
			<h1>Dashbord<h1>
			<div class="row">
				<div class="col-md-3">
					<div class="stat st-members">
					  	<i class= "fa fa-users"></i>
						
							<div class="info"> 
								Toatl Members
									<span>
										<a href="members.php"><?php echo countItems('UserID','users')?></a>
									</span> 
							
</div>
						
					
					</div>

				</div>
				<div class="col-md-3">
					<div class="stat st-found  ">
									
									<i class="fa fa-user-plus"></i>
									<div class="info">
										found pepole
									
									<span> 
										<?php
										echo  ceckItem("approve","items","found");
										?>

									</span>
									</div>
					</div>
					

				</div>
				<div class="col-md-3">
					<div class="stat st-Items">
						<i class="fa fa-tag"></i>
							<div class ="info">
								Toatl Items
									<span><a href="iteme.php?do=Manage">
									<?php echo countItems('Item_ID','items')?></a>
									</span>
							</div>
					
					</div>
				</div>

			
				<div class="col-md-3">
					<div class="stat st-comments">
						<i class="fa fa-comments"></i>
						<div class="info">
						Toatl Comments
						<span> <a href="comments.php?do=Manage"><?php echo countItems('c_id','comments')?></a></span>
						</div>
					</div>
					

				</div>
				
			</div>

		</div>


<!--Start  the  part  of  the gander -->
<div class="container home-stats text-center">
			
			<div class="row ">
				
				
				<div class="col-md-6">
					<div class="stat st-Items">
						<i class="fa fa-male "></i>
							<div class ="info">
							man
									<span>
									<?php echo countItems('gander','items','man')?>
									</span>
							</div>
					
					</div>
				</div>

			
				<div class="col-md-6">
					<div class="stat st-Items">
						<i class="fa fa-female"></i>
						<div class ="info">
							women
									<span>
									<?php echo countItems('gander','items','women')?></span>
									
							</div>
					</div>
					

				</div>
				
			</div>

		</div>
		<!--End  the  part  of  the gander -->


</div>
	<div class="latest">
			<div class="container ">

				<div class="row ">
					<div class="col-sm-6">
						<div class="panel panel-defult"> 
							<div class="panel-heading">
								<i class="fa fa-users"></i> 
								latest  <?php echo $unmUsers;?>Regesterd Users 
								<span class="toggle-info pull-right">
									<i class="fa fa-plus fa-lg"></i>
								</span>

						</div>
						<div class="panel-body">
							<ul class="list-unstyled latest-users">
							<?php  
							     if (!empty($latestUsers)) {
								 foreach ($latestUsers as $user ) {
										echo '<li>';
										echo $user['Username']."-".$user['user_last_name'] ;
										echo '<a href="members.php?do=Edit&userid=' . $user['UserID'] .'">';
										echo '<span class="btn btn-success pull-right">';
										echo '<i class="fa fa-edit"></i>Edit';
											if ($user['RgSttatus']== 0) {
									   							echo "<a 
									   							href='members.php?do=activate&userid=" .
									   							 $user['UserID'] ."'class='btn btn-info  pull-right '>
									   							 <i class='fa fa-close'></i>activate </a>";

								}
										echo '</span>';
										echo '<li>'; 	


									}
								 }else{
								 	echo 'there is no  recode To  showe';
								  
								 }
							?>
							</ul>
						</div>

					</div>

				</div>
				<div class="col-sm-6">
						<div class="panel panel-defult">
							<div class="panel-heading">
								<i class="fa fa-tag"> Latest <?php echo $numItem ;?> Items 
								 </i>
								<span class="toggle-info pull-right">
									<i class="fa fa-plus fa-lg"></i>
								</span>

						</div>
						<div class="panel-body ">

							<ul class="list-unstyled latest-users">
							<?php  
								if (!empty($latestItems)) {	
								foreach ($latestItems as $items ) {
								  	echo '<li>';
									echo $items['Name'];
									echo '<a href="iteme.php?do=Edit&itemid=' . $items['Item_ID'] .'">';
									echo '<span class="btn btn-success pull-right">';
									echo '<i class="fa fa-edit"></i>Edit';
								if ($items['Approve']== 0) {
				   									echo "<a href='iteme.php?do=Approve&itemid=" .
				   							 		$items['Item_ID'] ."'class='btn btn-info  pull-right '>
				   							 		<i class='fa fa-check'></i>Approve </a>";

								}
										echo '</span>';
										echo '<li>'; 	


									}
						}else{
								echo 'there is no  Item To  showe';
							 }


							?>
							</ul>
						</div>

					</div>

				</div>

			</div>



<!-- ######################################Start lastest Comments ######################################################## -->
				<div class="row ">
					<div class="col-sm-6">
						<div class="panel panel-defult"> 
							<div class="panel-heading">
								<i class="fa fa-comments-o"></i> 
								Latest <?php echo $numComments;?> Comments
								<span class="toggle-info pull-right">
									<i class="fa fa-plus fa-lg"></i>
								</span>

						</div>
						<div class="panel-body">
						<?php
							$stmt=$con->prepare("SELECT 
									comments.*,users.Username as memnber,users.user_last_name  as lastname
							 FROM
							 	    comments
							 
							 INNER JOIN
							 		users
							 ON
							 		users.UserID=comments.userid
							 ORDER BY 
							 		c_id  DESC			
							 Limit  
							 		$numComments 
							 ");
							$stmt->execute();
							$comments=$stmt->fetchAll();

							if (!empty($comments)) {
							
							foreach ($comments as $comment) {
								echo '<div class="comment-box">';
								echo '<span class="member-n <a href="members.php?do=Edit&userid='.$comment['userid'].'"">
										
										'.$comment['memnber']."-".$comment['lastname'].'</a></span>' ;
								echo '<p class="member-c"> '. $comment['comment'].'</p>'; 
								echo "</div>";



							}
						}else{
								echo 'there is no  Comments  To  showe';

						}

						?>
						</div>

					</div>

				</div>
				

			</div>
<!-- ######################################End lastest Comments ######################################################## -->

	</div>
</div>

	<?php
	/*End Dashbord Page*/
include $tpl.'footer.php';
	# code...
}else{
header('Location: index.php'); 
exit();

}

?>