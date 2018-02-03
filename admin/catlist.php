<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../classes/Category.php';
    $category = new Category();

    if(isset($_GET['delid'])){

        $id = $_GET['delid'];
        $deletecat = $category->deleteCategory($id);
    }

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
               <?php if(isset($deletecat)) echo $deletecat; ?>
                <div class="block">
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

                    <?php
                    $allCategory = $category->categoryList();
                    if($allCategory)
                    {
                        $i=0;
                        while($categorydata = $allCategory->fetch_assoc())
                        {
                            $i++;
                    ?>
                    <tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $categorydata['cat_name'];?></td>
							<td><a href="catedit.php?catid=<?php echo $categorydata['id'];?>">Edit</a> || <a onclick="return confirm('Are sure to delete this category')" href="?delid=<?php echo $categorydata['id'];?>">Delete</a></td>
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

