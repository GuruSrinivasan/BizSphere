<?php

include("connection.php");
$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='dress' LIMIT 4");

$stmt->execute();
$dress_products=$stmt->get_result();

?>