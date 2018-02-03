<?php include 'inc/header.php';
$login = Session::get("customerLogin");
if($login == false){
    header("location:login.php");
}

?>

<?php
$id = Session::get('id');
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $customerprofileUpdate = $customer->customerprofileUpdate($_POST, $id);
}
?>

    <style>
        .tblone{width: 600px; margin: 0 auto; border: 2px solid #DDDDDD}
        .tblone tr td { text-align: justify}
    </style>

    <div class="main">
        <div class="content">
            <div class="section group">
                <?php
                $id = Session::get('id');
                $getCustomerProfile = $customer->getCustomerProfile($id);
                if($getCustomerProfile){
                    while($data = $getCustomerProfile->fetch_assoc()){
                        ?>
                        <form action="" method="post">
                        <table class="tblone">
                            <tr>
                                <?php if(isset($customerprofileUpdate)){
                                    echo $customerprofileUpdate;
                                } ?>
                                <td colspan="2"><h2>profile update page</h2></td>

                            </tr>
                            <tr>
                                <td width="20%">Name</td>
                                <td><input type="text" name="name" value="<?php echo $data['name']; ?>"></td>
                            </tr>

                            <tr>
                                <td width="20%">Email</td>
                                <td><input type="email" name="email" value="<?php echo $data['email']; ?>"></td>
                            </tr>

                            <tr>
                                <td width="20%">City</td>
                                <td><input type="text" name="city" value="<?php echo $data['city']; ?>"></td>
                            </tr>

                            <tr>
                                <td width="20%">Address</td>
                                <td><input type="text" name="address" value="<?php echo $data['address']; ?>"></td>
                            </tr>

                            <tr>
                                <td width="20%">Zip</td>
                                <td><input type="text" name="zip" value="<?php echo $data['zip']; ?>"></td>
                            </tr>

                            <tr>
                                <td width="20%">Country</td>
                                <td><input type="text" name="country" value="<?php echo $data['country']; ?>"></td>
                            </tr>

                            <tr>
                                <td width="20%">Phone</td>
                                <td><input type="text" name="phone" value="<?php echo $data['phone']; ?>"></td>
                            </tr>
                            <tr>
                                <td width="20%"></td>
                                <td><input type="submit" name="submit" value="Save"></td>
                            </tr>
                        </table>
                        </form>
                    <?php }} ?>

            </div>
        </div>
    </div>
<?php include 'inc/footer.php'; ?>