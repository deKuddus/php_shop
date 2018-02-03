<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    $filePath = realpath(dirname(__FILE__));
    include_once ($filePath.'/../classes/Product.php');
    $fm = new Format();
    $prod = new Product();

    if(isset($_GET['proDelId'])){
        $delID = $_GET['proDelId'];
        $deleteProduct = $prod->deleteProduct($delID);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>
        <?php if(isset($deleteProduct)){
            echo $deleteProduct;
        } ?>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial</th>
					<th>Product Nmae</th>
					<th>Brand Name</th>
					<th>Category Name</th>
					<th>About Product</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
            <?php
                $getProduct = $prod->getProductAll();
                if($getProduct){
                    $i=0;
                    while($data = $getProduct->fetch_assoc()){
                        $i++;
            ?>
				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $data['name'];?></td>
					<td><?php echo $data['cat_name'];?></td>
					<td><?php echo $data['brand_name'];?></td>
					<td><?php echo $fm->textShort($data['body'], 50);?></td>
					<td>$<?php echo $data['price'];?></td>
					<td><img src="<?php echo $data['image'];?>" alt="image" height="80px" width="90px"></td>
					<td><?php

                            if($data['type'] == 0){
                                echo "Featured";
                            }else{
                                echo "Non-Featured";
                            }
                        ?></td>
                    <td><a href="productEdit.php?proId=<?php echo $data['id'];?>">Edit</a> || <a onclick="return confirm('Are sure to delete this category')" href="?proDelId=<?php echo $data['id'];?>">Delete</a></td>

                </tr>
				<?php }} ?>
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
