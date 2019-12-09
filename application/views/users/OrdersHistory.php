<?php
if ($order == 'NULL')
{
  echo "You haven't made orders";
}
else
{
?>
<h1>Orders</h1>
<br/>
<?php foreach ($order as $o)
{ ?>
  <a href="<?php echo site_url();?>order/?id=<?php echo $o['id'];?>" style="text-decoration:none;">
  <ul class="list-group" style="width:40%; font-size:2vw;">
    <li class="list-group-item d-flex justify-content-between align-items-center">
      ID
      <span class="badge badge-primary badge-pill"><?php echo $o['id'];?></span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
      Price
      <span class="badge badge-primary badge-pill"><?php echo $o['computed_price'];?> лв.</span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
      Date of order
      <span class="badge badge-primary badge-pill"><?php echo $o['order_date'];?></span>
    </li>
  </ul>
  </a>
</br>
<?php
  }
}
?>
