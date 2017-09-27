<?php

session_start();
include 'init.php';
?>

 

<?php
$pageTitle=lang('Login');
if(isset($_SESSION['user'])){
	header('Location: index.php');
}



?>
<div class="container login-page" style="margin-top:70px;">
	<h1 class="text-center">
		<span class="selected " data-class="login"><?php echo lang('Login')?></span>|
		<span data-class="signup"><?php echo lang('signup')?></span>
	</h1>
	<form id="loginform" class="login"   action="checkLogin.php" method="POST" enctype="multipart/form-data" >
		<div class="input-container">
			<input 
				id="emailid"
				class="form-control"
				type="email" 
				name="email" 
				autocomplete="off"
				placeholder="<?php echo lang('palaceHolderforUsername')?>" required="required">
		</div>

		<div class="input-container">
			<input 
				id="password"
				class="form-control" 
				type="password" 
				name="password"
				autocomplete="new-password"
				placeholder="<?php echo lang('palaceHolderforpassword')?>" required="required">
		</div>	
		<input id="login-button"class="btn btn-primary btn-block" type="submit" value="<?php echo lang('Login')?>" name="login">
	</form>



<!-- ############signup#############################################################-->
	<form id="register-form" class="signup"   action="checkSigup.php" method="POST" enctype="multipart/form-data">
		<div id="error">
            </div>
		<div class="input-container">
			<input 
				
				
				class = "form-control"
				type  = "text" 
				name  = "username"
				id    = "username" 
				autocomplete="off"
				placeholder="<?php echo lang('firstname')?>" >
		</div>
		<div class="input-container">
			<input 
				
				
				class="form-control"
				type="text" 
				name="lastname" 
				id="lastname" 
				autocomplete="off"
				placeholder="<?php echo lang('lastname')?>"  >
		</div>




		<div class="input-container">
			<input 
				
				class="form-control"
				type="number" 
				name="Mobile" 
				id="Mobile"
				autocomplete="off"
				placeholder="<?php echo lang('YourMobile')?>"  >
		</div>

		<div class="input-container">
			<input 
				
				class="form-control"
				type="text" 
				name="City" 
				id="City"
				autocomplete="off"
				placeholder="<?php echo lang('YourCity')?> "  >
		</div>

		<div class="input-container">
			<input 
				
				class="form-control"
				type="text" 
				name="addres"
				id="addres"  
				autocomplete="off"
				placeholder="<?php echo lang('Youraddres')?> "  >
		</div>
		



		<div class="input-container">
			<input 
					class="form-control" 
					type="password" 
					name="password"
					id="password"
					autocomplete="new-password"
					placeholder=" <?php echo lang('Complexpassword')?> "  >
		</div>
		<div class="input-container">
			<input 
			
			class="form-control" 
			type="password" 
			name="password2"
			id="password2"
			autocomplete="new-password"
			placeholder=" <?php echo lang('againpassword')?> " >
		</div>
		<div class="input-container">	
			<input 
			class="form-control" 
			type="email" 
			name="email"
			id="email"
			placeholder=" <?php echo lang('validEmail')?>" >
		</div>	

		
<!-- Start image-->
		
	<!-- <input type="file" name="image" id="image">  -->
 <!--End image  -->

		<input  id="signup" class="btn btn-success btn-block"  name="signup" type="submit" value="<?php echo lang('submit')?>">
	</form>


<!-- End  Signup form -->
<!-- start Loading  image -->
<div id="spinner" class="text-center">
      <img src="./layout/image/spinner.gif" width="70" height="70"/>
    </div><!-- end Loading  image -->

<!-- <div id="result" class="the-errors    text-center">
	<?php 
	/* if (!empty( $fromErrors)) {
			foreach ($fromErrors as $error ) {
				echo '<div id="msgerror">'.$error.' </div> ';
			}
	}
	if (isset($successMsg)) {
		echo  '<div Class="msg success">'.$successMsg.'<div>';
	} */
	?>
	</div>
</div> -->
<?php 
include $tpl.'footer.php'?>
<script src="layout/js/script.js"></script>

