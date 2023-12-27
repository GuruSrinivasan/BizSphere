

<?php include('layouts/header.php');?>



<?php
include("server/connection.php");
if(isset($_GET['product_id'])){
$product_id = $_GET['product_id'];
$stmt = $conn->prepare("SELECT * FROM products WHERE product_id=?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$products = $stmt->get_result();
}
else{
  header("location:index.php");
}

?>



  <!-- single product -->

  <section class="container single-product my-5 pt-5">
    <div class="row mt-5">
      <?php while($row=$products->fetch_assoc()){?>
      <div class="col-lg-5 col-md-6 col-sm-12">
        <img class="img-fluid pb-1 single-img" src="assets/imgs/<?php echo $row['product_image']?>" id="mainImg" class="img-fluid mb-3"
          alt="">
        <div class="small-img-group">
          <div class="small-img-col">
            <img src="assets/imgs/<?php echo $row['product_image']?>" width="70%" class="small-img">
          </div>
          <div class="small-img-col">
            <img src="assets/imgs/<?php echo $row['product_image2']?>" width="70%" class="small-img">
          </div>
          <div class="small-img-col">
            <img src="assets/imgs/<?php echo $row['product_image3']?>" width="70%" class="small-img">
          </div>
          <div class="small-img-col">
            <img src="assets/imgs/<?php echo $row['product_image4']?>" width="70%" class="small-img">
          </div>
        </div>
      </div>


      <div class="col-lg-6 col-md-12 col-sm-12">
        <h6 class="text-uppercase"><?php echo $row['product_category']?></h6>
        <h3 class="py-4"><?php echo $row['product_name']?></h3>
        <h2>$<?php echo $row['product_price'];?></h2>
        <form action="cart.php" method="post">
          <input type="hidden" name="product_id" value="<?php echo $row['product_id']?>">
          <input type="hidden" name="product_image" value="<?php echo $row['product_image']?>">
          <input type="hidden" name="product_name" value="<?php echo $row['product_name']?>">
          <input type="hidden" name="product_price" value="<?php echo $row['product_price'];?>">
          <input type="number" value="1" name="product_quantity" id="">
          
          
          <!-- my -->
          <input type="hidden" name="cart_user_id" value="<?php echo $user_id?>">


          <button class="buy-btn" type="submit" name="add_to_cart">Add To Cart</button>
        </form>
        <h4 class="mt-5 mb-5">Product Details</h4>
        <span><?php echo $row['product_description'];?></span>
      </div>
      <?php }?>
    </div>
    <!-- Related product -->
  </section>
  <section id="related-products" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
      <h3>Related Products</h3>
      <hr class="mx-auto">
    </div>
    <div class="row mx-auto container-fluid">
      <div class="product col-lg-3 col-md-4 col-sm-12 text-center">
        <img src="assets/imgs/featured1.jpeg" class="img-fluid mb-3" alt="">
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name"> Puma Bag</h5>
        <h4 class="p-price">$120</h4>
        <button class="buy-btn">Buy Now</button>
      </div>
      <div class="product col-lg-3 col-md-4 col-sm-12 text-center">
        <img src="assets/imgs/featured2.jpeg" class="img-fluid mb-3" alt="">
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name">Tiny Puma Bag</h5>
        <h4 class="p-price">$100</h4>
        <button class="buy-btn">Buy Now</button>
      </div>
      <div class="product col-lg-3 col-md-4 col-sm-12 text-center">
        <img src="assets/imgs/featured3.jpeg" class="img-fluid mb-3" alt="">
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name">Lunch Bag</h5>
        <h4 class="p-price">$60</h4>
        <button class="buy-btn">Buy Now</button>
      </div>
      <div class="product col-lg-3 col-md-4 col-sm-12 text-center">
        <img src="assets/imgs/featured4.jpeg" class="img-fluid mb-3" alt="">
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name">Casual Shoe</h5>
        <h4 class="p-price">$150</h4>
        <button class="buy-btn">Buy Now</button>
      </div>
    </div>
  </section>



  <footer class="mt-5 py-5">
    <div class="row container mx-auto pt-5">
      <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <img class="logo" src="assets/imgs/logo.png" alt="">
        <p class="pt-3">we provide the best products for the most affordable prices</p>
      </div>
      <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <h5 class="pb-2">Featured</h5>
        <ul class="text-uppercase">
          <li><a href="#">men</a></li>
          <li><a href="#">women</a></li>
          <li><a href="#">boys</a></li>
          <li><a href="#">girls</a></li>
          <li><a href="#">new arrivals</a></li>
          <li><a href="#">clothes</a></li>
        </ul>
      </div>
      <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <h5 class="pb-2">Contact Us</h5>
        <div>
          <h6 class="text-uppercase">Address</h6>
          <p>1234 Street Name,City</p>
        </div>
        <div>
          <h6 class="text-uppercase">phone</h6>
          <p>1234567890</p>
        </div>
        <div>
          <h6 class="text-uppercase">Email</h6>
          <p>info@email.com</p>
        </div>
      </div>
      <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <h5 class="pb-2">Instagram</h5>
        <div class="row">
          <img src="assets/imgs/featured1.jpeg" class="img-fluid w-25 h-100 m-2" alt="">
          <img src="assets/imgs/featured2.jpeg" class="img-fluid w-25 h-100 m-2" alt="">
          <img src="assets/imgs/featured3.jpeg" class="img-fluid w-25 h-100 m-2" alt="">
          <img src="assets/imgs/featured4.jpeg" class="img-fluid w-25 h-100 m-2" alt="">
          <img src="assets/imgs/clothes4.jpeg" class="img-fluid w-25 h-100 m-2" alt="">
        </div>
      </div>
    </div>



    <div class="copyright mt-5">
      <div class="row container mx-auto">
        <div class=" col-lg-3 col-md-5 col-sm-12 mb-4">
          <img src="assets/imgs/payments.png" alt="">
        </div>
        <div class=" col-lg-3 col-md-5 col-sm-12 mt-2 text-nowrap mx-5">
          <p>eCommerce @ 2025 All Right Reserved</p>
        </div>
        <div class=" col-lg-3 col-md-5 col-sm-12 mb-4">
          <a href="#"><i class="fab fa-facebook"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
      </div>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <script>
    var mainImg = document.getElementById('mainImg');
    var smallImg = document.getElementsByClassName('small-img');
    for (let i = 0; i < 4; i++) {
      smallImg[i].onclick = function () {
        mainImg.src = smallImg[i].src;
      }
    }
  </script>
</body>

</html>