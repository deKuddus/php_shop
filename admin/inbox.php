<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    $filePath = realpath(dirname(__FILE__));
    include_once ($filePath.'/../helper/Format.php');

    $filePath = realpath(dirname(__FILE__));
    include_once ($filePath.'/../classes/Cart.php');

    $cart = new Cart();
    $fm = new Format();

    if(isset($_GET['shiftId'])){

        $customerid = $_GET['shiftId'];
        $price = $_GET['price'];
        $date = $_GET['date'];
        $shiftOption = $cart->shiftUpdate( $customerid, $price, $date);
    }

     if(isset($_GET['deleteId'])){

        $customerid = $_GET['deleteId'];
        $price = $_GET['price'];
        $date = $_GET['date'];
        $deleteShiftProduct = $cart->deleteShiftProduct( $customerid, $price, $date);
    }

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <?php
                     if(isset($shiftOption)){
                        echo $shiftOption;
                     }
                ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>ID</th>
							<th>Date and Time</th>
                            <th>Product</th>
							<th>Customer ID</th>
							<th>Quantity</th>
							<th>price</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                        
                        $showOrderToAdmin = $cart->showOrderToAdmin();
                        if($showOrderToAdmin){
                            while($data = $showOrderToAdmin->fetch_assoc()){
                    ?>
						<tr class="odd gradeX">
							<td><?php echo $data['id'];?></td>
							<td><?php echo $fm->dateFormat($data['date']);?></td>
                            <td><?php echo $data['productName'];?></td>
							<td><?php echo $data['customerId'];?></td>
							<td><?php echo $data['quantity'];?></td>
							<td><?php echo $data['price'];?></td>
							<td><a href="customer.php?customerid=<?php echo $data['customerId'];?>">View details</a></td>
                            <?php
                                
                                if($data['status'] == '0'){ ?>

                                <td><a href="?shiftId=<?php echo $data['customerId'];?>&price=<?php echo $data['price'];?>&date=<?php echo $data['date'];?>">Do Shift</a></td>

                               <?php }elseif ($data['status'] == '1') {?>
                                  <td>pending</td>
                                <?php }else{ ?>

                               <td><a href="?deleteId=<?php echo $data['customerId'];?>&price=<?php echo $data['price'];?>&date=<?php echo $data['date'];?>">Remove</a></td>



                               <?php } ?>
						</tr>
                    <?php } } ?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
