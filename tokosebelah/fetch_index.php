<?php
//fetch.php
include 'database/config.php';
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "
  SELECT * FROM produk 
  WHERE produk_name LIKE '%".$search."%'";
}
else
{
 $query = "
    SELECT * FROM produk ORDER BY id_produk DESC
 ";
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{
 while($gallery = mysqli_fetch_array($result))
 {
  $output .= '
   <div class="card col-sm-2 bg-dark text-white" style="width: 18rem;margin-left:4px;margin-top:10px;">
         <a href="addto.php?id='.$gallery['id_produk'].'"><img <?php echo src="data:image/jpeg;base64,'.base64_encode( $gallery['image']).'" alt="bag"  class="card-img-top"></a>
                 <div class="card-body" style="width: 18rem">
                      <h5 class="card-title" style="font-size:15px;" >'.$gallery['produk_name'].'</h5>
                      <h5 class="card-title" style="font-size:14px;">RP. '.number_format($gallery['price']).'</h5>
                      <a href="addto2.php?id='.$gallery['id_produk'].'" class="btn btn buttonproduk" style="background:#DA7E5C;color:white;">Add to Cart</a>
            </div>
            </div>
  ';
 }
 echo $output;
}
else
{
    echo'
    <div class=" text-white" style="width: 18rem;margin-left:4px;margin-top:10px;padding-top:5000px;">
        
             </div>
             <h5 class="card-title text-white" style="font-size:15px;" >Data Tidak Ditemukan</h5>
   ';
}

?>