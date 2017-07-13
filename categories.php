<!DOCTYPE html>
<html>
<head>
</head>
<body>



<?php
ob_start();

 session_start();

include 'init.php';?> 

<?php 
if (isset($_GET['pageid'])&& is_numeric($_GET['pageid'] )) 
{
$catidid=intval($_GET['pageid']); 

	
?>


		    <div class="container nav-margin ">

			<?php 

/// here  we select the  Cateories  Name to   print  it  in   THe  Header  of  all  the   Cateories
$AllCats=getAllFrom("*","categories","WHERE ID = $catidid","","ID","DESC");
        foreach ($AllCats as $cat) {
                  $name = $cat['Name'];

        switch ($name) {
            case 'Missing Person':
              $name =lang('MissingPerson');
               break;

              case 'Unidentified Person':
              $name =lang('Unidentified');
                            break;

              case 'Found':
              $name =lang('Found');
                            break;

            default:
              # code...
              break;
          }

			echo '<h1 class="text-center">' .$name. '  </h1>';
			
			}

			
			if ($catidid==1   ) {
				$AllItems=getAllFrom("*","items","WHERE Cat_ID={$catidid} ","","Item_ID","DESC");
			}
			else{
				$AllItems=getAllFrom("*","items","WHERE Cat_ID={$catidid} ","","Item_ID","DESC");}
				if (!empty($AllItems)) {
					# code...
				
							foreach ( $AllItems as $item) {
								echo '<div class="col-sm-6 col-md-3" height="255px" width="415.6px">';
									echo '<div  class="thumbnail item-box " >';
									

		
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
	
		
		
									// Start the image  part   in the Catories
		if (!empty($item['Image'])) {
			# code...

		$imagedata = $item['Image'];

		$base64 = 'data:image/jpeg;base64, '.$imagedata;
		?>
		<img  class="  img" src="<?PHP  
              ECHO $base64 ?>" alt=""  width="219.63px" max-height="225px"/>

		<?php
		}else{
			echo '<img class="" src="image.png" alt >';
		}
				// end the image  part  the Catories
									echo '<div class="caption"> ';
										  echo'<span class="price-Tag"> '.$item['age'].' </span>';
										  echo '<div class="date">'.$item['Add_Date'].'</div>'; 
										  echo'<h3><a href="items.php?itemid='.$item['Item_ID'].'">'.$item['Name'].'</a></h3>';


										  echo '<p>'.$item['Description'].'</p>'; 

									echo '</div>';
									echo '</div>';

								echo '</div>';

							}
				}else {
					

					echo"<div class='alert alert-info text-center'>".lang('nothaveanyiteminthisCategory')."</div>";
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




<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
</body>
</html>
