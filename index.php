<?php include('layouts/header.php');?>




  <!-- Home -->
  <section id="home">
    <div class="container">
      <h5>NEW ARRIVALS</h5>
      <h1> <span>Best Prices</span> For This Seaseon</h1>
      <p>Eshop offers the best products for the most affordable prices</p>
      <button onclick="window.location.href='shop.php'">Shop Now</button>
    </div>
  </section>
  <!-- brand -->
  <section id="brand" class="container">
    <div class="row">
      <img src="assets/imgs/brand1.png" class="img-fluid col-lg-3 col-md-6 col-sm-12">
      <img src="assets/imgs/brand2.png" class="img-fluid col-lg-3 col-md-6 col-sm-12">
      <img src="assets/imgs/brand3.png" class="img-fluid col-lg-3 col-md-6 col-sm-12">
      <img src="assets/imgs/brand4.png" class="img-fluid col-lg-3 col-md-6 col-sm-12">
    </div>
  </section>



  <section id="new" class="w-100">
    <div class="row p-0 m-0">
      <!-- one -->
      <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
        <img class="img-fluid" src="assets/imgs/1.webp" alt="">
        <div class="details">
          <h2>Extreamly Awesome Shoes</h2>
          <button class="text-uppercase">Shop Now</button>
        </div>
      </div>
      <!-- two -->
      <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
        <img class="img-fluid" src="assets/imgs/2.jpg" alt="">
        <div class="details">
          <h2> Awesome Bag</h2>
          <button class="text-uppercase">Shop Now</button>
        </div>
      </div>
      <!-- three -->
      <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
        <img class="img-fluid" src="assets/imgs/3.jpg" alt="">
        <div class="details">
          <h2>10% OFF watch</h2>
          <button class="text-uppercase">Shop Now</button>
        </div>
      </div>

    </div>
  </section>




  <!-- featured -->
  <section id="featured" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
      <h3>Our featured</h3>
      <hr class="mx-auto">
      <p>Here you can check our featured products</p>
    </div>
    <div class="row mx-auto container-fluid">
      <?php include('server/get_featured_products.php')?>
      <?php while($row=$featured_products->fetch_assoc()){?>
      <div class="product col-lg-3 col-md-4 col-sm-12 text-center">
        
        <img src="assets/imgs/<?php echo $row['product_image']?>" class="img-fluid mb-3" alt="">
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name"><?php echo $row['product_name'];?></h5>
        <h4 class="p-price">$<?php echo $row['product_price'];?></h4>
        <a href="single_product.php?product_id=<?php echo $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
      </div>
      <?php } ?>
    </div>
  </section>

  <!-- banner -->
  <section id="banner" class="my-5 py-5">
    <div class="container">
      <h4>MID SEASON'S SALE</h4>
      <h1>Autumn Collections<br> UP to 30% OFF</h1>
      <button class="text-uppercase" onclick="window.location.href='shop.php'">Shop Now</button>
    </div>
  </section>
  <!-- clothes -->
  <section id="featured" class=" clothes my-5">
    <div class="container text-center mt-5 py-5">
      <h3>Dresses & Coats</h3>
      <hr class="mx-auto">
      <p>Here you can check our amazing clothes</p>
    </div>
    <div class="row mx-auto container-fluid">
      <?php include("server/get_dress_products.php")?>
      <?php while($row=$dress_products->fetch_assoc()){?>
      <div class="product col-lg-3 col-md-4 col-sm-12 text-center">
        <img src="assets/imgs/<?php echo $row['product_image']?>" class="img-fluid mb-3" alt="">
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name"><?php echo $row['product_name'];?></h5>
        <h4 class="p-price">$<?php echo $row['product_price'];?></h4>
        <a href="single_product.php?product_id=<?php echo $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
      </div>
      <?php }?>
    </div>
  </section>

  <!-- shoes -->
  <section id="shoes featured" class="my-5">
    <div class="container text-center mt-5 py-5">
      <h3>Shoes</h3>
      <hr class="mx-auto">
      <p>Here you can check our amazing shoes</p>
    </div>
    <div class="row mx-auto container-fluid">
      <?php include("server/get_shoe_products.php");?>
      <?php while($row=$shoe_products->fetch_assoc()){?>
      <div class="product col-lg-3 col-md-4 col-sm-12 text-center">
        <img src="assets/imgs/<?php echo $row['product_image'] ?>" class="img-fluid mb-3" alt="">
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name"><?php echo $row['product_name'];?></h5>
        <h4 class="p-price">$<?php echo $row['product_price'];?></h4>
        <a href="single_product.php?product_id=<?php echo $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
      </div>
      <?php }?>
    </div>
  </section>

  <!-- watches -->
  <section id="watches featured" class="my-5">
    <div class="container text-center mt-5 py-5">
      <h3>Watches</h3>
      <hr class="mx-auto">
      <p>Here you can check our amazing watches</p>
    </div>
    <div class="row mx-auto container-fluid">
      <?php include("server/get_watch_products.php")?>
      <?php while($row=$watch_products->fetch_assoc()){?>
      <div class="product col-lg-3 col-md-4 col-sm-12 text-center">
        <img src="assets/imgs/<?php echo $row['product_image']?>" class="img-fluid mb-3" alt="">
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name"><?php echo $row['product_name'];?></h5>
        <h4 class="p-price">$<?php echo $row['product_price'];?></h4>
        <a href="single_product.php?product_id=<?php echo $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
      </div>
      <?php }?>
    </div>
  </section>

<?php include('layouts/footer.php');?>