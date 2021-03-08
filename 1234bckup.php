 <h3><font color="white"> Products </h3> 
  
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
<img src="server/ADMIN/SERVER/AS/<?php echo $row['image']; ?>" alt="" style="max-width: 230px; max-height: 220px;"/>
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