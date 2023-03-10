<?php
require_once "Account.php";
require_once "Database_manager.php";
require_once "notification.php";

function update_cart(Account $a, Array $cart) {
  $id = $a->getId();

  $link = Database_manager::get_connection();
  $sql = "SELECT Product_id, Quantity FROM shopping_cart WHERE Account_Id = ?";
  $stmt = $link->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
      $pid = $row[0];
      (int)$quantity = $cart[$pid];
      $db_quantity = $row[1];

      if (isset($quantity)) {

        if ($quantity <= 0) {
          $sql = "DELETE FROM shopping_cart WHERE Account_Id = ? AND Product_id = ?";
          $stmt = $link->prepare($sql);
          $stmt->bind_param("ii", $id, $pid);
          $stmt->execute();

        } elseif ($quantity != $db_quantity) {
          $sql = "UPDATE shopping_cart SET quantity = ? WHERE Account_Id = ? AND Product_id = ?";
          $stmt = $link->prepare($sql);
          $stmt->bind_param("iii", $quantity, $id, $pid);
          $stmt->execute();
        }
      }
    }
  }
  add_notification("Updated cart", "success");
}
function create_order(Account $a):int|null{
  $id = $a->getId();

  $link = Database_manager::get_connection();
  $sql = "SELECT shopping_cart.Product_id, shopping_cart.Quantity, product_table.price
            FROM shopping_cart JOIN product_table ON shopping_cart.Product_id = product_table.id
            WHERE Account_Id = ?";
  $stmt = $link->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();

  if($result->num_rows){
    $sql = "CALL create_order(?)";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    add_notification("Created order!", "success");
  } else {
    add_notification("Couldn't create order", "danger");
  }

  return null;
}
