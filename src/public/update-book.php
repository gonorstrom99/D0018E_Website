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

$product = array();
if (isset($_GET['id'])) {

  $sql = "SELECT * FROM product_table WHERE id = ?";
  $stmt = $link->prepare($sql);
  $stmt->bind_param("i", $_GET['id']);
  $stmt->execute();

  $product = $stmt->get_result()->fetch_array();
} else if (isset($_POST["id"])) {
  add_notification(
    "Book edited!",
    "success"
  );
  $sql = "UPDATE product_table SET title = ?, price = ?, quantity = ?, description = ?, author = ? WHERE id = ?";
  $stmt = $link->prepare($sql);
  $stmt->bind_param("ssissi", $_POST['Title'], $_POST['Price'],
    $_POST['Quantity'], $_POST['Description'], $_POST['Author'], $_POST['id']);
  $stmt->execute();
  header('Location: /');
} else {
  header('Location: /');
}


require_once "../templates/update-book.phtml";
