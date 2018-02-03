<?php
include 'inc/header.php';
include 'inc/sidebar.php';
$filePath = realpath(dirname(__FILE__));
include_once ($filePath.'/../classes/Customer.php');



    if(!isset($_GET['customerid']) OR $_GET['customerid'] == NULL){
        echo "<script>window.location = 'inbox.php'; </script>";
    }else{
        $customerID = $_GET['customerid'];

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<script>window.location = 'inbox.php'; </script>";
    }}
?>


    <div class="grid_10">
        <div class="box round first grid">
            <h2>Edit Category</h2>
            <div class="block copyblock">
              <?php
              $customer = new Customer();
                $showCustomer = $customer->getCustomerProfile($customerID);
                if($showCustomer){
                    while( $data = $showCustomer->fetch_assoc()){
                ?>
                <form action="" method="post">
                    <table class="form">
                        <tr>
                            <td>Name:</td>
                            <td><input type="text" readonly="readonly" value="<?php echo $data['name']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><input type="text" readonly="readonly" value="<?php echo $data['email']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>City:</td>
                            <td><input type="text" readonly="readonly" value="<?php echo $data['city']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Zip Code:</td>
                            <td><input type="text" readonly="readonly" value="<?php echo $data['zip']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Address:</td>
                            <td><input type="text" readonly="readonly" value="<?php echo $data['address']; ?>" class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>Country:</td>
                            <td><input type="text" readonly="readonly" value="<?php echo $data['country']; ?>" class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>Phone:</td>
                            <td><input type="text" readonly="readonly" value="<?php echo $data['phone']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" name="submit" Value="OK" />
                            </td>
                        </tr>
                    </table>
                </form>
                <?php } } ?>
            </div>
        </div>
    </div>
<?php include 'inc/footer.php';?>