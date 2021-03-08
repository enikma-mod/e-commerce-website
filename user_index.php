<?php include('include/connect.php');?>
<?php include('include/session.php'); 



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
    background-color: darkgrey;
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
          <a id="logoM" href="user_index.php"><img src="" /></a>
                  <a data-target="#sidebar" data-toggle="collapse" class="btn btn-navbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>
                  <div class="nav-collapse">
                    <ul class="nav">
            <li class="active"><a href="user_index.php"><i class="icon-home icon-large"></i> Home</a></li>
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


      <div class="well">
   <img src="img/logo.jpg" />
      </div>

<div class="container theme-showcase" role="main">
   <div class="container">
  <hr class="soft">
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="2" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="3" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="4" ></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <div class="item active">
            <center><img src="img/beauty.jpg" alt="First slide" style="height: 600px;" style="width: 950px;"></center>

          </div>
          <div class="item">
            <center><img src="img/h1-1.jpg" alt="Second slide" style="height: 600px;" style="width: 9500px;"></center>
          </div>
          <div class="item">
            <center><img src="img/iron-man.jpg" alt="Third slide" style="height: 600px;" style="width: 9500px;" ></center>
          </div>
          <div class="item">
            <center><img src="img/lovers.jpg" alt="fourth slide" style="height: 600px;" style="width: 9500px;" ></center>
          </div>


        </div>
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only"></span>
        </a>
      </div>
    
  <div class="row">
  <div id="sidebar" class="span3">
  
</div>

</div>

  </div>
    </div>

    
  <div class="row">
  <div id="sidebar" class="span3">
  
</div>




<hr class="soft">
  <p class=""><marquee><font color="black">.</font></marquee></p>
  </div><!-- /container --></center>
  <footer class="container-fluid text-center">
  <center>
  <hr class="soft">
<div  id="footerSection">
  <?php include('footer2.php');?>





 