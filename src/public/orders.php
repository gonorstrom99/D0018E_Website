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

if (isset($_POST['edit_order'])) {
  header('Location: /orders.php?Order_id='.$_POST['Order_id']);
}

$order_content_table = get_order_content_table();
$order_table_html = "";
foreach ($order_content_table as $row) {
  $order_table_html .=

    "<form action=\"#\" method=\"post\"><tr>"
    ."<td>".$row['Order_id']."</td>"
    ."<td>".$row['Product_id']."</a></td>"
    ."<td>".$row['Quantity']."</td>"
    ."<td>".$row['Price']."</td>"
    ."<td>"
    ."<input type=\"submit\" class=\"button is-small\" name=\"edit_order\" value=\"Edit Order\" >"
    ."<input type='hidden' name='id' value='". $row['Order_id']."'></td>"
    ."</tr></form>";
}

require_once "../templates/orders.phtml";
