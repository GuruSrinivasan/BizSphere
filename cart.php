
<?php include('layouts/header.php');?>


<?php
if(isset($_POST['add_to_cart'])){
  //if the user additionally add product to the cart
  if(isset($_POST['cart'])){

    $products_array_ids=array_column($_SESSION['cart'],'product_id');
    // it checks if user already added this cart to the product
    if(!in_array($_POST['product_id'],$products_array_ids)){
      $product_id=$_POST['product_id'];
      $product_name=$_POST['product_name'];
      $product_price=$_POST['product_price'];
      $product_image=$_POST['product_image'];
      $product_quantity=$_POST['product_quantity'];
      $product_array=array(
      'product_id'=>$product_id,
      'product_name'=>$product_name,
      'product_price'=>$product_price,
      'product_image'=>$product_image,
      'product_quantity'=>$product_quantity
    );
    $_SESSION['cart'][$product_id]=$product_array;
    }//if the user added added the same item to cart for more than one time this else part executes
    else{
      echo '<script>alert("product was already added to the cart");</script>';
    }

  }
  //if this is the first product for the user
  else{
    $product_id=$_POST['product_id'];
    $product_name=$_POST['product_name'];
    $product_price=$_POST['product_price'];
    $product_image=$_POST['product_image'];
    $product_quantity=$_POST['product_quantity'];
    $product_array=array(
      'product_id'=>$product_id,
      'product_name'=>$product_name,
      'product_price'=>$product_price,
      'product_image'=>$product_image,
      'product_quantity'=>$product_quantity
    );
    $_SESSION['cart'][$product_id]=$product_array;
  }
calculateCartTotal();
}//remove product from the cart
else if(isset($_POST['remove_product'])){
  $product_id=$_POST['product_id'];
  unset($_SESSION['cart'][$product_id]);
  calculateCartTotal();
}//edit the quantity
else if(isset($_POST['edit_quantity'])){
  //we get the name and id of the product to be edit
  $product_id=$_POST['product_id'];
  $product_quantity=$_POST['product_quantity'];
  //here we get the product frm the sessin using product id
  $product_arrays=$_SESSION['cart'][$product_id];
  //here we update(overwrite) the exisiting quantity  
  $product_arrays['product_quantity']=$product_quantity;
  //here we eplace the new product array with new product quantity
  $_SESSION['cart'][$product_id]=$product_arrays;
  calculateCartTotal();
}
else{
  //header('location:index.php');
}


function calculateCartTotal(){
  $total=0;
  $total_quantity=0;
  foreach($_SESSION['cart'] as $key =>$value){
    $product=$_SESSION['cart'][$key];
    $price=$product['product_price'];
    $quantity=$product['product_quantity'];
    $total=$total + ($price * $quantity);
    $total_quantity=$total_quantity + $quantity;
  }
  $_SESSION['total']=$total;
  $_SESSION['quantity']=$total_quantity;
}


?>


  <!-- cart -->
  <section class="cart container my-5 py-5">
    <div class="container mt-5">
      <h2 class="font-weight-bold">Your Cart</h2>
    </div>

    <table class="mt-5 pt-5">
      <tr>
        <th>Product</th>
        <th>Quantity</th>
        <th>Subtotal</th>
      </tr>
      <?php if(isset($_SESSION['cart'])){?>
      <?php foreach ($_SESSION['cart'] as $key => $value) {?>
      <tr>
        <td>
          <div class="product-info">
            <img src="assets/imgs/<?php echo $value['product_image'];?>" alt="" srcset="">
            <div>
              <p><?php echo $value['product_name'];?></p>
              <small><span>$</span><?php echo $value['product_price'];?></small>
              <br>
              <form action="cart.php" method="post">
                <input type="hidden" name="product_id" value="<?php echo $value['product_id'];?>">
                <input type="submit" name="remove_product" class="remove-btn" value="Remove">
              </form>
            </div>
          </div>
        </td>
        <td>
          <form action="cart.php" method="post">
            <input type="hidden" name="product_id" value="<?php echo $value['product_id']?>">
            <input type="number" name="product_quantity" value="<?php echo $value['product_quantity'];?>">
            <input name="edit_quantity" type="submit" class="edit-btn" value="Edit">
          </form>
        </td>
        <td>
          <span>$</span>
          <span class="product-price"><?php echo $value['product_price'] * $value['product_quantity'];?></span>
        </td>
      </tr>
      <?php }?>
      <?php }?>
    </table>



    <div class="cart-total">
      <table>
        <tr>
          <td>Total</td>
          <?php if(isset($_SESSION['cart'])){?>
            <td>$<?php echo $_SESSION['total'];?></td>
          <?php }?>
        </tr>
      </table>
    </div>
    <div class="checkout-container">
      <form action="checkout.php" method="POST">
        <input type="submit" name="checkout" class="btn checkout-btn" value="Checkout">
      </form>
    </div>

  </section>

  <?php include('layouts/footer.php');?>