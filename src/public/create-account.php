<?php
require_once "../modules/Database_manager.php";
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


if (isset($_POST["Username"])) {

  add_notification(
    "Account created!",
    "success"
  );
  $Username = $_POST["Username"];
  $Password = $_POST["Password"];

  Account::create_account($Username, $Password);
}

require_once "../templates/create-account.phtml";
