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

   $sql = "SELECT ID FROM account WHERE (Username = '$Username') AND (Password = '$Password')";

  $stmt = $link->prepare($sql);
  $stmt->bind_param("ss", $Username, $Password);
  $id = $stmt->execute();
  echo($id);

}

require_once "../templates/login-page.phtml";
