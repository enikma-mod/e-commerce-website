<?php include('include/connect.php');
include('formatMoney.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="img/logo.jpg">

    <title>Wixstore</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

	<!-- Less styles  
	<link rel="stylesheet/less" type="text/css" href="less/bootsshop.less">
	<script src="less.js" type="text/javascript"></script>
	 -->
	 
    <!-- Le styles  -->
  <link href="assets/css/bootstrap.css" rel="stylesheet"/>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet"/>
	<link href="assets/css/docs.css" rel="stylesheet"/>
	 
    <link href="assets/style.css" rel="stylesheet"/>
	<link href="assets/js/google-code-prettify/prettify.css" rel="stylesheet"/>

	
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
     <style>
   body {
    background-image: url("pop.JPG");
    background-repeat: no-repeat;
}
</style>
    <!-- Le fav and touch icons -->
 </head>
<body>
  <!-- Navbar
    ================================================== -->
<div class="navbar navbar-fixed-top">
              <div class="navbar-inner">
                <div class="container">
					<a id="logoM" href="index.html"></a>
                  <a data-target="#sidebar" data-toggle="collapse" class="btn btn-navbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>
                  <div class="nav-collapse">
                    <ul class="nav">
					  <li ><a href="index.php"><i class="icon-home icon-large"></i> Home</a></li>
            <li class="active"><a href="products.php"><i class=" icon-th-large icon-large"></i> Products</a></li>
            <li><a href="contact.php"><i class="icon-signal"></i> Contact Us</a></li>
            <li><a href="aboutus.php"><i class="icon-flag"></i>  About Us</a></li>
             <li><a href="server/index.php"><i class="icon-user"></i> Administrator  </a></li>
                    
					</ul>
                   
                    <ul class="nav pull-right">
					<li class="dropdown">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">Sign in <b class="caret"></b></a>
						<div class="dropdown-menu">
							 <?php
                            if (isset($_POST['submit'])) {
                            function clean($str) {
                            $str = @trim($str);
                            if (get_magic_quotes_gpc()) {
                            $str = stripslashes($str);
                            }
                            return mysql_real_escape_string($str);
                            }                                       
                            $email = clean($_POST['email']);
                           $password=clean($_POST['password']);
                           $pass=md5($password);
                            
                            
                            $query = mysql_query("select * from tb_customer where Email='$email' and Password='$pass' ") or die(mysql_error());
                            $count = mysql_num_rows($query);
                            $row = mysql_fetch_array($query);
                            if ($count > 0) {
                            session_start();
                            session_regenerate_id();
                            $_SESSION['id'] = $row['customerID'];
                            $memid=$row['customerID'];
                            header('location:user_index.php');
                            session_write_close();


                       } else {
                        session_write_close();
                           ?>
                 <script type="text/javascript">
                  alert("Invalid Username or Password");
                      </script>
                     <?php }
               }
       ?>
						<form class="form-horizontal loginFrm" method="post">
						  <div class="control-group">								
							<input type="text" class="span2" name="email" id="inputEmail" placeholder="Email">
						  </div>
						  <div class="control-group">
							<input type="password" class="span2" name="password" id="inputPassword" placeholder="Password">
						  </div>
						  <div class="control-group">
							<button type="submit" name="submit" class="btn pull-right">Sign in</button>
                            <left><a href="forgotpass.php"><font color="blue">forgot password</font></a></left>
						  </div>
					
						</form>					
						</div>
					</li>
					<li>
						<a href="register.php">Sign up</a></a>
					</li>
					</ul>
                  </div><!-- /.nav-collapse -->
                </div>
              </div><!-- /navbar-inner -->
            </div>
<!-- ======================================================================================================================== -->	


<div id="mainBody" class="container"><div class="thumbnail">
<header id="header">
<div class="row">
<div class="span12">
  <a href="index.php"><img src="img/logo.jpg" alt=""/></a><embed src="img/cart.gif" class="pull-right"></embed></div> </div>

<!-- ==================================================Header End====================================================================== -->
<font color="white">
<br/>
    <ul class="breadcrumb">
    <li><a href="index.php">Home</a> <span class="divider">/</span></li>
    <li><a href="products.php">Products</a> <span class="divider">/</span></li>
    <li class="active">product Details</li>
    </ul> 
  <div class="row">  
  <?php 
$id=$_GET['id'];
$query=mysql_query("select * from tb_products where productID='$id'") or die (mysql_error());
$row=mysql_fetch_array($query);
?> 
      <div id="gallery" class="span3">
        <img src="server/ADMIN/SERVER/AS/<?php echo $row['image'];?>" width="100%" alt=""/>
        
      </div>
     
        <h3>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['name'];?></h3>
        <hr class="soft"/>
        <form class="form-horizontal qtyFrm">
          <div class="control-group">
          <label class="control-label"><span>&nbsp;Price: R<?php echo formatMoney($row['price'],2);?></span></label>
          <br /><br /><br /><br /> <a href="products.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" class="span2 btn-success large" value="Back"/></a>
          </div>
        </form>
        
        <hr class="soft"/>
        
        
<?php  $qty=$row['quantity'];?> 
        
        
        <?php
	if ($qty==0){
?>
     <h4><span style="color:red;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sold Out</span></h4>   
<?php
	}else{
	   ?>
       <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['quantity'];?> items in stock</h4>
       <?php 
	}
?>
  
        <hr class="soft clr"/>
        <p>
        <?php echo $row['details'];?>
        </p>
        </div>
<!-- Footer ------------------------------------------------------ -->
<hr class="soft">
<div class="thumbnail" id="footerSection">
	<?php include('footer2.php');?>
    </div></div></body></font>
 <hr class="soft">
  <p class=""><marquee><font color="black"></font></marquee></p>
  </div><!-- /container --></center>
  <footer class="container-fluid text-center">
  <center>
  <p>Wixstore &copy; 2017  All rights reserved. Accept all major credit and debit cards.<img style="float:right" src="img/visa.png"  height="50" width="50"><img style="float:right" src="img/mastercard.png"  height="50" width="50"><img style="float:right" src="./img/paypal.png"  height="50" width="50"></p> </center>
</footer>

