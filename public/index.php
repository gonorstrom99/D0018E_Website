<?php
include_once("../modules/process_products.php");

$header = array(
  "title" => "Webshop",
  "description" => "A webshop",
  "type" => "Webpage",
  "url" => "",
  "image" => "",
  "theme-color" => "#fafafa"
);

$product_table_result = some_function();

include_once("../templates/index.php");
