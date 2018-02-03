<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include '../classes/Category.php';
$category = new Category();
//global $catID;

    if(!isset($_GET['catid']) OR $_GET['catid'] == NULL){
        echo "<script>window.location = 'catlist.php'; </script>";
    }else{
        $catID = $_GET['catid'];

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $catname = $_POST['category'];
        $editCat = $category->categoryUpdate($catname, $catID);
    }}
?>


    <div class="grid_10">
        <div class="box round first grid">
            <h2>Edit Category</h2>
            <div class="block copyblock">
                <?php if(isset($editCat)) echo $editCat;?>

                <?php
                $editcat = $category->editCategory($catID);
                if($editcat){
                    while( $singleCat = $editcat->fetch_assoc()){
                ?>
                <form action="" method="post">
                    <table class="form">
                        <tr>
                            <td>

                                <input type="text" name="category" value="<?php echo $singleCat['cat_name']; ?>" class="medium" />


                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                </form>
                <?php } } ?>
            </div>
        </div>
    </div>
<?php include 'inc/footer.php';?>