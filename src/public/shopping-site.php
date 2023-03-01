<?php
require_once  "../modules/products.php";
require_once "../modules/notification.php";
require_once "../modules/Account.php";
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

if (isset($_POST['id'])) {

  add_notification('Bought '. $product_table[$_POST['id']]['title']);
  buy_one($_POST['id']);
}

foreach ($product_table as $row) {
  $product_table_html .=

    "<form action=\"#\" method=\"post\"><tr>"
    ."<td><a href=\"product.php?id=".$row['id']."\" >".$row['title']."</a></td>"
    ."<td>".$row['price']."</td>"
    ."<td>".$row['quantity']."</td>"
    ."<td><input type=\"submit\" class=\"button is-small\" name=\"action\" value=\"Add to cart\" >
     <input type='hidden' name='id' value='". $row['id']."'></td>"
    ."</tr></form>";
}

/*  try {
    buy_one(4);
    //ban_literature(3);
  } catch (Exception $e) {
}*/

require_once "../templates/shopping-site.phtml";

function buy_one($id): void{
  $a = Account::check_login();
  if ($a == null) {
    header('Location: /login-page.php');
  }

  $link = Database_manager::get_connection();
  $sql = "UPDATE product_table SET quantity = quantity -1 WHERE d0018e.product_table.id=$id";
  mysqli_query($link, $sql);

  $sql = "INSERT INTO shopping_cart (Account_id, Product_id, Quantity) VALUES (?, ?, 1)
ON DUPLICATE KEY UPDATE
  Quantity     = Quantity+1";
  $stmt = $link->prepare($sql);
  $accountID = $a->getId();
  $stmt->bind_param("ii", $accountID, $id);
  $stmt->execute();

}

function ban_literature($id): void{
  $link = Database_manager::get_connection();
  $sql = "DELETE FROM product_table WHERE d0018e.product_table.id=$id";
  mysqli_query($link, $sql);
}

