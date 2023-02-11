<?php
require_once "../modules/Database_manager.php";
require_once "../modules/notification.php";
$link = Database_manager::get_connection();

$header_attr = array(
  "title" => "Webshop",
  "description" => "A webshop",
  "type" => "Webpage",
  "url" => "",
  "image" => "",
  "theme-color" => "#fafafa"
);


if (isset($_POST["Title"])) {
  add_notification(
    "Book added!",
    "success"
  );
  $Title = $_POST["Title"];
  $Price = $_POST["Price"];
  $Quantity = $_POST["Quantity"];
  $sql = "INSERT INTO product_table (Title, Price, Quantity)
          VALUES (?,?,?)";
  $stmt = $link->prepare($sql);
  $stmt->bind_param("ssi", $Title, $Price, $Quantity);
  $stmt->execute();
}

require_once "../templates/add-book.phtml";
