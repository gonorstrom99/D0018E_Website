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


if (isset($_POST["Username"])) {
  $Username = $_POST["Username"];
  $Password = $_POST["Password"];
  echo "Account added";

  $sql = "INSERT INTO Account (Username, Password)
          VALUES (?,?)";
  $stmt = $link->prepare($sql);
  $stmt->bind_param("ss", $Username, $Password);
  $stmt->execute();
}

require_once "../templates/create-account.phtml";
