<?php 
ob_start();
session_start();

include 'init.php';

$pageTitle=lang('Home Page');



     ?>
     <div  class="slideShow">
     	
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>

  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner  " style="max-height: 650px;">
    

    <div class="item active">
      <img src="layout/image/1.jpg" alt="Chicago">
    </div>
<div class="item">
      <img src="layout/image/6.jpg" alt="Chicago">
    </div>
    <div class="item">
      <img src="layout/image/3.jpg" alt="New York">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only"><?php echo lang("Previous")?></span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only"><?php echo lang("Next")?></span>
  </a>
</div></div>

<section class="about text-center">
            <div class="container">
                  <span class="ggg"><img class="rrr" src="layout/image/logo.png" style="height: 100px;" ></span>
                          <h1 class="mam"> <span class="world-loss1">  <?php echo lang("why")?> </span></h1>
                                       
                <div class="loss-p">
	             
					

	            	<P class="lead"><?php echo lang("thi-p")?>
				    </P>
			   	</div>

            </div>
        </section>

<div class="container item-margin">
	<div class="row ">










	<?php
	$AllItems=getAllFrom('*','items','','','Item_ID','DESC  LIMIT 4');
		foreach ( $AllItems as $item) {
			echo '<div class="col-sm-6 col-md-3  col-xs-12" >';
				echo '<div  class="thumbnail ">';
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
				// Start the image  part   in the profile
		if (!empty($item['Image'])) {
			# code...
			$imagedata = $item['Image'];

		$base64 = 'data:image/jpeg;base64, '.$imagedata;
		?>
		<img  class="img-responsive img  " src="<?PHP  
              ECHO $base64 ?>" alt=""  width="252px" height="242px"/>

		<?php
		}else{
			echo '<img class="img-responsive img " src="image.png" alt width="252px" height="242px">';
		}
				// end the image  part  the profile
				echo '<div class="caption">';
					  echo'<span class="price-Tag">'.$item['age']." Y".'</span>';
					  echo'<h3><a href="items.php?itemid='.$item['Item_ID'].'">'.$item['Name'].'</a></h3>';
					  echo '<p>'.$item['Description'].'</p>'; 
					  echo '<div class="date">'.$item['Add_Date'].'</div>'; 

				echo '</div>';
				echo '</div>';

			echo '</div>';

		}

	?>
	</div>






<!-- team-->



</div>

       <section class="our_team text-center">
		    <div class="team text-center">
			    <div class="container">
			    <h1><?php echo lang("meat-team")?></h1>
				    <div class="row TEAM_MEAT">

				    <div class="col-lg-12 col-sm-6 col-xs-8 ">
						    <div class="person">
						    <img  class="img-circle" src="layout\image\18052721_1389164077809630_590196768_n.jpg" alt="Untitled-2.jpg">
							    <h3><?php echo lang("Ibrahem")?></h3>
							    <p class="font"><?php echo lang("d-Ibrahem")?> </p>

							 <a href="https://www.facebook.com/alaamslm2" target="_blank">  <i class="fa fa-facebook-official fa-lg"></i></a>

						    </div>
					    </div>
					      <div class="col-lg-3 col-sm-6  col-xs-8 text-center">
                                                       
						  <div class="person">
						    <img class="img-circle" src="layout\image\kklllkkjjjhhhh.jpg" alt="Untitled-3.jpg">
							  <h3><?php echo lang("Islam")?></h3>
						    <p class="font"><?php echo lang("d-Islam")?></p>

						    <a href="https://www.facebook.com/islam.mamdouh.779" target="_blank">  <i class="fa fa-facebook-official fa-lg"></i></a>

							  
						  </div>
					    </div>
					    
					          
					    <div class="col-lg-3 col-sm-6 col-xs-8">
						    <div class="person">
						    <img class="img-circle" src="layout\image\jkkkjhhggffddss.jpg" alt="Untitled-5.jpg">
							    <h3><?php echo lang("Kerolos")?></h3>
						    <p class="font"><?php echo lang("d-Kerolos")?></p>
							 
							<a href="https://www.facebook.com/koko.magdy.967" target="_blank">  
							<i class="fa fa-facebook-official fa-lg"></i></a>

						  </div>
					    </div>
					      

					             <div class="col-lg-3 col-sm-6 col-xs-8">
                                            	    <div class="person">
						    <img  class="img-circle" src="layout\image\hhhhhhjkkl;l;.jpg" alt="Untitled-2.jpg">
							    <h3><?php echo lang("Mohammed")?></h3>
                                                     <p class="font"><?php echo lang("d-Mohammed")?></p>
							<a href="https://www.facebook.com/bin.atta" target="_blank">  
							<i class="fa fa-facebook-official fa-lg"></i></a>

						    </div>
					    </div>
					 
                        <div class="col-lg-3 col-sm-12  col-xs-8">
						 <div class="person">
						    <img  class="img-circle" src="layout\image\eeeerrr.jpg" alt="Untitled-4.jpg">
							 <h3><?php echo lang("Yehia")?></h3>
							    <p class="font"><?php echo lang("d-Yehia")?></p>
							   <a href="https://www.facebook.com/yehiaaa.ahmed" target="_blank">  
							<i class="fa fa-facebook-official fa-lg"></i></a>

							 
						    </div>   
					    </div>
				    </div>
			    </div>
		    </div>
	    </section>

    <section class="contact-us ">    
	    <div class="failds">
		    <div class="container text-center">
			    <div class="row">
                  <i class="fa fa-headphones fa-5x"></i>
	          <h1><?php echo lang("tell")?></h1>
			    <p class="lead1"><?php echo lang("count-us")?></p>
			    <form role="form">
			    <div class="col-md-6">
				    <div class="form-group">
					    <input type="text" class="form-control input-lg" placeholder="<?php echo lang("sander")?>">
				    </div>
				    
			    <div class="form-group">
					    <input type="text" class="form-control input-lg" placeholder="<?php echo lang("email")?>">
				    </div>
	
		    <div class="form-group">
					    <input type="text" class="form-control input-lg" placeholder="<?php echo lang("phone")?>ر">
				    </div>
				    </div>
				    
				    <div class="col-md-6">				    
				    <div class="form-group">
					    <textarea class="form-control input-lg" placeholder="<?php echo lang("subj")?>"></textarea>
				    </div>

					   	    <button type="button" class="bt btn-primary btn-lg btn-block"><?php echo lang("send")?></button>
				    </div>
				    </form>
			    </div>
		    </div>
		    </div>
	    </section>

	         <!--start section ultimate footer -->
	   
             <section class="footer">
		    
				    
		    <div class="copyright text-center " style="color: #fff ;font-size: 20px";  >

		    <?php echo lang("copyright")?>
		    </div>

	    </section>
	    
   <!--end section ultimate footer -->
<?php
include $tpl.'footer.php';
ob_end_flush();
?>