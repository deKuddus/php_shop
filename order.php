<?php include 'inc/header.php';

$login = Session::get("customerLogin");
if($login == false){
    header("location:login.php");
}

if(isset($_GET['customerId'])){

        $customerid = $_GET['customerId'];
        $price = $_GET['price'];
        $date = $_GET['date'];
        $confirm= $cart->shiftConfirm( $customerid, $price, $date);
    }
if(isset($_GET['delteId'])){

        $customerid = $_GET['delteId'];
        $price = $_GET['price'];
        $date = $_GET['date'];
        $deleteShiftProduct = $cart->deleteShiftProduct( $customerid, $price, $date);
    }
?>
<style>
    .backgroudRemove{}
    .backgroudRemove tr td a{background:none;}
</style>

    <div class="main">
        <div class="content">
            <div class="section group">
                <div class="order">
                    <h2>Your Orderd List</h2>
                    <table class="tblone backgroudRemove">
                        <tr>
                            <th>Serial</th>
                            <th>Product Name</th>
                            <th>Image</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        $id = Session::get('id');
                        $showOrderList = $cart->showOrderList($id);
                        if($showOrderList){
                            $i = 0;
                            while($data = $showOrderList->fetch_assoc()){
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo $i ; ?></td>
                                    <td><?php echo $data['productName']; ?></td>
                                    <td><img src="admin/<?php echo $data['image']; ?>" alt=""/></td>
                                    <td><?php echo $data['quantity']; ?></td>

                                    <td><?php
                                        $total = $data['price'];
                                        echo $total;
                                        ?></td>
                                    <td><?php echo $fm->dateFormat($data['date']); ?></td>
                                    <td><?php
                                        if($data['status'] == '0'){
                                            echo "pending" ;
                                        }elseif ($data['status'] == '1') {?>
                                            <a href="?customerId=<?php echo $id;?>&price=<?php echo $total;?>&date=<?php echo $data['date'];?>">Shifted</a>
                                       <?php }else{
                                            echo "Confirm";
                                        }
                                        ?></td>
                                    <?php
                                        if($data['status'] == '2'){?>
                                    <td><a onclick="return confirm('Are sure to delete this??')" href="?delteId=<?php echo $id;?>&price=<?php echo $total;?>&date=<?php echo $data['date'];?>">X</a></td>

                                    <?php  }else{?>
                                        <td>N/A</td>

                                        <?php } ?>
                                </tr>
                                <?php }}?>
                    </table>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
<?php include 'inc/footer.php'; ?>