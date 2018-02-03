<?php include 'inc/header.php';
global $sum, $qantity;
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cartId = $_POST['productId'];
    $quantity = $_POST['quantity'];
    $updateToCart = $cart->updateToCart($cartId, $quantity);
    if($quantity <= 0)
        $cartDelete = $cart->cartDelete($cartId);
}

if(isset($_GET['delId'])) {
    $cartDeleteId = $_GET['delId'];
    $cartDelete = $cart->cartDelete($cartDeleteId);
   }

   if(!isset($_GET['id'])){
    echo "<meta http-equiv='refresh' content='0;URL=?id=1'/>";
   }
?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
                <?php
                if(isset($updateToCart)){
                    echo $updateToCart;
                }
                    if(isset($cartDelete)){
                        echo $cartDelete;
                    }
                ?>
						<table class="tblone">
							<tr>
								<th width="10%">Serial</th>
								<th width="20%">Product Name</th>
								<th width="15%">Image</th>
								<th width="15%">Price</th>
								<th width="15%">Quantity</th>
								<th width="15%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
                            <?php
                                $showCart = $cart->showCartProduct();
                                if($showCart){

                                    $sum = 0;
                                    $quantity = 0;
                                    $i = 0;
                                    while($data = $showCart->fetch_assoc()){
                                        $i++;
                            ?>
							<tr>
								<td><?php echo $i ; ?></td>
								<td><?php echo $data['productName']; ?></td>
								<td><img src="admin/<?php echo $data['image']; ?>" alt=""/></td>
								<td>$<?php echo $data['price']; ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="productId" value="<?php echo $data['id']; ?>"/>
										<input type="number" name="quantity" value="<?php echo $data['quantity']; ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td><?php
                                    $total = $data['price'] * $data['quantity'];
                                    echo $total;
                                    ?></td>
								<td><a onclick="return confirm('Are sure to delete this??')" href="?delId=<?php echo $data['id']; ?>">X</a></td>
							</tr>
							<?php
                                    $sum = $sum + $total;
                                    $quantity = $quantity + $data['quantity'];
                                    Session::set("sum", $sum);
                                    Session::set("quantity", $quantity);
                                    }}
                                    ?>
						</table>
                        <?php
                        $checkCartBySession = $cart->checkCartBySession();
                        if($checkCartBySession){
                        ?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td><?php echo $sum ; ?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>
                                    <?php
                                        $vat = $sum * 0.10;
                                        $gTotal = $sum + $vat;
                                        echo $gTotal;
                                    ?>
                                </td>
							</tr>
					   </table>
                            <?php }else{
                            header('location:index.php');
                        }?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>