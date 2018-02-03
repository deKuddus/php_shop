<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../classes/Category.php';
    $category = new Category();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $catname  = $_POST['category'];



    $insertCat = $category->categoryInsert($catname);
}


?>


        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock">
                   <?php if(isset($insertCat)){
                       echo $insertCat;
                   }?>
                 <form action="addcat.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="category" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="ADD" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>