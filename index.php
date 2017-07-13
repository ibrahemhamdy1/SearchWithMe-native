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

<div class="container text-center " style="margin-left: 90px;">
	<div class="row ">










	<?php
	$AllItems=getAllFrom('*','items','','','Item_ID','DESC  LIMIT 4');
		foreach ( $AllItems as $item) {
			echo '<div class="col-sm-5 col-md-3  col-xs-12 " >';
				echo '<div  class="thumbnail item-box ">';
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
					  echo '<div class="date">'.$item['Add_Date'].'</div>';
					  echo'<h3><a href="items.php?itemid='.$item['Item_ID'].'">'.$item['Name'].'</a></h3>';
					  echo '<p>'.$item['Description'].'</p>'; 
					   

				echo '</div>';
				echo '</div>';

			echo '</div>';

		}

	?>
	</div>






<!-- team-->



</div>

       <section class="our_team text-center " >
		    <div class="team ">
			    <div class="container" >
			    <h1><?php echo lang("meat-team")?></h1>
				    <div class="row TEAM_MEAT">

						<div class="col-lg-12 col-sm-12 col-xs-12  text-center" >
								<div class="person">
									<img  class="img-circle" src="layout\image\18052721_1389164077809630_590196768_n.jpg" alt="Untitled-2.jpg">
										<h3><?php echo lang("Ibrahem")?></h3>
										<p class="font"><?php echo lang("d-Ibrahem")?> </p>

									<a href="https://www.facebook.com/alaamslm2" target="_blank">  <i class="fa fa-facebook-official fa-lg"></i></a>

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
	          
				<div class="footer-social-icons">
    <h1 class="_14">Follow us on</h1>
    <h2 class="social-icons">
        <a href="" class="social-icon"> <i class="fa fa-facebook  "></i></a>
        <a href="" class="social-icon"> <i class="fa fa-twitter"></i></a>
       <a href="" class="social-icon"> <i class="fa fa-rss"></i></a>
        <a href="" class="social-icon"> <i class="fa fa-youtube"></i></a>
       <a href="" class="social-icon"> <i class="fa fa-linkedin"></i></a>
        <a href="" class="social-icon"> <i class="fa fa-google-plus"></i></a>
    </h21>
</div>
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