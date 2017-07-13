<?php ob_start();

session_start();
include 'init.php'; 

$pageTitle=lang('Showitems');



//Ckeck IF Get Requst item is Numeric&Get The Intger Value Of It
if (isset($_SESSION['user'])) {

$do=isset($_GET['do'])?$_GET['do']:'Manage';

		
if ($do=='Manage') { 

$itemid=isset($_GET['itemid'])&& is_numeric($_GET['itemid'] )? intval($_GET['itemid']): 0;
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

//if There is  such ID Show The Form

?>
<h1 class="text-center"><?php echo $item['Name']?></h1>

<div class="contaner itempage">
	<div class="row">
		<div class="col-md-3 ">
		<?php

		
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
	
		?>

<?php 
		// Start the image  part   in the profile
		if (!empty($item['Image'])) {
			# code...
		$imagedata = $item['Image'];

		$base64 = 'data:image/jpeg;base64, '.$imagedata;
		?>
		<img  class="img-responsive img-thumbnail center-block" src="<?PHP  
              ECHO $base64 ?>" alt="" height="252.5" width="300.34"/>




		<?php
		}else{
			echo '<img class="img-responsive" src="image.png" alt>';
		}
				// end the image  part  the profile
		?>
		<?php 	if ($_SESSION['uid'] == $item['Member_ID']){
			echo lang('theowner');
		$Username=$con->prepare("SELECT 
	                           *
						 FROM 
							   items 
	 					 where  Cat_ID  !=? and Item_ID=?
	 					  ");
	
	$Username->execute(array(3,$itemid));
	
	$contUser=$Username->rowCount();


	if ($contUser >0) {
			
			?>
		<form action="<?php echo  $_SERVER['PHP_SELF'].'?do=UPDATE&itemid='.$itemid?>" method="post">
					<?php echo lang('foundhim')?>
				<input type="checkbox" name="found" value="Yes" />
				<input  class="btn btn-success" type="submit" name="formSubmit" value="Submit" />
			 </form>
	<?php

}}?>


		</div>


		



		<div class="col-md-9 item-info">
			<h2><?php echo  $item['Name']?></h2>
			<p><?php echo  $item['Description']?></p>
		    <ul class="list-unstyled">

				<li>
					<i class="fa fa-calendar fa-fw"></i>
					<span><?php echo lang('AddDate:')?></span><?php echo  $item['Add_Date']?>
				</li>
				<li>
					<i class="fa fa-birthday-cake fa-fw"></i>
					<span><?php echo lang('age')?></span><?php echo  $item['age']?>
				</li>
				<li>
					<i class="fa fa-user fa-fw"></i>
					<span><?php echo lang('gander')?></span><?php echo  $item['gander']?></a>
				</li>
				<li>
					<i class="fa fa-user fa-fw"></i>
					<span><?php echo lang('LostRelationship:')?></span><?php echo  $item['Lost_Relationship']?></a>
				</li>
				

				<li>
					<i class="fa fa-building fa-fw"></i>
					<span><?php echo lang('Addres:')?></span><?php echo  $item['Addres']?>
				</li>

				<li>
					<i class="fa fa-building fa-fw"></i>
					<span><?php echo lang('country')?></span><?php echo  $item['Country_Made']?>
				</li> 

				<li>
				

				<li>
					<i class="fa fa-tags fa-fw"></i>
					<span><?php echo lang('category:')?></span><a href="categories.php?pageid=<?php echo $item['Cat_ID']?>"><?php echo  $item['category_name']?></a>
				</li>
				<li>
					<i class="fa fa-user fa-fw"></i>
					<span><?php echo lang('AddBy:')?></span><a href="profile.php?Member_ID=<?php echo $item['Member_ID']?>"><?php echo  $item['Username']?></a>
				</li>
				
					
				<li class='tags-items'>
					<i class="fa fa-user fa-fw"></i>
					<span ><?php echo lang('tags:')?></span>
					<?php 
							$allTags=explode(',',$item['tags']) ;


							foreach ($allTags as $tag) {
								$tag=str_replace(' ', '', $tag);
								$taglowwe=strtolower($tag);
								if (!empty($tag))
								{
									echo "<a  href='tags.php?name={$taglowwe}'>".$tag."</a>";
								}else{
									echo lang('noTage'); 
								}
								}

								?>
				</li>
		    </ul>



		</div>
	</div>

<!---->

<?php


		
	

?>


<!---->
	<hr class="custom-hr">
	<!-- Start  Add Comment -->
	<?php if(isset($_SESSION['user'])){?>
	<div  class="row">
		<div class="col-md-offset-3">
			<div class="add-comment">
			<h3><?php echo lang('AddYourComment'); ?> </h3>
			<form action="<?php echo  $_SERVER['PHP_SELF'].'?itemid='.$item['Item_ID']?>" method="POST">
				 <textarea name="comment" required ></textarea>
				 <input class="btn btn-success" type="submit" value="<?php echo lang('AddComment')?>">
		    </form>
		    <?php if($_SERVER['REQUEST_METHOD']=='POST'){

		    	$comment=filter_var($_POST['comment'],FILTER_SANITIZE_STRING);
		    	$itema_id=$item['Item_ID'];
		    	$user_id=$_SESSION['uid'];
		    	if (!empty($comment)) {

		    		$stmt=$con->prepare("INSERT INTO 
		    			  comments(comment,status,comment_data,item_id,userid)
		    			  VALUES(:zcomment,0,NOW(),:zitemid,:zuserid)");
		    		$stmt->execute(array(
		    							 'zcomment'=>$comment,
		    							 'zitemid'=>$itema_id,
		    							 'zuserid'=>$user_id
		    							 ));
		    		if ($stmt) {
		    			echo '<div class="alert alert-success">'.lang('CommentAddded').'</div>';
		    		}
		    	}else{
		    			echo '<div class="alert alert-danger"> '.lang("youmust").'</div>';

		    		}

		    }?>
		</div>
		</div>
	</div>
	<?php }else{
		echo  '<a  href="login.php">login </a>or <a  href="login.php">'.lang("rgisterto").' </a>  ';
	}?>
		<!-- End  Add Comment -->

	<hr class="custom-hr">
	<?php

					$stmt=$con->prepare("SELECT 
											comments.*,users.Username as member
									 FROM
									 	    comments
									 
									 INNER JOIN
									 		users
									 ON
									 		users.UserID=comments.userid
									 WHERE 
									 		item_id=?
									 

									ORDER BY 
									 		c_id  DESC	
									  ");
				$stmt->execute(array($item['Item_ID']));
				$comments=$stmt->fetchAll();
				
			?>		

	
		<?php
			foreach ($comments as $coment ){?>
			<div  class="comment-box">
				<div class="row">
						<div class="col-sm-2 text-center">
<?php


$stmt=$con->prepare("SELECT 
                                  image 
                 FROM 
                      users 
                 where 
                       UserID = ? 
                  
                    
        
                     ");
      $stmt->execute(array($coment['userid']));
      $Get=$stmt->fetch();
    if (!empty($Get['image'])) {
// Start the image  part   in the profile
		
			# code...
		$imagedata = $Get['image'];

    $base64 = 'data:image/jpeg;base64, '.$imagedata; 
		?>
		<img  class="img-responsive img-thumbnail   img-circle" src="<?PHP  
              ECHO $base64 ?>" alt="" max-hight="30px"/>

		<?php
		}else{
			echo '<img class="img-responsive" src="image.png" alt>';
		}
				// end the image  part  the profile

		 echo $coment['member'];?>
						</div>
						<div class="col-sm-10 lead"><?php echo  $coment['comment'];?></div>
			 	</div>
			</div>
				<?php }

		?>

		
	</div>
</div>
<hr class="custom-hr">
 <?php

}else{
	echo '<div class ="container center">';
	echo  '<div class="alert alert-danger text-center">'.lang("ThereisnosuchID").'</div>';	
	echo '</div">';

}

// if  he  still   not  signIN
}
//
elseif($do == 'UPDATE'){
	  


			

		
		




			if ($_SERVER['REQUEST_METHOD']=='POST'
				&& isset($_POST['found']) 
				&& $_POST['found'] == 'Yes')
			{
				$itemid=isset($_GET['itemid'])&& is_numeric($_GET['itemid'] )? intval($_GET['itemid']): 0;
				$stmt=$con->prepare("UPDATE items SET   Cat_ID=3 WHERE Item_ID=?");
				
				$stmt->execute(array($itemid));
				
				$theMsg="<div class='alert alert-success'>".$stmt->rowCount().lang("RecoredUpadted").'</div>';
				
			}
			?>
			<div class="contaner  text-center">
				<div class=" alert alert-s"> </div>
				';
			<?php 
				$theMsg= '<div class="alert alert-success"> '.lang("stustasfound").'</div>';
				redirectHome($theMsg,'back',1);
}



			

else {echo '
			<div class="contaner  text-center nav-margin">
				<div class=" alert alert-danger"> '.lang("youbrowsthisdir").'   </div>
				';
			header("refresh:2;url=login.php");
	}





}

else{
	
	echo '
			<div class="contaner  text-center nav-margin">
				<div class=" alert alert-danger">'.lang("youbrowsthisdir").'</div>
				';
header("refresh:2;url=login.php");
}
include $tpl.'footer.php';
ob_end_flush(); 

?>