<?php include 'inc/header.php';?>
<?php 
	if(isset($_GET['deleteWistlistid'])){
		$id = $_GET['deleteWistlistid'];
		$customerID = Session::get('id');
		$deleteWistlistData = $prod->deleteWistlistData($customerID, $id);
	}
?>


 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Wish List</h2>
			    	<?php 
			    		if(isset($deleteWistlistData)){
			    			echo  $deleteWistlistData;
			    		}
			    	?>
            	<table class="tblone overWriteImage">
							<tr>
								<th width="10%">Serial</th>
								<th width="20%">Product Name</th>
								<th width="15%">Price</th>
                                <th width="15%">Image</th>
								<th width="25%">Action</th>
							</tr>
                            <?php
                            	$id = Session::get('id');
                                $showWishListProduct = $prod->checkWishListProduct($id);
                                if($showWishListProduct){
                                   $i = 0;
                                    while($data = $showWishListProduct->fetch_assoc()){
                                        $i++;
                            ?>
							<tr>
								<td><?php echo $i ; ?></td>
								<td><?php echo $data['productName']; ?></td>
								<td>$<?php echo $data['price']; ?></td>
								<td><img src="admin/<?php echo $data['image']; ?>" alt=""/></td>
								<td>
									<a href="details.php?id=<?php echo $data['id']; ?>">Buy Now</a> ||
									<a onclick="return confirm('are you sure to delete');" href="?deleteWistlistid=<?php echo $data['id']; ?>">Remove</a>
								</td>
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