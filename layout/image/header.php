<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8"/>


	
<link rel="stylesheet"  href="<?php echo $css; ?>bootstrap.min.css"/>
<link rel="stylesheet"  href="<?php echo $css; ?>font-awesome.min.css"/>
<link rel="stylesheet"  href="<?php echo $css; ?>jquery-ui.css"/>
<link rel="stylesheet"  href="<?php echo $css; ?>jquery.selectBoxIt.css"/>


<link rel="stylesheet" href="<?php echo $css; ?>frontend.css"/> 
<link rel="stylesheet" href="<?php echo $css; ?>style.css"/> 
<title>Search With Me</title>
</head>
<body> 

<div class="navbar-fixed-top ">
<div class="upper-bar ">
  <div class="container">
<!---Start of the  method to the  user name  and  to  hide  the Login  form  if  he  is logedin -->
    <?php if(isset($_SESSION['user'])){ 
        
// Start the image  part   in the Catories
    
      $stmt=$con->prepare("SELECT 
                                  *
                 FROM 
                      users 
                 where 
                       Email = ? 
                  
                    
        
                     ");
      $stmt->execute(array($_SESSION['user']));
      $Get=$stmt->fetch();
    if (!empty($Get['image'])) {
      # code...
    $imagedata = $Get['image'];

    $base64 = 'data:image/jpeg;base64, '.$imagedata;
    ?>
    <img  class="myimg img-circle" src="<?PHP  
              ECHO $base64 ?>" alt="" max-hight="30px" max-wdith="30px"  style="height: 30px;width: 30px;"/>

    <?php
    }else{
      echo '<img  class="myimg img-circle"src="image.png" alt=""/>';
    }
        // end the image  part  the Catories
?>
    <div class="btn-group my-info">

      <span class="btn dropdown-toggle" data-toggle="dropdown">
          <?php echo $Get['Username'];?>
          <span class="caret"></span>
          </span>
          <ul class="dropdown-menu">
              <li><a href="profile.php"><?php echo lang('MyProfile')?></a></li>
             
              <li><a href="profile.php#myad"><?php echo lang('myItem')?></a></li>
              <li><a href="LogOut.php"><?php echo lang('Logout')?></a></li>

          </ul>
 

      
    </div>

    
        <a  href="newad.php"><?php echo lang('NewAd')?>   </a>

        <div  class="pull-right ens" >
            <a   href="<?php echo $_SERVER['PHP_SELF'] ;?>?lang=ar">   AR </a> |
            <a " href="<?php echo $_SERVER['PHP_SELF'] ;?>?lang=en">    EN </a>
        </div>
    
    <?php 
      
      $UserStatus= checkUserStatus($sessionuser);
      if ($UserStatus==1) {
        
        # User  is  not  active 
      }
        
    }else{
    ?>

<a href="login.php">
  
  <span class="pull-right"><?php echo lang('Login/Signup')?></span>
</a>

<a  href="<?php echo $_SERVER['PHP_SELF'] ;?>?lang=ar"> Ar </a>|
<a href="<?php echo $_SERVER['PHP_SELF'] ;?>?lang=en"> En </a>

    <?php




     }





     ?>



<!---Start of the  method to the  user name  and  to  hide  the Login  form  if  he  is logedin -->


 

  </div>
</div>
<!--   Nave Bar !-->
<nav class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    <a  href="index.php"> <img src="layout\image\logo.png" style="height: 55px;"> </a>
    </div>

  <div class="collapse navbar-collapse" id="app-nav">
    <ul class="nav navbar-nav navbar-right">

      <?php  
        $AllCats=getAllFrom("*","categories","WHERE parent =0","","ID","ASC");

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
        echo '<li >
                   <a href="categories.php?pageid='.$cat['ID'].'">
                        '.$name.'
                        </a>
              </li>';
        }
      ?>


      </ul>
      
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav> </div>