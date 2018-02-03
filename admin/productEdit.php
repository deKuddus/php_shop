<?php
include 'inc/header.php';
include 'inc/sidebar.php';
$filePath = realpath(dirname(__FILE__));
include_once ($filePath.'/../classes/Product.php');

$prod  = new Product();


if(!isset($_GET['proId']) OR $_GET['proId'] == NULL){

    echo "<script>window.location = 'productlist.php'; </script>";
}else{
    $id = $_GET['proId'];
}


if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
   $updateProduct = $prod->updatetProduct($_POST, $_FILES,$id);
}





?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Product</h2>
        <?php
        if(isset($updateProduct)){
            echo $updateProduct;
        }
        ?>
        <div class="block">
            <?php
                $allProduct = $prod->getAllProduct($id);
                if($allProduct){
                    while($value = $allProduct->fetch_assoc()){
            ?>

            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="name" value="<?php echo $value['name'];?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="catId">
                                <option>Select Category</option>
                                <?php


                                $allCategory = $prod->categoryList();
                                if($allCategory){
                                    while($result = $allCategory->fetch_assoc()){
                                        ?>
                                        <option
                                                <?php if($value['catId'] == $result['id']){?>
                                                    selected = "selected"
                                                    <?php
                                                } ?>
                                                value="<?php echo $result['id']; ?>"><?php echo $result['cat_name'];?></option>
                                    <?php }} ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Brand</label>
                        </td>
                        <td>
                            <select id="select" name="brandID">
                                <option>Select Brand</option>
                                <?php


                                $allBrand = $prod->brandyList();
                                if($allBrand){
                                    while($result = $allBrand->fetch_assoc()){
                                        ?>
                                        <option
                                                <?php if($value['brandId'] == $result['id']){?>
                                                    selected = "selected"
                                                    <?php
                                                } ?>
                                                value="<?php echo $result['id']; ?>"><?php echo $result['brand_name'];?></option>
                                    <?php }} ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Description</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="body"><?php echo $value['body'];?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Price</label>
                        </td>
                        <td>
                            <input type="text" name="price" value="<?php echo $value['price'];?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <img src="<?php echo $value['image'];?>" alt="image" height="80px" width="120px"/><br>
                            <input type="file" name="image"/>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Product Type</label>
                        </td>
                        <td>
                            <select id="select" name="type">
                                <option>Select Type</option>
                                <?php
                                    if($value['type'] == 0){?>
                                        <option selected="selected" value="0">Featured</option>
                                        <option  value="1">Non-Featured</option>
                                    <?php }else{?>
                                        <option selected="selected" value="1">Non-Featured</option>
                                        <option  value="0">Featured</option>
                                    <?php }?>

                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
            <?php }} ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


