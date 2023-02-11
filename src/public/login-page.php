<?php
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
  $Username = $_POST["Username"];
  $Password = $_POST["Password"];

  $a = Account::login($Username, $Password);
  if ($a == null) {
    add_notification("No such account", "danger");
  }else{
    header('Location: /');
  }
}

require_once "../templates/login-page.phtml";
