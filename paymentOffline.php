<?php include 'inc/header.php';
$login = Session::get("customerLogin");
if($login == false){
    header("location:login.php");
}
if(isset($_GET['order']) && $_GET['order'] == "order"){
    $id = Session::get('id');
    $getOrder = $cart->getOrder($id);
    $cart->deleteCartBySession();
}
?>
    <div class="main">
        <div class="content">
            <div class="section group">
               <div class="paymentProcess">
                   <table class="tblone">
                       <tr>
                           <th>Mo</th>
                           <th>Product</th>
                           <th>Price</th>
                           <th>Quantity</th>
                           <th>Total</th>

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
                                   <td>$<?php echo $data['price']; ?></td>
                                   <td><?php echo $data['quantity']; ?></td>

                                   <td><?php
                                       $total = $data['price'] * $data['quantity'];
                                       echo $total;
                                       ?></td>

                               </tr>
                               <?php
                               $sum = $sum + $total;
                               $quantity = $quantity + $data['quantity'];
                           }}
                       ?>
                   </table>
                       <table class="tableStyle">
                           <tr>
                               <td>Sub Total</td>
                               <td>:</td>
                               <td><?php echo $sum ; ?></td>
                           </tr>
                           <tr>
                               <td>VAT</td>
                               <td>:</td>
                               <td>10% (<?php echo  $vat = $sum * 0.10; ?>)</td>
                           </tr>
                           <tr>
                               <td>Grand Total</td>
                               <td>:</td>
                               <td>
                                   <?php
                                   $vat = $sum * 0.10;
                                   $gTotal = $sum + $vat;
                                   echo $gTotal;
                                   ?>
                               </td>
                           </tr>
                       </table>
               </div>
               <div class="paymentProcess">

                   <?php
                   $id = Session::get('id');
                   $getCustomerProfile = $customer->getCustomerProfile($id);
                   if($getCustomerProfile){
                       while($data = $getCustomerProfile->fetch_assoc()){
                           ?>

                           <table class="tblone tableWidth">
                               <tr>
                                   <td colspan="3"><h2>Your Profile Details</h2></td>

                               </tr>
                               <tr>
                                   <td width="20%">Name</td>
                                   <td width="5%">:</td>
                                   <td><?php echo $data['name']; ?></td>
                               </tr>

                               <tr>
                                   <td width="20%">Email</td>
                                   <td width="5%">:</td>
                                   <td><?php echo $data['email']; ?></td>
                               </tr>

                               <tr>
                                   <td width="20%">City</td>
                                   <td width="5%">:</td>
                                   <td><?php echo $data['city']; ?></td>
                               </tr>

                               <tr>
                                   <td width="20%">Address</td>
                                   <td width="5%">:</td>
                                   <td><?php echo $data['address']; ?></td>
                               </tr>

                               <tr>
                                   <td width="20%">Zip</td>
                                   <td width="5%">:</td>
                                   <td><?php echo $data['zip']; ?></td>
                               </tr>

                               <tr>
                                   <td width="20%">Country</td>
                                   <td width="5%">:</td>
                                   <td><?php echo $data['country']; ?></td>
                               </tr>

                               <tr>
                                   <td width="20%">Phone</td>
                                   <td width="5%">:</td>
                                   <td><?php echo $data['phone']; ?></td>
                               </tr>
                               <tr>
                                   <td width="20%"></td>
                                   <td width="5%"></td>
                                   <td><a href="updadeProfile.php">Update profile</a></td>
                               </tr>
                           </table>
                       <?php }} ?>
               </div>
            </div>
        </div>
        <div class="order"><a href="?order=order">Order</a></div>
    </div>
<?php include 'inc/footer.php'; ?>