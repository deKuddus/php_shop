<?php include 'inc/header.php';
$login = Session::get("customerLogin");
if($login == false){
    header("location:login.php");
}
?>
<?php
    global $sum;
    $customerID = Session::get('id');
    $payableAmount = $cart->payableAmount($customerID);
    if($payableAmount){
        $sum = 0;
        while($data = $payableAmount->fetch_assoc()){
            $sum = $sum + $data['price'];
        }
    }
?>

    <div class="main">
        <div class="content">
            <div class="section group">
                <div class="paymentSuccess">
                    <h2>Success</h2>
                    <p>Your payable amount is (including vat 10%): $
                        <?php
                            $vat = $sum * 0.1;
                            $total = $vat + $sum;
                            echo $total;
                        ?>
                    </p>
                    <p>your order is pending now. we will confirm you through your phone or email. you can see your order
                        <a href="order.php">HERE</a></p>
                </div>
            </div>
        </div>
    </div>
<?php include 'inc/footer.php'; ?>