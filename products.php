<?php include('include/connect.php');
include('function.php');
      $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
      $limit = 8;
      $startpoint = ($page * $limit) - $limit;
        
        //to make pagination
        $statement = "`tb_products`";
        
        
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
     <link rel="shortcut icon" href="">

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
    background-color: lightblue;
    background-repeat: no-repeat;
}
</style>
    <!-- Le fav and touch icons -->
 </head>
<body >
  <!-- Navbar
    ================================================== -->
<div class="navbar navbar-fixed-top">
              <div class="navbar-inner">
                <div class="container">
					<a id="logoM" href="index.html"><img src="" alt=""/></a>
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
                            
                            
                            $query = mysql_query("select * from customers where Email='$email' and Password='$pass' ") or die(mysql_error());
                            $count = mysql_num_rows($query);
                            $row = mysql_fetch_array($query);
                            if ($count > 0) {
                            session_start();
                            session_regenerate_id();
                            $_SESSION['id'] = $row['CustomerID'];
                            $memid=$row['CustomerID'];
                            $Fname=$row['Firstname'];
$user=$row['Email'];
date_default_timezone_set('Asia/Manila');
    $date=date('F j, Y g:i:a  ');
    
mysql_query("insert into loginout_history(CustomerID,User,Name,Time_in,Time_out)values('$memid','$user','$Fname','$date','')")or die (mysql_error());
                           echo "<script>window.location.replace('user_index.php')</script>";
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
						<a href="register.php">Sign up</a>
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
  <a href="index.php"><img src="img/logo.jpg" alt=""/></a><embed src="img/cart.gif" class="pull-right"></embed></div> 

<div class="clr"></div>
</header>
</div>

</div>

<!-- ==================================================Header End====================================================================== -->
 <h3><font color="white"> Featured Movies</h3> 
  
  <form method="post">  
<div>
<Center>
<input type="image" title="Search" src="assets/img/search.png" name="submit" alt="Search" />
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
<img src="server/ADMIN/SERVER/AS/<?php echo $row['image']; ?>" alt="" style="max-width: 230px; max-height: 250px;"/>
<?php
  }
?>
        
        <div class="caption">
          <h5><b><?php echo $row['name']; ?></b></h5>
          <h4><a class="btn-success btn" title="Click to view!" href="product_details.php? id=<?php echo $id;?>"><i class="icon-check"></i> View</a> <span class="pull-right">Price: R<?php echo formatMoney($row['price'],2); ?></span></h4>
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

<!-- Footer ------------------------------------------------------ -->


<hr class="soft">
<div class="thumbnail" id="footerSection">
  

     <div class="span3">
      <h5>INFORMATION:</h5>   &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;   Sales@WixStores.com<br/>
      <p>   Website:http://Wixstores.blogspot.com/  &nbsp;Contact No:(+27)/747-6805/747-3642</p>
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
  <p class=""><marquee><font color="black"></font></marquee></p>
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
</html>    </div>
    
    </form>

</body></div></font>