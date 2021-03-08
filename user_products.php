<?php include('include/connect.php');
 include('include/session.php'); 
include('function.php');
include('formatMoney.php');
      $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
      $limit = 8;
      $startpoint = ($page * $limit) - $limit;
        
        //to make pagination
        $statement = "`tb_products`";
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
<body  >
  <!-- Navbar
    ================================================== -->
<div class="navbar navbar-fixed-top">
              <div class="navbar-inner">
                <div class="container">
					<a id="logoM" href="user_index.php"><img src="img" alt=""/></a>
                  <a data-target="#sidebar" data-toggle="collapse" class="btn btn-navbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>
                  <div class="nav-collapse">
                    <ul class="nav">
					  <li class=""><a href="user_index.php"><i class="icon-home icon-large"></i> Home</a></li>
					  <li class="active"><a href="user_products.php"><i class=" icon-th-large icon-large"></i>Products</a></li>
					  <li class=""><a href="user_contact.php"><i class="icon-signal"></i> Contact Us</a></li>
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
<!-- ======================================================================================================================== -->	
<div id="mainBody" class="container">

<div class="thumbnail">
<header id="header">
<div class="row">
<div class="span11">
  <a href="user_index.php"><img src="img/logo.jpg" alt=""/></a>
<div class="pull-right"> <br/>
  <a title="Click to view your cart!" href="product_summary.php"> <span class="btn btn-mini btn-warning"> 
    <i class="icon-shopping-cart icon-white"></i> [ 0] </span> </a>
  <a title="Click to view your cart!" href="product_summary.php">
    <span class="btn btn-mini active">R0.00</span></a>
</div>
</div>
</div>
<div class="clr"></div>
</header></div>

<!-- ==================================================Header End====================================================================== -->


  <font color="white"> <font size=><h3> FEATURED MOVIES</h3>
  
  <form method="post">  
<div>
<Center>
<input type="image" title="Search" src="assets/img/search.png" name="submit" alt="Search"/> 
<input type="text" name="search" placeholder="Search for..."> 
</Center>
<br /></div>
</form>

<form method="POST">

  <hr class="soft"/>
  <div class="tab-pane  active" id="blockView">
    <ul class="thumbnails">
    
       <?php
	$key="";
	if(isset($_POST['search']))
		$key=$_POST['search'];
	
	if($key !="")
		$sql_sel=mysql_query("SElECT * FROM tb_products WHERE name  like '%$key%' or price like '%$key%'");
    else if($key !="" )
         $sql_sel=mysql_query("SElECT * FROM tb_products WHERE quantity like '%$key%'");
	else
		 $sql_sel=mysql_query("SELECT * FROM tb_products {$statement} LIMIT {$startpoint} , {$limit}")or die(mysql_error());
       
   while($row=mysql_fetch_array($sql_sel)){
                  $id=$row['productID'];
                  $qty=$row['quantity'];
    ?>
    
      <li class="span3">
        <div class="thumbnail">
        <?php
	if($qty==0){
?>
        <span class="sticker-wrapper top-left">
        <span style="color:red;"><b>SOLD OUT</b>
       <img src="server/ADMIN/SERVER/AS/<?php echo $row['image']; ?>" alt="" style="max-width: 230px; max-height: 250px;"/>
        </span></span>
        
        <?php
	}else{
?>
<img src="server/ADMIN/SERVER/AS/<?php echo $row['image']; ?>" alt="" style="max-width: 180px; max-height: 200px;"/>
<?php
	}
?>
        
        <div class="caption">
          <h5><b><?php echo $row['name']; ?></b></h5>
          <h4><a class="btn btn-success" title="Click to view!" href="user_product_details.php?id=<?php echo $id;?>"><i class="icon-check"></i> View</a> <span class="pull-right">R<?php echo formatMoney($row['price'],2); ?></span></h4>
        </div>
        </div>
      </li>
         <?php } ?>
     
      </ul>
  <hr class="soft"/>
  </div>
<center>

    <?php
  echo pagination($statement,$limit,$page);
?>  

</center>
      <br class="clr"/>


<center>
  <p>Wixstore &copy; 2017  All rights reserved. Accept all major credit and debit cards.<img style="float:right" src="img/visa.png"  height="50" width="50"><img style="float:right" src="img/mastercard.png"  height="50" width="50"><img style="float:right" src="./img/paypal.png"  height="50" width="50"></p> </center>
</footer>

</font>
<hr class="soft">
<div  id="footerSection" class="thumbnail">
  <div class="row">
    <div class="span3">
      <h5><font color="black">Company Address</font></h5>
<b><font color="black"> &nbsp; &nbsp;Main Office</b>:
The company is located at  &nbsp;  Milpark  &nbsp; &nbsp; &nbsp;Next to  the Hollard Building

     </div>

     <div class="span3">
      <h5>Email Address:</h5>   &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;   wixstore@gmail.com<br/>
      <p>   Website:http://wixstore.blogspot.com/  &nbsp;Contact No:(011)/747-6805/747-3642/571-5693/(011)571-5693</p>
     </div></font>
    
    <div id="socialMedia" class="span3 pull-right"></font>    
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <font color="black"><b>SOCIAL MEDIA </b></font><br />
            
      <a href="https://www.facebook.com/WixstoreDVDs"><img width="60" src="assets/img/facebook.png" title="facebook"/></a>
      <a href="#"><img width="60" src="assets/img/twitter.png" title="twitter"/></a>
      <a href="#"><img width="60" src="assets/img/rss.png" title="rss"/></a>
      <a href="#"><img width="60" src="assets/img/youtube.png" title="youtube"/></a>
     </div> 
   </div><center>
   
  

   
    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
    <script src="assets/js/jquery.js"></script>
  <script src="assets/js/google-code-prettify/prettify.js"></script>
    <script src="assets/js/application.js"></script>
    <script src="assets/js/bootstrap-transition.js"></script>
    <script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <script src="assets/js/bootstrap-button.js"></script>
    <script src="assets/js/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>
    <script src="assets/js/bootstrap-affix.js"></script>
    <script src="assets/js/jquery.lightbox-0.5.js"></script>
  <script src="assets/js/bootsshoptgl.js"></script>
   <script type="text/javascript">
    $(function() {
        $('#gallery a').lightBox();
    });
    </script>
  </body>
</html></div>
</div>
</body>

