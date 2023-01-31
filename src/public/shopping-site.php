<?php
require_once  "../modules/products.php";

$header = array(
  "title" => "Webshop",
  "description" => "A webshop",
  "type" => "Webpage",
  "url" => "",
  "image" => "",
  "theme-color" => "#fafafa"
);

try {
  $product_table_result = some_function();
  buy_one(4);
  //ban_literature(3);
} catch (Exception $e) {
}

require_once "../templates/shopping-site.phtml";

function buy_one($id): void{
  $link = Database_manager::get_connection();
  $sql = "UPDATE product_table SET quantity = quantity -1 WHERE d0018e.product_table.id=$id";
  mysqli_query($link, $sql);
}

function ban_literature($id): void{
  $link = Database_manager::get_connection();
  $sql = "DELETE FROM product_table WHERE d0018e.product_table.id=$id";
  mysqli_query($link, $sql);
}

