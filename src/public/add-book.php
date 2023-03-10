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
    ."<td><input type=\"submit\" class=\"button is-small\" name=\"action\" value=\"Delete book\" >
     <input type='hidden' name='id' value='". $row['id']."'></td>"
    ."</tr></form>";
}

if (isset($_POST["Title"])) {
  add_notification(
    "Book added!",
    "success"
  );
  $Title = $_POST["Title"];
  $Price = $_POST["Price"];
  $Quantity = $_POST["Quantity"];
  $Description = $_POST["Description"];
  $Author = $_POST["Author"];
  $sql = "INSERT INTO product_table (Title, Price, Quantity, description, author)
          VALUES (?,?,?,?,?)";
  $stmt = $link->prepare($sql);
  $stmt->bind_param("ssiss", $Title, $Price, $Quantity, $Description, $Author);
  $stmt->execute();
}

require_once "../templates/add-book.phtml";
