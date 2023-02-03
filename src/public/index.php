<?php
require_once  "../modules/products.php";

$header_attr = array(
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


require_once "../templates/index.phtml";

