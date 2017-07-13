<nav class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="dashbord.php"><?php echo lang('HOME_ADMIN')?></a>
    </div>

  <div class="collapse navbar-collapse" id="app-nav">
    <ul class="nav navbar-nav">
      <li ><a href="catageiers.php"><?php echo lang('Categories')?></a></li>
      <li ><a href="iteme.php"><?php echo lang('Post')?></a></li>
      <li ><a href="members.php"><?php echo lang('MEMBERS')?></a></li>
      <li ><a href="comments.php"><?php echo lang('COMMENTS')?></a></li>
      



      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ibrhem <span class="caret"></span></a>
          <ul class="dropdown-menu">
          <li><a href="../index.php">Vist  Shop</a></li>
            <li><a href="members.php?do=Edit&userid=<?php echo $_SESSION['ID']?>">Edit</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="LogOut.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>