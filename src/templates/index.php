<?php require 'header.php'?>

<p>Hello world!</p>

 <table>
   <tr>
     <th>id</th>
     <th>title</th>
     <th>price</th>
   </tr>
   <?php if (isset($product_table_result)) {
     echo $product_table_result;
   } ?>

 </table>

<?php require 'footer.php'?>
