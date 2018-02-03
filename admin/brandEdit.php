<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include '../classes/Brand.php';
$brand = new Brand();


if(!isset($_GET['brandId']) OR $_GET['brandId'] == NULL){
    echo "<script>window.location = 'brandList.php'; </script>";
}else{
    $catID = $_GET['brandId'];

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $brandName = $_POST['brand'];
        $editBrand = $brand->brandUpdate($brandName, $catID);
    }}
?>


    <div class="grid_10">
        <div class="box round first grid">
            <h2>Edit Brand</h2>
            <div class="block copyblock">
                <?php if(isset($editBrand)) echo $editBrand;?>

                <?php
                $brandEit = $brand->brandEdit($catID);
                if($brandEit){
                    while( $singleBrand = $brandEit->fetch_assoc()){
                        ?>
                        <form action="" method="post">
                            <table class="form">
                                <tr>
                                    <td>

                                        <input type="text" name="brand" value="<?php echo $singleBrand['brand_name']; ?>" class="medium" />


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