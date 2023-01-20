<?php
require_once  "../modules/products.php";

$header = array(
  "title" => "Webshop",
  "description" => "A webshop",
  "type" => "Webpage",
  "url" => "",
  "image" => "",
  "theme-color" => "#fafafa"
);

$product_table_result = some_function();

require_once "../templates/index.phtml";

