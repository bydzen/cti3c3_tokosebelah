<?php
//fetch.php
include '../database/session.php';
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "
 SELECT * FROM `produk` NATURAL JOIN `order` NATURAL JOIN `user` WHERE id_order LIKE '%".$search."%' AND id_user='$loggedin_id'
 ";
}
else
{
 $query = "
 SELECT * FROM `produk` NATURAL JOIN `order` NATURAL JOIN `user` WHERE id_user='$loggedin_id'
 ";
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
         
            <thead>
                <tr>
                    <th scope="col">No. Resi</th>
                    <th scope="col">Order ID</th>
                    <th scope="col">Product</th>
                    <th scope="col">Picture</th>
                    <th scope="col">Date</th>
                    <th scope="col">Quantities</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
 ';
 while($values = mysqli_fetch_array($result))
 {
  $output .= '
         <tr>
         <td scope="row">'.$values["resi"].'</td>
         <td scope="row">'.$values["id_order"].'</td>
         <td scope="row">'.$values["produk_name"].'</td>
         <td scope="row"><img <?php echo src="data:image/jpeg;base64,'.base64_encode( $values['image']).'" class="img-sm"></td>
         <td scope="row">'.$values["order_date"].'</td>
         <td scope="row">'.$values["quantity"].'</td>
         <td scope="row">RP. '.number_format($values['total_price']).'</td>
         <td scope="row">'.$values["order_status"].'</td>
         </tr>
         </tbody>
         
  ';
 }
 echo $output;
}
else
{
 echo 'Data Not Found';
}

?>