<?php
require_once "../modules/Database_manager.php";
$link = Database_manager::get_connection();

$header = array(
  "title" => "Webshop",
  "description" => "A webshop",
  "type" => "Webpage",
  "url" => "",
  "image" => "",
  "theme-color" => "#fafafa"
);
$Username = $_POST["Username"];
$Password = $_POST["Password"];


if (isset($_POST["username"])) {
  echo "I pressed a button!";

  $sql = "INSERT INTO Account (Username, Password)
          VALUES (?,?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $Username, $Password);
  $stmt->execute();
}

require_once "../templates/create-account.phtml";
