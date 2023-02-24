<?php
require_once "../modules/Database_manager.php";
require_once "../modules/notification.php";
require_once "../modules/Account.php";
require_once  "../modules/products.php";

$account = Account::check_login();

if ($account == null || !$account->isAdmin()) {
  http_response_code(403);
  die('Forbidden');
}

$link = Database_manager::get_connection();

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
  $product_table_html .=

    "<form action=\"#\" method=\"post\"><tr>"
    ."<td>".$row['id']."</td>"
    ."<td><a href=\"product.php?id=".$row['id']."\" >".$row['title']."</a></td>"
    ."<td>".$row['price']."</td>"
    ."<td>".$row['quantity']."</td>"
    ."<td><input type=\"submit\" class=\"button is-small\" name=\"action\" value=\"Update book\" >
     <input type='hidden' name='id' value='". $row['id']."'></td>"
    ."</tr></form>";

}



require_once "../templates/update-book.phtml";
