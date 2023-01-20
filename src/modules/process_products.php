<?php

function some_function() {
  $link = mysqli_connect("localhost", "Malkolm", "malle123", "D0018E");
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
