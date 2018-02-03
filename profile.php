<?php include 'inc/header.php';
$login = Session::get("customerLogin");
if($login == false){
    header("location:login.php");
}
?>
    <div class="main">
        <div class="content">
            <div class="section group">

                <?php
                $id = Session::get('id');
                $getCustomerProfile = $customer->getCustomerProfile($id);
                if($getCustomerProfile){
                    while($data = $getCustomerProfile->fetch_assoc()){
                ?>

               <table class="tblone table">
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
<?php include 'inc/footer.php'; ?>