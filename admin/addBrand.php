<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include '../classes/Brand.php';
$brand = new Brand();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $brandName  = $_POST['brand'];



    $insertbrand = $brand->brandInsert($brandName);
}


?>


    <div class="grid_10">
        <div class="box round first grid">
            <h2>Add New Brand</h2>
            <div class="block copyblock">
                <?php if(isset($insertbrand)){
                    echo $insertbrand;
                }?>
                <form action="" method="post">
                    <table class="form">
                        <tr>
                            <td>
                                <input type="text" name="brand" placeholder="Enter brand Name..." class="medium" />
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