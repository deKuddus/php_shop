<?php include 'inc/header.php';
$login = Session::get("customerLogin");
if($login == false){
    header("location:login.php");
}
?>

    <div class="main">
        <div class="content">
            <div class="section group">
                <div class="payment">
                    <h2>Choose your payment method</h2>
                    <a href="paymentOffline.php">OFFLINE PAYMENT</a>
                    <a href="paymentOnlinePaynent.php">ONLINE PAYMENT</a>
                    </div>
                </div>
        </div>
    </div>
<?php include 'inc/footer.php'; ?>