<?php

require_once "Database_manager.php";

/**
 * @throws Exception
 */
function some_function(): string {
  $link = Database_manager::get_connection();
  $sql = "SELECT * FROM product_table";
  $result = mysqli_query($link, $sql);
  $return = "";

  if (mysqli_num_rows($result) > 0)
    while($row = mysqli_fetch_array($result))
      $return .= "<tr>"
        . "<td>". $row['id'] . "</td>"
        . "<td>". $row['title'] . "</td>"
        . "<td>". $row['price'] . "</td>\n";

  return $return;
}
