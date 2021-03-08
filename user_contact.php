<?php include('include/connect.php');
 include('include/session.php');
 function formatMoney($number, $fractional=false) {
                if ($fractional) {
                  $number = sprintf('%.2f', $number);
                }
                while (true) {
                  $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
                  if ($replaced != $number) {
                    $number = $replaced;
                  } else {
                    break;
                  }
                }
                return $number;
              } 

 
 
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
					<a id="logoM" href="user_index.php"><img src="" alt=""/></a>
                  <a data-target="#sidebar" data-toggle="collapse" class="btn btn-navbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>
                  <div class="nav-collapse">
                    <ul class="nav">
					 <li class=""><a href="user_index.php"><i class="icon-home icon-large"></i> Home</a></li>
					  <li class=""><a href="user_products.php"><i class=" icon-th-large icon-large"></i> Movies</a></li>
					  <li class="active"><a href="user_contact.php"><i class="icon-signal"></i> Contact Us</a></li>
                      <li class=""><a href="user_aboutus.php"><i class="icon-flag"></i> About Us</a></li>
               <li class=""><a href="user_order.php"><i class="icon-shopping-cart"></i> Ordered Products</a></li>
               <li class=""><a href="Email.php"><i class="icon-envelope"></i> Email</a></li>
        
					</ul>
                   
                    <ul class="nav pull-right">
                      <li>
						<a href="user_account2.php"><?php $query = mysql_query("select * from customers where CustomerID='$ses_id'") or die(mysql_error());
                $row = mysql_fetch_array($query);
                $id = $row['CustomerID']; ?> <b>Welcome!  </b> <?php echo $row['Firstname'];?> <?php echo $row['Lastname'];?> <span class="badge badge-info"> <?Php include('announce.php');?></span></a>
					</li>
				
					<li>
						<a href="logout.php"><i class="icon-off"></i> Log Out</a>
					</li>
					</ul>
                  </div><!-- /.nav-collapse -->
                </div>
              </div><!-- /navbar-inner -->
            </div>
	
<div id="mainBody" class="container"><div class="thumbnail">
<header id="header">
<div class="row">
<div class="span11">
	<a href="user_index.php"><img src="img/logo.jpg" alt=""/></a>
<div class="pull-right"> <br/>
	<a title="Click to view your cart!" href="product_summary.php"> <span class="btn btn-mini btn-warning"> 
		<i class="icon-shopping-cart icon-white"></i> [ 1] </span> </a>
	<a title="Click to view your cart!" href="product_summary.php">
		<span class="btn btn-mini active">00.00</span></a>
</div>
</div>
</div>
<div class="clr"></div>
</header><center><a href="maps.php"><h2>Click here!</h2> LOCATION OF THE COMPANY, <b>MAP</b></a></center></div>

<br />
		<div class = "jumbotron">
	<ol><b><align = "center"> For more comments and suggestions, contact us at: </align><ol></b>
	<br/>
	<p>The company is located at Owl Empire Street in Milpark next to the Hollard Building</p>
	<p>Email Address: sales@wixstores.com</p>
	<p>Website: http://wixstores.blogspot.com</p>
    <p>https://www.facebook.com/wixstore</p>
	<p>Contact No:  (27)/747-6805/747-3642</p>
		
	
	</div>

<hr class="soft">
<div class="thumbnail"  id="footerSection">
<marquee><b></b></marquee></body></div></div>

 <hr class="soft">
  <p class=""><marquee><font color="white">Wixstore &copy; 2017  All rights reserved. Accept all major credit and debit cards.</font></marquee></p>
  </div><!-- /container --></center>
  <footer class="container-fluid text-center">
  <center>
  <p>Wixstore &copy; 2017  All rights reserved. Accept all major credit and debit cards.<img style="float:right" src="img/visa.png"  height="50" width="50"><img style="float:right" src="img/mastercard.png"  height="50" width="50"><img style="float:right" src="./img/paypal.png"  height="50" width="50"></p> </center>
</footer>
	

