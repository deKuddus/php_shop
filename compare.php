<?php include 'inc/header.php';?>


 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Compare List</h2>
            	<table class="tblone overWriteImage">
							<tr>
								<th width="10%">Serial</th>
								<th width="20%">Product Name</th>
								<th width="15%">Price</th>
                                <th width="15%">Image</th>
								<th width="10%">Action</th>
							</tr>
                            <?php
                            	$id = Session::get('id');
                                $showCompareProduct = $prod->showCompareProduct($id);
                                if($showCompareProduct){
                                   $i = 0;
                                    while($data = $showCompareProduct->fetch_assoc()){
                                        $i++;
                            ?>
							<tr>
								<td><?php echo $i ; ?></td>
								<td><?php echo $data['productName']; ?></td>
								<td>$<?php echo $data['price']; ?></td>
								<td><img src="admin/<?php echo $data['image']; ?>" alt=""/></td>
								<td><a href="details.php?id=<?php echo $data['id']; ?>">View</a></td>
							</tr>
							<?php } } ?>
						</table>
					</div>
					<div class="shopping">
						<div class="shopleft" style="width: 100%; text-align: center;">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<!-- <div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div> -->
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>