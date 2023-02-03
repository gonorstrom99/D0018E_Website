<?php

require_once "Database_manager.php";

/**
 * @throws Exception
 */
function get_producttable(): array {
  $link = Database_manager::get_connection();
  $sql = "SELECT * FROM product_table";
  $result = mysqli_query($link, $sql);
  $return = array();

  if (mysqli_num_rows($result) > 0)
    while($row = mysqli_fetch_array($result))
      array_push($return, $row);

  return $return;
}
