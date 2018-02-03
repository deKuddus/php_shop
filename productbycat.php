<?php
    include 'inc/header.php';

    if(!isset($_GET['catId']) OR $_GET['catId'] == NULL){
        header("location:404.php");
    }else{
        $id = $_GET['catId'];
    }
?>


 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Latest from Category</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">

              <?php
              $getProductByCatId = $prod->getProductByCatId($id);
              if($getProductByCatId){
                  while($data = $getProductByCatId->fetch_assoc()){
                      ?>
                      <div class="grid_1_of_4 images_1_of_4">
                          <a href="details.php?id=<?php echo $data['id']; ?>"><img src="admin/<?php echo $data['image']; ?>" alt="" /></a>
                          <h2><?php echo $data['name']; ?></h2>
                          <p><?php echo $fm->textShort($data['body'], 60); ?></p>
                          <p><span class="price">$<?php echo $data['price']; ?></span></p>
                          <div class="button"><span><a href="details.php?id=<?php echo $data['id']; ?>" class="details">Details</a></span></div>
                      </div>
                  <?php }}else{
                  echo "<script>window.location = '404.php';</script>";
              } ?>


          </div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>