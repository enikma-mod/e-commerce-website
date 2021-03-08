<?php include('include/connect.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    
    

    <title>Registration</title>
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

    <!-- Le fav and touch icons -->

<script type='text/javascript'>
function validation(){
    //var CheckPassword = /^[A-Za-z]\w{7,14}$/; - numbers and characters and uppercase
    //var CheckPassword = /^[a-z]\w{7,14}$/; -
        var letterexp = /^[a-zA-Z]+$/;
    var quanti = 32; 
    var CheckPassword = /^\w{7,14}$/; 
    if(document.getElementById('password').value.match(CheckPassword)){
    }else{
        alert('Password must have minimum and maximum of 7 to 14 characters');
        document.getElementById('password').value = '';
        document.getElementById('password').focus();
    }

  var date1 = new Date();
        var  dob= document.getElementById("dob").value;
        var date2=new Date(dob);
            var y1 = date1.getFullYear(); //getting current year
            var y2 = date2.getFullYear(); //getting dob year
            var ages = y1 - y2;           //calculating age 
        if(+ages<=16){
            alert("Age below 18 is not allowed to register");
             document.getElementById('dob').value='';
        }
}
</script>

  <style>
   body {
    background-image: url("white-sands-4.JPG");
    background-repeat: no-repeat;
}
</style>
  </head>
<body>
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
            <li ><a href="products.php"><i class=" icon-th-large icon-large"></i> Products</a></li>
            <li ><a href="contact.php"><i class="icon-signal"></i> Contact Us</a></li>
            <li><a href="aboutus.php"><i class="icon-flag"></i>  About Us</a></li>
					</ul>
                   
                    <ul class="nav pull-right">
						<li class="dropdown">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">Login <b class="caret"></b></a>
						<div class="dropdown-menu">
							 <?php
                            if (isset($_POST['login'])) {
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
							<button type="submit" name="login" class="btn pull-right">Sign in</button>
                            <left><a href="forgotpass.php"><font color="blue">Forgot Password</font></a></left>
						  </div>
					
						</form>				
						</div>
					</li>
					<li  class="active">
						<a href="register.php">Sign Up</a>
					</li>
					</ul>
                  </div><!-- /.nav-collapse -->
                </div>
              </div><!-- /navbar-inner -->
            </div>
<!-- ======================================================================================================================== -->	


<div id="mainBody" class="container">
<header id="header">
<div class="row">
<div class="span12">
  <a href="index.php"><img src="img/logo.jpg" alt=""/></a><embed src="img/cart.gif" class="pull-right"></embed></div> </div>



<div class="clr"></div>
</header>

<!-- ==================================================Header End====================================================================== -->
<h3> Registration</h3>	
	<hr class="soft"/>
	<div class="well">


 <?php
                                    if (isset($_POST['submit'])) {
                                       $email = $_POST['email'];
                                       
                                       $password = md5($_POST['password']);
                                       $Cpassword = md5($_POST['password1']);
                                       if($password != $Cpassword){
                                        ?>
                                         <script type="text/javascript">
                                                alert("Password does not match!");
                                                window.location="register.php";
                                            </script>
                                        
                                        <?php
                                       }else{
                                        $checkQuery = mysql_query( "SELECT * FROM `customers` WHERE Email='$email'");
                                        if (mysql_num_rows($checkQuery) > 0) {
                                            ?>
                                          <script type="text/javascript">
                                                alert("Your Email is already exist! Please sign in your account.");
                                                window.location="login.php";
                                            </script>
                                          
                                          <?php  
                                            }else{
                                                $cnumber = $_POST['cnumber'];
                                                if(ctype_digit($cnumber)){
                                        $email = $_POST['email'];
                                        $gender = $_POST['gender'];
                                        
                                        $password = md5($_POST['password']);
                                        $firstname = $_POST['fname'];           
                                        $lastname = $_POST["lastname"];
                                        $city = $_POST['city'];                                     
                                        $address = $_POST['address'];
                                        $birthday = $_POST['bdate'];
                                         $cnumber = $_POST['cnumber'];
                                         $Middlename = $_POST['middlename'];
                                        
                                        
                                        date_default_timezone_set('Asia/Manila');
                                        $new =date('F j, Y g:i:a  ');


                         mysql_query("insert into customers (CustomerID,Middle_name,Gender,Firstname,Lastname,Email,Password,Contact_number,Address,City,Birthday,Date_created,status) values
                                         ('','$Middlename','$gender','$firstname','$lastname','$email','$password','$cnumber','$address','$city','$birthday','$new','inactive')") or die(mysql_error());
                                            
                                            ?>

                                            <script type="text/javascript">
                                                alert("You are succesfully registered! Please login your new account.");
                                                window.location="index.php";
                                            </script>


                                            <?php
                                    }else{
                                        ?>
                                        <script type="text/javascript">
                                                alert("Contact number Error! Input number only.");
                                            </script>
                                        
                                        <?php
                                    }
                                    
                                    
                                    }
                                    }
                                     }
                                    ?>

	<form class="form-horizontal" method="post">
		<h3>Your Personal Information</h3>
		<div class="control-group">
		<label class="control-label" for="dob">Gender</label>
		<div class="controls">
		<select class="span2" name="gender">

			<option value="Male">Male</option>
			<option value="Female">Female</option>
			</select>
		</div>
		</div>
		  
                        <!---------------------------------------------->
<script language="javascript" type="text/javascript">
function cap()
{
    var str = document.getElementById("inputFname").value;
    document.getElementById("inputFname").value = str.charAt(0).toUpperCase() + str.slice(1);
}
</script><!--------This is for Capital the first Letter--->
                        
		<div class="control-group">
			<label class="control-label" for="inputFname">First name *</label>
			<div class="controls">
			  <input type="text" name="fname" class="form-control" onkeydown = "cap()"  id="inputFname" placeholder="First Name" required/>
			</div>
		 </div>
         
      <!---------------------------------------------->
<script language="javascript" type="text/javascript">
function cap1()
{
    var str = document.getElementById("inputmiddlename").value;
    document.getElementById("inputmiddlename").value = str.charAt(0).toUpperCase() + str.slice(1);
}
</script><!--------This is for Capital the first Letter--->         
         
          <div class="control-group">
			<label class="control-label" for="inputMname">Middle name *</label>
			<div class="controls">
			  <input type="text" name="middlename" onkeydown="cap1()"   id="inputmiddlename" placeholder="Middle Name" required/>
			</div>
            
           </div> <!---------------------------------------------->
<script language="javascript" type="text/javascript">
function cap2()
{
    var str = document.getElementById("inputLname").value;
    document.getElementById("inputLname").value = str.charAt(0).toUpperCase() + str.slice(1);
}
</script><!--------This is for Capital the first Letter---> 

		 
		 <div class="control-group">
			<label class="control-label" for="inputLname">Last name *</label>
			<div class="controls">
			  <input type="text" name="lastname" onkeydown="cap2()" id="inputLname" placeholder="Last Name" required/>
			</div>
		 </div>
         <!---------------------------------------------->
         
		<div class="control-group">
		<label class="control-label" name="email" for="inputEmail">Email *</label>
		<div class="controls">
		  <input type="text" name="email" id="inputEmail" placeholder="Email" required/>
		</div>
	  </div>
      	  
	<div class="control-group">
		<label class="control-label" for="inputPassword">Password *</label>
		<div class="controls">
		  <input type="password" name="password"  name="midname" id="password" onchange="validation()"  placeholder="Password" required/>
		</div>
	  </div>
      
      	<div class="control-group">
		<label class="control-label" for="inputPassword">Confirm Password *</label>
		<div class="controls">
		  <input type="password" name="password1"  name="midname" id="password" onchange="validation()"  placeholder="Confirm Password" required/>
		</div>
	  </div>
      	  
		<div class="control-group">
		<label class="control-label" for="dob">Date of Birth *</label>
		<div class="controls">
		    <input type="date" name="bdate"  onchange="validation()" id="dob" placeholder="Date" required/>
			
		</div>
	  </div>

			

		<h3>Your address</h3>
        
        <!---------------------------------------------->
<script language="javascript" type="text/javascript">
function cap3()
{
    var str = document.getElementById("address").value;
    document.getElementById("address").value = str.charAt(0).toUpperCase() + str.slice(1);
}
</script><!--------This is for Capital the first Letter---> 
		
		<div class="control-group">
			<label class="control-label" for="adress">Address *</label>
			<div class="controls">
			  <input type="text" name="address" onkeydown="cap3()" id="address" placeholder="Adress" required/> 
			</div>
		</div>
		
        <!---------------------------------------------->

		
		<div class="control-group">
			<label class="control-label" for="Province">Province *</label>
			<div class="controls">
<select size="1" name="Province">
<option value="Gauteng">Gauteng</option>
<option value="Limpopo">Limpopo</option>
<option value="Mpumalanga">Mpumalanga</option>
<option value="North West">North West</option>
<option value="Free State">Free State</option>
<option value="Eastern Cape">Eastern Cape</option>
<option value="KwaZulu Natal">KwaZulu Natal</option>
<option value="Northern Cape">Northern Cape</option>
<option value="Western Cape">Western Cape</option>


</select> 
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="phone">Contact Number *</label>
			<div class="controls">
			  <input type="text"  name="cnumber" id="phone" placeholder="phone" required/>
			</div>
		</div>
	
	<div class="control-group">
			<div class="controls">
				<input type="hidden" name="email_create" value="1">
				<input type="hidden" name="is_new_customer" value="1">
				<input class="btn btn-large btn-primary  " name="submit" type="submit" value="register" />
			</div>
		</div>		
	</form>
		</div>
<!-- Footer 

 -->
<hr class="soft">
<div  id="footerSection">
  <?php include('footer.php');?>
  
   
   
  <center>
  <p>Wixstore &copy; 2017  All rights reserved. Accept all major credit and debit cards.<img style="float:right" src="img/visa.png"  height="50" width="50"><img style="float:right" src="img/mastercard.png"  height="50" width="50"><img style="float:right" src="./img/paypal.png"  height="50" width="50"></p> </center>
</footer>


