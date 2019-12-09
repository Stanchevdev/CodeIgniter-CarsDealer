<?php
$VAT = 20;
if ($orderline != 'NULL')
{
?>
<h1>Products for this order</h1>
<br/>
<?php foreach ($orderline as $product)
{
  $VatPrice = ($product['single_price'] / 100) * $VAT;
?>
<a href="<?php echo site_url(); ?>products/view/?id=<?php echo $product['product_id']; ?>">
  <ul class="list-group" style="width:40%; font-size:2vw;">
    <li class="list-group-item d-flex justify-content-between align-items-center">
      ID
      <span class="badge badge-primary badge-pill"><?php echo $product['id'];?></span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
      Price
      <span class="badge badge-primary badge-pill"><?php echo $product['single_price'];?> лв.</span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
      VAT value
      <span class="badge badge-primary badge-pill"><?php echo $VatPrice; ?> лв.</span>
    </li>
  </ul>
  </a>
</br>
<?php
  }
}
else
{
  echo "<p>You haven't made any orders</p>";
}
?>
