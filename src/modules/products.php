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

function get_cart(int $id): array {
  $link = Database_manager::get_connection();
  $sql = "SELECT Product_id, shopping_cart.Quantity, price, title FROM shopping_cart
            JOIN product_table pt on pt.id = shopping_cart.Product_id
            WHERE Account_id = ?;";
  $stmt = $link->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $return = Array();

  if (mysqli_num_rows($result) > 0)
    while($row = mysqli_fetch_array($result))
      $return[] = $row;

  return $return;
}
