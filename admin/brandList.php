<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include '../classes/Brand.php';
$brand = new Brand();

if(isset($_GET['delid'])){

    $id = $_GET['delid'];
    $deletebrand = $brand->deleteBrand($id);
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <?php if(isset($deletebrand)) echo $deletebrand; ?>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>Brand Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $allBrand= $brand->brandyList();
                if($allBrand)
                {
                    $i=0;
                    while($branddata = $allBrand->fetch_assoc())
                    {
                        $i++;
                        ?>
                        <tr class="odd gradeX">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $branddata['brand_name'];?></td>
                            <td><a href="brandEdit.php?brandId=<?php echo $branddata['id'];?>">Edit</a> || <a onclick="return confirm('Are sure to delete this category')" href="?delid=<?php echo $branddata['id'];?>">Delete</a></td>
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

