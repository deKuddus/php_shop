<?php include 'inc/header.php'; ?>

<?php
global $proID;
if(!isset($_GET['id']) OR $_GET['id'] == NULL){
    echo "<script>window.location = '404.php'; </script>";
}else {
    $proID = $_GET['id'];
}

  if($_SERVER['REQUEST_METHOD'] == 'POST'  && isset($_POST['submit'])) {
       $quantity = $_POST['quantity'];
       $addToCart = $cart->addToCart($quantity, $proID);
   }

?>
<?php
    
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])){
       $productID = $_POST['productId'];
       $id = Session::get('id');
       $insertCompareProduct = $prod->insertCompareProduct($id ,$productID);
    }
     if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wishlist'])){
       $productID = $_POST['productId'];
       $id = Session::get('id');
       $insertWishListProduct = $prod->insertWishListProduct($id ,$productID);
    }
?>

 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">
                <?php
                    $detailsOfProduct = $prod->detailsOfProduct($proID);
                    if($detailsOfProduct){
                        while($data = $detailsOfProduct->fetch_assoc()){
                ?>
					<div class="grid images_3_of_2">
						<img src="admin/<?php echo $data['image']; ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $data['name']; ?></h2>
					<div class="price">
						<p>Price: <span>$<?php echo $data['price']; ?></span></p>
						<p>Category: <span><?php echo $data['cat_name']; ?></span></p>
						<p>Brand:<span><?php echo $data['brand_name']; ?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
					</form>				
				</div>
                    <span style="color: red; font-size: 20px"><?php
                        if(isset($addToCart)){
                            echo $addToCart;
                        }
                        ?></span>
                        <?php
                        if(isset($insertCompareProduct)){
                        	echo $insertCompareProduct;
                        }
                        ?>
                        <?php
                        if(isset($insertWishListProduct)){
                        	echo $insertWishListProduct;
                        }
                        ?>
                        <?php 
			                $login = Session::get("customerLogin");
			                if($login == true){
                        ?>
                   <div class="add-cart">
                   	<div class="space">
                   		<form action="" method="post">
						<input type="hidden" name="productId" value="<?php echo $data['id']; ?>"/>
						<input type="submit" class="buysubmit" name="compare" value="Add to compare"/>
					</form>	
                   	</div>

                   	<div class="space">
                   		<form action="" method="post">
                   		<input type="hidden" name="productId" value="<?php echo $data['id']; ?>"/>
						<input type="submit" class="buysubmit" name="wishlist" value="Add to wishList"/>
					</form>	
                   	</div>
							
				  </div>
				  <?php } ?>
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<p><?php echo $data['body']; ?></p>

	    </div>

                    <?php }} ?>
	</div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
                        <?php
                            $getCategory = $cat->categoryList();
                            if($getCategory){
                                while($data = $getCategory->fetch_assoc()){
                        ?>
				      <li><a href="productbycat.php?catId=<?php echo $data['id']; ?>"><?php echo $data['cat_name']; ?></a></li>
				      <?php } } ?>
    				</ul>
    	
 				</div>
 		</div>
 	</div>
	</div>
<?php include 'inc/footer.php'; ?>