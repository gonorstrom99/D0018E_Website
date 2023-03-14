<?php
require_once "../modules/Database_manager.php";
require_once "../modules/notification.php";
require_once "../modules/Account.php";
require_once "../modules/products.php";

$account = Account::check_login();

if ($account == null) {
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

$order = array();
$order_contents = array();

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $stmt = null;

  $sql = "SELECT * FROM orders WHERE Order_id = ? LIMIT 1";
  $stmt = $link->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $order = $stmt->get_result()->fetch_array();

  if ($account->isAdmin() || $order['Account_id'] == $account->getId()) {
    $order_contents = get_order_content_table($id);
  } else {
    http_response_code(403);
    die('Forbidden');
  }

} else {
  header('Location: /orders.php');
}


require_once "../templates/order.phtml";
