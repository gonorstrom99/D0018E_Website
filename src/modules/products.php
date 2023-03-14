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
      $return[$row['id']] = $row;

  return $return;
}

function get_orders($id): array {
  $link = Database_manager::get_connection();

  if ($id == null) {
    $sql = "SELECT * FROM orders JOIN account a
                ON a.ID = orders.Account_id";
    $stmt = $link->prepare($sql);
  } else {
    $sql = "SELECT * FROM orders JOIN account a
                ON a.ID = orders.Account_id
            WHERE Account_id = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("i", $id);
  }

  $stmt->execute();
  $result = $stmt->get_result();
  $return = array();

  if (mysqli_num_rows($result) > 0)
    while($row = mysqli_fetch_array($result))
      $return[] = $row;
  return $return;
}

function get_order_content_table($id): array {
  $link = Database_manager::get_connection();
  $sql = "SELECT * FROM order_content
            JOIN d0018e.product_table pt
                ON order_content.Product_id = pt.id
            WHERE Order_id = ?";
  $stmt = $link->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $return = array();

  if (mysqli_num_rows($result) > 0)
    while($row = mysqli_fetch_array($result))
      $return[] = $row;
  return $return;
}

function get_comments($Product_id): array {
  $link = Database_manager::get_connection();
  $sql = "SELECT * FROM comment JOIN account  ON account.id = comment.Account_id
            WHERE Product_id = ? ORDER BY datetime ASC";
  $stmt = $link->prepare($sql);
  $stmt->bind_param("i", $Product_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $return = Array();

  if (mysqli_num_rows($result) > 0)
    while($row = mysqli_fetch_array($result))
      $return[] = $row;

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
