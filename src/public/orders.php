<?php
require_once "../modules/Database_manager.php";
require_once "../modules/notification.php";
require_once "../modules/Account.php";
require_once  "../modules/products.php";

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

$orders = null;
if ($account->isAdmin()) {
  if (isset($_POST['edit-status'])) {
    $sql = "UPDATE orders SET Order_status = ? WHERE Order_id = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("si", $_POST['orderstatus'], $_POST['orderid']);
    $stmt->execute();

    echo "<meta http-equiv='refresh' content='0'>";
  }
  $orders = get_orders(null);
} else
  $orders = get_orders($account->getId());

require_once "../templates/orders.phtml";
