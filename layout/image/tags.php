<?php
ob_start();

 session_start();

include 'init.php';?> 

<?php 

?>

		    <div class="container">
			<div class="row">
			<?php
			if (isset($_GET['name'])&& !is_numeric($_GET['name'] )) 
				{
					echo "<h1 class='text-center'>".$_GET['name']."</h1>";
					$catidid=intval($_GET['name']); 
					$tag=$_GET['name'];
					$TagsItems=getAllFrom("*","items","WHERE tags like'%$tag%' ","","Item_ID","ASC");
					if (!empty($TagsItems)) {
					# code...
				
							foreach ( $TagsItems as $item) {
								echo '<div class="col-sm-6 col-md-3">';
									echo '<div  class="thumbnail item-box">';
									echo '<img  class="img-responsive"src="image.png" alt=""/>';
									echo '<div class="caption">';
										  echo'<span class="price-Tag">'.$item['age'].'</span>';
										  echo'<h3><a href="items.php?itemid='.$item['Item_ID'].'">'.$item['Name'].'</a></h3>';
										  echo '<p>'.$item['Description'].'</p>'; 
										  echo '<div class="date">'.$item['Add_Date'].'</div>'; 

									echo '</div>';
									echo '</div>';

								echo '</div>';

							}
				}else {
					echo  "we  do  not  have  item  in this Category unitl  now  be  the  fiferst  one  to  ADD";
				}
			?>
			</div>
		   </div>




<?php 

}else{
		echo "There is  no  SHAch  id";
}	

include $tpl.'footer.php'; ob_end_flush(); 
?>