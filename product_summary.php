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
					<a id="logoM" href="user_index.php"><img src="" alt=""/></a>
                  <a data-target="#sidebar" data-toggle="collapse" class="btn btn-navbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>
                  <div class="nav-collapse">
                    <ul class="nav">
					 <li class=""><a href="user_index.php"><i class="icon-home icon-large"></i> Home</a></li>
					  <li class=""><a href="user_products.php"><i class=" icon-th-large icon-large"></i> Products</a></li>
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
<div id="mainBody" class="container"><div class="thumbnail">
<header id="header">
<div class="row">
<div class="span11">
  <a href="user_index.php"><img src="img/logo.jpg" alt=""/></a>
<div class="pull-right"> <br/>
  <a title="Click to view your cart!" href="product_summary.php"> <span class="btn btn-mini btn-warning"> 
    <i class="icon-shopping-cart icon-white"></i> [ 2] </span> </a>
  <a title="Click to view your cart!" href="product_summary.php">
    <span class="btn btn-mini active">R0.00</span></a>
</div>
</div>
</div>
<div class="clr"></div>
</header></div><font color="white">

<?php 
$query3=mysql_query("select * from order_details where CustomerID='$ses_id' and orderid=''") or die (mysql_error());
$count2=mysql_num_rows($query3);
?>


<form method="post" action="payment_details.php">


    
  <input type="hidden" id="username" name="id" value="<?php
             $id = mysql_query("select MAX(OrderID) as max_OrderID from orders");                                       
           $row5 = mysql_fetch_array($id);
             echo $row5['max_OrderID'] + 1;                                       
    ?>" class="input-xlarge" required />




  <h3>  SHOPPING CART [ <small><?php echo $count2;?> </small>]

  </h3>  
  <hr class="soft"/>
  
  <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Description</th>
                  <th  width="100">Quantity/Update</th>
                  <th  width="80">Price</th>
                  <th width="80">Total</th>
                  <th width="100">Action</th>
        </tr>
              </thead>
              <tbody>
                <?php 
$query=mysql_query("select * from order_details where CustomerID='$ses_id' and Orderid=''") or die (mysql_error());
while($row=mysql_fetch_array($query)){
$count=mysql_num_rows($query);
$pid=$row['ProductID'];

$query2=mysql_query("select * from tb_products where productID='$pid'") or die (mysql_error());
$row2=mysql_fetch_array($query2);

?>
        <tr>


                  <td> <img width="60" src="server/ADMIN/SERVER/AS/<?php echo $row2['image'];?>" alt=""/></td>
                  <td><b><?php echo $row2['name'];?></b><br/><br/>
                    <?php $string=$row2['details'];

$string = strip_tags($string);

if (strlen($string) > 100) {

    // truncate string
    $stringCut = substr($string, 0, 100);

    // make sure it ends in a word so assassinate doesn't become ass...
    $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="user_product_details.php?id='.$pid.'"><span style="color:red">Read More</span></a>'; 
}
echo $string;

                    ?></td>
          <td>
      <div class="input-append">
        <center>
        <input class="span1" name="update" style="max-width:100px" placeholder="1" id="french-hens" size="16" type="text" value="<?php echo $row['Quantity'];?>" readonly/>
        </center>
    </div>


          </td>
                  <td><?php  echo formatMoney($row2['price'],2); ?></td>
                  <td><?php echo formatMoney($row['Total'],2);
                            echo'<input type="hidden" name="price" value="'.$row['Total'].'">';
                  ?></td>


                  <td>     
   <a href="delete_order_details.php?id=<?php echo $row['Orderdetailsid'];?>" ><button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')" type="button"><i class="icon-remove icon-white"></i></button></a>
     <a href="edit_order_details.php?id=<?php echo $row['Orderdetailsid'];?>" ><button class="btn" type="button"><i class="icon-edit icon-red"></i></button></a>
  

    </td>
    <?php } ?>

                </tr>
        
              
         <tr>
       
                  <td colspan="5" align="right"><strong>TOTAL=</strong> </td>
                  <td class="label label-important"> <strong>
                     <?php
          $result5 = mysql_query("SELECT sum(total) FROM order_details WHERE CustomerID='$ses_id' and OrderID=''");
          while($row5 = mysql_fetch_array($result5))
            { 
            echo "R".formatMoney($row5['sum(total)']);
            echo '<input type="hidden" name="totas" value="'.$row5['sum(total)'].'">';
            }
          ?>
                    </strong></td>
                </tr>
        </tbody>
            </table>
    
    <?php
	if($count2==0 ){
?>

                                         <script type="text/javascript">
                                                alert("Your shopping cart is empty. Add an item");
                                                window.location= "user_products.php";
                                            </script>
   <?php
	}else{
?>
           
        
  <a href="user_products.php" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a>
  
  <button type="submit" id="" onclick="return confirm('Are you sure you want to Checkout?')" name="submit" class="btn btn-large pull-right">Check Out <i class="icon-arrow-right"></i></button>
<?php
	}
?>
Shipping Address: <input type="text" name="shipaddress" placeholder="Address for delivery purpose" required/>
City:
<select size="1" name="province">
<option value="Gauteng">Gauteng</option>
<option value="Limpopo">Limpopo</option>
<option value="Mpumalanga">Mpumalanga</option>
<option value="North West">North West</option>
<option value="Western Cape">Western Cape</option>
<option value="Eastern Cape">Northern Cape</option>
<option value="Northern Cape">Northern Cape</option>
<option value="Free State">Free State</option>
<option value="KZN">KZN</option>

</select> 
</form>
<hr class="soft">
<div class="well" id="footerSection">
  <div class="row">
    <div class="span3">
      <h5><font color="black">Company Address</font></h5>
<b><font color="black"> &nbsp; &nbsp;Main Office</b>:
The company is located at  &nbsp; &nbsp; Milpark  &nbsp; &nbsp; &nbsp;Next to the Hollard Buliding

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
   
   <hr class="soft">
  <p class=""><marquee><font color="black"></font></marquee></p>
  </div><!-- /container --></center>
   <hr class="soft">
  <p class=""><marquee><font color="black">Wixstore &copy; 2017  All rights reserved. Accept all major credit and debit cards.</font></marquee></p>
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
</html></div>
</font>
</body>