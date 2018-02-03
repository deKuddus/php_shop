
<div class="header_bottom">
    <div class="header_bottom_left">
        <div class="section group">
            <?php
                $latestSamsungBrand = $prod->latestSamsungBrand();
                if($latestSamsungBrand){
                    while($data = $latestSamsungBrand->fetch_assoc()){

            ?>
            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="details.php?id=<?php echo $data['id']; ?>"> <img src="admin/<?php echo $data['image']; ?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2>Samsung</h2>
                    <p><?php echo $data['name']; ?></p>
                    <div class="button"><span><a href="details.php?id=<?php echo $data['id']; ?>">Add to cart</a></span></div>
                </div>
            </div>
            <?php }} ?>

            <?php
            $latestAcerBrand = $prod->latestAcerBrand();
            if($latestAcerBrand){
            while($data = $latestAcerBrand->fetch_assoc()){

            ?>
            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="details.php?id=<?php echo $data['id']; ?>"> <img src="admin/<?php echo $data['image']; ?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2>Acer</h2>
                    <p><?php echo $data['name']; ?></p>
                    <div class="button"><span><a href="details.php?id=<?php echo $data['id']; ?>">Add to cart</a></span></div>
                </div>
            </div>
            <?php }} ?>
        </div>
        <div class="section group">
            <?php
            $latestAppleBrand = $prod->latestAppleBrand();
            if($latestAppleBrand){
            while($data = $latestAppleBrand->fetch_assoc()){

            ?>
            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="details.php?id=<?php echo $data['id']; ?>"> <img src="admin/<?php echo $data['image']; ?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2>Apple</h2>
                    <p><?php echo $data['name']; ?></p>
                    <div class="button"><span><a href="details.php?id=<?php echo $data['id']; ?>">Add to cart</a></span></div>
                </div>
            </div>
            <?php }} ?>

            <?php
            $latestCanonBrand = $prod->latestCanonBrand();
            if($latestCanonBrand){
            while($data = $latestCanonBrand->fetch_assoc()){

            ?>
            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="details.php?id=<?php echo $data['id']; ?>"> <img src="admin/<?php echo $data['image']; ?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2>Canon</h2>
                    <p><?php echo $data['name']; ?></p>
                    <div class="button"><span><a href="details.php?id=<?php echo $data['id']; ?>">Add to cart</a></span></div>
                </div>
            </div>
            <?php }} ?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="header_bottom_right_images">
        <!-- FlexSlider -->

        <section class="slider">
            <div class="flexslider">
                <ul class="slides">
                    <li><img src="images/1.jpg" alt=""/></li>
                    <li><img src="images/2.jpg" alt=""/></li>
                    <li><img src="images/3.jpg" alt=""/></li>
                    <li><img src="images/4.jpg" alt=""/></li>
                </ul>
            </div>
        </section>
        <!-- FlexSlider -->
    </div>
    <div class="clear"></div>
</div>