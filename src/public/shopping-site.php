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

$product_table = get_producttable();
$product_table_html = "";
foreach ($product_table as $row) {
  $product_table_html .= "<tr>"
    ."<td>".$row['id']."</td>"
    ."<td>".$row['title']."</td>"
    ."<td>".$row['price']."</td>"
    ."</tr>";
}

try {
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

