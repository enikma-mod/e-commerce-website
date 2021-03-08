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

    <title>Order</title>
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
	 
    <link href="style.css" rel="stylesheet"/>
	<link href="assets/js/google-code-prettify/prettify.css" rel="stylesheet"/>

    <script type='text/javascript'>
function numbers(){

  //var CheckPassword = /^[A-Za-z]\w{7,14}$/; - numbers and characters and uppercase
  var letterexp = /^[a-zA-Z]+$/;
  var quanti = 32; 
  if(document.getElementById('quantity').value.match(letterexp)){
    alert('Please input numbers only');
    document.getElementById('quantity').value='';
  }
  
}


</script>

     <script>
function confirmDelete(delUrl) {
  if (confirm("Are you sure you want to update product status?")) {
   document.location = 'update_stat.php';
  }
}
</script>

    <script src='//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>
  <script src="js/incrementing.js"></script>
	
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
					<a id="logoM" href="user_index.php"></a>
                  <a data-target="#sidebar" data-toggle="collapse" class="btn btn-navbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>
                  <div class="nav-collapse">
                    <ul class="nav">
					    <li class=""><a href="user_index.php"><i class="icon-home icon-large"></i> Home</a></li>
					  <li class=""><a href="user_products.php"><i class=" icon-th-large icon-large"></i> Movies</a></li>
					  <li class=""><a href="user_contact.php"><i class="icon-signal"></i> Contact Us</a></li>
                      <li class=""><a href="user_aboutus.php"><i class="icon-flag"></i> About Us</a></li>
               <li class="active"><a href="user_order.php"><i class="icon-shopping-cart"></i> Ordered Products</a></li>
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

<div id="mainBody" class="container"><div class="well">
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


<?php 
$query3=mysql_query("select * from order_details where customerID='$ses_id' and orderid=''") or die (mysql_error());
$count2=mysql_num_rows($query3);
?>
<font color="black">

<form method="post" action="process_order.php">

  <input type="hidden" id="username" name="id" value="<?php
             $id = mysql_query("select MAX(OrderID) as max_OrderID from orders");                                       
           $row5 = mysql_fetch_array($id);
             echo $row5['max_OrderID'] + 1;                                       
    ?>" class="input-xlarge" required/>


  <h3>  SHOPPING CART [ <b><?php echo $count2;?> </b>]

  </h3>  
  <hr class="soft"/>
  
  <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Date Ordered</th>
                  <th>Total</th>
                  <th>Status</th>
                  <th>Tr. No. </th>
				  <th>Date Paid Confirm</th>
                  <th>Action</th>
        </tr>
              </thead>
              <tbody>
                <?php 
$query=mysql_query("select * from orders where customerID='$ses_id'") or die (mysql_error());
while($row=mysql_fetch_array($query)){
?>
        <tr>

           <td><?php echo $row['OrderID'];?> </td>
           <td><?php echo $row['orderdate'];?> </td>
           <td><?php echo formatMoney($row['total']);?></td>
           <td><?php echo $row['status'];?></td>
           <td><?php echo $row['Transaction_code'];?></td>
		   <td><?php echo $row['Date_paid'];?><td>    
           </font> 
     <?php 
     $stats=$row['status'];

     if ($stats=="Confirmed") {
      ?>
      <a href="official_receipt.php?id=<?php echo $row['OrderID']; ?>"><U>Receipt</U></a>
      <!---------------------their is a receipt--->   
   <?php }else{ ?>
          <a href="official_receipt1.php?id=<?php echo $row['OrderID']; ?>"><font color="red"><U>Receipt</U></font></a></td>
    <?php }
         }    
     ?>

            
        </tbody>
            </table>
    
    
   
</form>
<!--  -->


<hr class="soft">
<div  id="footerSection">
  <div class="row">
    
     </div>

     <div class="span3">
      <h5>INFORMATION:</h5>   sales@wixstores.com<br/>
      <p>   Website: http://wixstores.blogspot.com/  Contact No:(+27)747-6805/747-3642</p>
     </div></font>
    
    <div id="socialMedia" class="span3 pull-right"></font>    
      <font color="black"><b>SOCIAL MEDIA </b></font><br />
            
      <a href="https://www.facebook.com/WixStoreDVDs"><img width="60" src="assets/img/facebook.png" title="facebook"/></a>
      <a href="#"><img width="60" src="assets/img/twitter.png" title="twitter"/></a>
      <a href="#"><img width="60" src="assets/img/rss.png" title="rss"/></a>
      <a href="#"><img width="60" src="assets/img/youtube.png" title="youtube"/></a>
     </div> 
   </div><center>
   
   <hr class="soft">
  <p class=""><marquee><font color="black">THANK YOU FOR SHOPPING WITH Us</font></marquee></p>
  </div><!-- /container --></center>
   <hr class="soft">
  <p class=""><marquee><font color="black"></font></marquee></p>
  </div><!-- /container --></center>
  <footer class="container-fluid text-center">
  <center>
  <p>Wixstore &copy; 2017  All rights reserved. Accept all major credit and debit cards.<img style="float:right" src="img/visa.png"  height="50" width="50"><img style="float:right" src="img/mastercard.png"  height="50" width="50"><img style="float:right" src="./img/paypal.png"  height="50" width="50"></p> </center>
</footer>
  


    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
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
</html>    <script src="docs.min.js"></script>
     
 <script src="jquery.min.js"></script>
    <script src="bootstrap.min.js"></script>
    
  
</body>