

<?php include('layouts/header.php');?>



<?php

include("server/connection.php");

if(isset($_POST["search"])){
  $product_category=$_POST["category"];
  $product_price=$_POST['price'];
  if(isset($_GET["page_no"]) && $_GET["page_no"] != ""){
    $page_no=$_GET["page_no"];
  }else{
    $page_no=1;
  }
  $stmt = $conn->prepare("SELECT COUNT(*) FROM products WHERE product_category = ? AND product_price<= ?");
  $stmt->bind_param("si", $product_category,$product_price);
  $stmt->execute();
  $stmt->bind_result($total_records);
  $stmt->store_result();
  $stmt->fetch();
  
  
  
  $total_records_per_page=8;
  $offset=($page_no-1) * $total_records_per_page;
  
  $previous_page=$page_no-1;
  $next_page=$page_no+1;
  $adjacents="2";
  $total_no_of_pages=ceil($total_records/$total_records_per_page);
  
  
  
  $stmt1= $conn->prepare("SELECT * FROM PRODUCTS WHERE product_category = ? AND product_price<= ? LIMIT $offset,$total_records_per_page ");
  $stmt1->bind_param("si", $product_category,$product_price);
  $stmt1->execute();
  $products = $stmt1->get_result();

}else{



if(isset($_GET["page_no"]) && $_GET["page_no"] != ""){
  $page_no=$_GET["page_no"];
}else{
  $page_no=1;
}
$stmt1= $conn->prepare("SELECT count(*) AS total_records FROM products");
$stmt1->execute();
$stmt1->bind_result($total_records);
$stmt1->store_result();
$stmt1->fetch();



$total_records_per_page=8;
$offset=($page_no-1) * $total_records_per_page;

$previous_page=$page_no-1;
$next_page=$page_no+1;
$adjacents="2";
$total_no_of_pages=ceil($total_records/$total_records_per_page);



$stmt2=$conn->prepare("SELECT * FROM PRODUCTS LIMIT $offset,$total_records_per_page");
$stmt2->execute();
$products=$stmt2->get_result();







}
?>




<div class="filter-and-products-container">
<!-- Filter -->
<section id="search" class="my-5 py-5 ms-2" style="float:left;">
  <div class="container mt-5 py-5">
    <h3>Filter Products</h3>
    <hr>
  </div>
  <form method="POST" action="shop.php">
    <div class="row mx-auto container">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <p>Category</p>
        <div class="form-check">
          <input type="radio" value="shoe" name="category" id="category_one" class="form-check-input" <?php if(isset($product_category) && $product_category=="shoe"){echo "checked";}?>>
          <label for="flexRadioDefault1" class="form-check-label">
            Shoes
          </label>
        </div>
        <div class="form-check">
          <input type="radio" value="dress" name="category" id="category_two" class="form-check-input" <?php if(isset($product_category) && $product_category=="dress"){echo "checked";}?>>
          <label for="flexRadioDefault2" class="form-check-label">
            Dresses
          </label>
        </div>
        <div class="form-check">
          <input type="radio" value="watch" name="category" id="category_two" class="form-check-input" <?php if(isset($product_category) && $product_category=="watch"){echo "checked";}?>>
          <label for="flexRadioDefault2" class="form-check-label">
            Watches
          </label>
        </div>
        <div class="form-check">
          <input type="radio" value="bag" name="category" id="category_two" class="form-check-input" <?php if(isset($product_category) && $product_category=="bag"){echo "checked";}?>>
          <label for="flexRadioDefault2" class="form-check-label">
            Bags
          </label>
        </div>
      </div>
    </div>


    <div class="row mx-auto container">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <p>Price</p>
        <input type="range" class="form-range w-50" name="price" min="1" value="<?php if(isset($product_price)){ echo $product_price;}else{ echo "50";}?>" max="1000" id="customRange2">
        <div class="w-50">
          <span style="float:left">1</span>
          <span style="float:right">1000</span>
        </div>
      </div>
    </div>



    <div class="form-group my-3 mx-3">
      <input type="submit" value="Filter" name="search" class="btn btn-primary">
    </div>
  </form>




</section>
  <!-- featured -->
  <section id="featured" class="my-5 py-5" style="width:90%;">
    <div class="container mt-5 py-5">
      <h3>Our Products</h3>
      <hr>
      <p>Here you can check our featured products</p>
    </div>
    <div class="row mx-auto container-fluid">
      <?php while($row=$products->fetch_assoc()){?>
        <div onclick="window.location.href='single_product.php';"
          class="product col-lg-3 col-md-4 col-sm-12 text-center">
          <img src="assets/imgs/<?php echo $row['product_image'];?>" class="img-fluid mb-3" alt="">
          <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
          <h5 class="p-name"><?php echo $row['product_name'];?></h5>
          <h4 class="p-price">$<?php echo $row['product_price'];?></h4>
          <a class="btn buy-btn" href="<?php echo 'single_product.php?product_id='.$row['product_id'];?>">Buy Now</a>
        </div>
      <?php }?>
      <nav aria-label="page navigation example">
        <ul class="pagination mt-5">
          <li class="page-item <?php if($page_no<=1){echo 'disabled';}?>">
            <a class="page-link" href="<?php if($page_no<=1){echo 'disabled';}else{ echo '?page_no='.$page_no-1;}?>">Previous</a>
          </li>
          <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
          <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>
          <?php if($page_no>=3){?>
            <li class="page-item"><a class="page-link" href="#">...</a></li>
            <li class="page-item"><a class="page-link" href="<?php echo "?page_no=".$page_no?>"><?php echo $page_no;?></a></li>
          <?php }?>
          <li class="page-item <?php if($page_no>=$total_no_of_pages){echo 'disabled';}?>">
            <a class="page-link" href="<?php if($page_no>=$total_no_of_pages){echo 'disabled';}else{ echo '?page_no='.$page_no+1;}?>">Next</a>
          </li>
        </ul>
      </nav>
    </div>
  </section>


  </div>







  <?php include('layouts/footer.php');?>