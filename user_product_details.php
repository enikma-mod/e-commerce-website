<?php include('include/connect.php');
include('include/session.php');
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

    <script type='text/javascript'  language="Javascript">

  var qty=document.getElementById('qty').value;
     var qleft=document.getElementById('qleft').value;
  
    function OnChange(value){

    
    if (+qty > +qleft) {
         alert("Order Quantity Exceeds.");
         document.getElementById('qty').value='';
    
  }
  

  
    }

</script>
	
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
 <style>
   body {
    background-image: url("pop.jpg");
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
					  <li class="active"><a href="user_products.php"><i class=" icon-th-large icon-large"></i> Products</a></li>
					  <li class=""><a href="user_contact.php"><i class="icon-signal"></i> Contact Us</a></li>
                      <li class=""><a href="user_aboutus.php"><i class="icon-flag"></i> About Us</a></li>
              <li class=""><a href="user_order.php"><i class="icon-shopping-cart"></i> Ordered Products</a></li>
               <li class=""><a href="Email.php"><i class="icon-envelope"></i> Email Us</a></li>
        
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

<br /><br />

    <ul class="breadcrumb">
    <li><a href="user_index.php">Home</a> <span class="divider">/</span></li>
    <li><a href="user_products.php">Products</a> <span class="divider">/</span></li>
    <li class="active">Product Details</li>
    </ul> 
  <div class="row">  
  <?php 
$id=$_GET['id'];
$query2=mysql_query("select * from tb_products where productID='$id'") or die (mysql_error());
$row2=mysql_fetch_array($query2);
$pid=$row2['productID'];
$qty=$row2['quantity'];
?> 
<font color="white">
      <div id="gallery" class="span3">
        <img src="server/ADMIN/SERVER/AS/<?php echo $row2['image'];?>" width="100%" />
        
      </div>
     
        <h3>&nbsp;&nbsp;&nbsp;<?php echo $row2['name'];?></h3>
        <hr class="soft"/>

        <?php
                                    if (isset($_POST['submit'])) {

                                        $id = $_POST['id'];
                                        $quantity = $_POST['quantity'];
                                         $productID = $_GET['id'];     
                                         $price = $_POST['price'];                                     
                                        $total = $_POST['price'] * $_POST['quantity'];         

                                        $date=date("Y-m-d");

                                       
                         mysql_query("insert into order_details
                          (Orderdetailsid,ProductID,Quantity,Total,CustomerID) values
                  ('$id','$productID','$quantity','$total','$ses_id')") 
                     or die(mysql_error());
                                            ?>

                                         
                                              <script type="text/javascript">
                                                alert("Product added to cart");
                                                    window.location= "user_products.php";
                                            </script>

                                            <?php
                                    }
                                    ?>

        <form class="form-horizontal qtyFrm" method="post">
          <input type="hidden" id="username" name="id" value="<?php
             $id = mysql_query("select MAX(orderdetailsid) as max_orderdetailsid from order_details");                                       
           $row = mysql_fetch_array($id);
             echo $row['max_orderdetailsid'] + 1;                                       
                        ?>" class="input-xlarge" required/>
          <div class="control-group">
          <label><h3><span>&nbsp;&nbsp;&nbsp;Price: R<?php echo formatMoney($row2['price'],2);?></span></h3></label>
			
             <?php 
   $count_query = mysql_query("select * from order_details where customerID='$ses_id' and ProductID='$pid' and orderid=''") or die(mysql_error());
     $count = mysql_num_rows($count_query);
     if($count==0){
      ?>
             <input type="hidden" class="span1" name="price"   value="<?php echo $row2['price'];?>"/>
		
		
    <br />
    <?php
	if ($qty == 0){
?>
    <h4> <span style="color:red;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sold Out</span></h4> 
       <input type="hidden" id='qleft' value="<?php echo $qty;?>">
    <?php
    }else{ 
    ?>
    
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Quantity: 
    <?php
	echo "<select class='span1' name='quantity' id='qty'>";
$i=1; $quant=$qty;
while ($i <= $quant ){
    echo "<option value=".$i.">".$i."</option>";
    $i++;
}
echo "</select>";
?>
    <br />
    <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $qty;?> Items stock</h4> 
       <input type="hidden" id='qleft' value="<?php echo $qty;?>">
       
       <button type="submit" name="submit" class="btn btn-large pull-right"><i class=" icon-shopping-cart"></i> Add to cart</button>
    <?php }
     }
     else{
       ?>
       <span style="color:red;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PRODUCTS ALREADY ADDED TO CART</span>
<?php
     }
   ?>
    
          
          </div>
        </form>
        
     
       
        
        
        
        <hr class="soft clr"/>
        <p>
        <?php echo $row2['details'];?>
        </p>

  </div>

</font>


<hr class="soft">
<div class="well" id="footerSection">
  <div class="row">
    <div class="span3">
      <h5><font color="black">Company Address</font></h5>
<b><font color="black"> &nbsp; &nbsp;Main Office</b>:
The company is located at  &nbsp; &nbsp; Milpark  &nbsp; &nbsp; &nbsp;Next to the Hollard Building

     </div>

     <div class="span3">
      <h5>Email Address:</h5>   &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;   sales@wixstore.com<br/>
      <p>   Website:http://wixstore.blogspot.com/  &nbsp;Contact No:(011)/747-6805/747-3642/571-5693/(011)571-5693</p>
     </div></font>
    
    <div id="socialMedia" class="span3 pull-right"></font>    
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <font color="black"><b>SOCIAL MEDIA </b></font><br />
            
      <a href="https://www.facebook.com/AA2000Enterprises"><img width="60" src="assets/img/facebook.png" title="facebook"/></a>
      <a href="#"><img width="60" src="assets/img/twitter.png" title="twitter"/></a>
      <a href="#"><img width="60" src="assets/img/rss.png" title="rss"/></a>
      <a href="#"><img width="60" src="assets/img/youtube.png" title="youtube"/></a>
     </div> 
   </div><center>
   
   <hr class="soft">
  <p class=""><marquee><font color="black">Wixstore &copy; 2017  All rights reserved. Accept all major credit and debit cards.</font></marquee></p>
  </div><!-- /container --></center>


  
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
</html></div></div>
</body>