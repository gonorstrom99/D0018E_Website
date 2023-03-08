<?php
require_once "../modules/Database_manager.php";
require_once "../modules/products.php";
require_once "../modules/Account.php";

$header_attr = array(
  "title" => "Webshop",
  "description" => "A webshop",
  "type" => "Webpage",
  "url" => "",
  "image" => "",
  "theme-color" => "#fafafa"
);

$id = $_GET['id'];
$user = Account::check_login();

$link = Database_manager::get_connection();
$sql = "SELECT title, author,price, active, description, quantity FROM product_table WHERE id = ? LIMIT 1";
$stmt = $link->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = mysqli_fetch_array($result);

$comments = get_comments($id);

if (isset($_POST['comment']) && $user != null){
  $userID = $user->getId();
  $user_comment = $comments[$userID] ?? null;
  $rating = $_POST['rating'];

  if ($user_comment != null) {
    // update comment
    $sql = "UPDATE comment SET Comment = ?, Rating = ? WHERE Account_Id = ? AND Product_id = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("siii", $_POST['comment'], $rating, $userID, $id);
  } else {
    $sql = "INSERT INTO comment (product_id, account_id, comment, rating)
          VALUES (?,?,?,?)";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("iisi", $id, $userID, $_POST['comment'], $rating);
  }
  $stmt->execute();
  echo "<meta http-equiv='refresh' content='0'>";

}


require_once "../templates/product.phtml";

