<?php
  if (!empty($_SESSION['loggedin']))
  {
?>
<h1 style="margin-bottom:3%;">Latest Uploads</h1>
<?php
  if (isset($msg))
  {
?>
<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong><?php echo $msg; ?></strong>
</div>
<?php
  }
?>
<div id="productContainer">
<?php foreach ($cars as $car) : ?>
    <div class="myclass" style="width:30%;" onclick="changeColor(<?php echo $car['id']; ?>)" id="<?php echo $car['id']; ?>">
    <h3 class="card-header"><a href="<?php echo site_url();?>products/adminpage/?id=<?php echo $car['id'];?>" class="card-link"><?php echo $car['id']?> <?php echo $car['name']; ?> <?php echo $car['model']; ?></a></h3>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">Price: <?php echo $car['price']; ?></li>
    </ul>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">
        <a href="<?php echo site_url();?>products/delete/?id=<?php echo $car['id'];?>" class="btn btn-danger">Delete</a>
      </li>
    </ul>
  </div>
  <br/>
<?php
endforeach;
?>
</div>
  <button type="button" onclick='selectAll()' class="btn btn-success">Select All</button>
  <button type="button" onclick='UnSelectAll()' class="btn btn-info">Unselect All</button>
  <br/>
  <br/>
  <div id="inner"></div>
<?php
}
else {
  redirect(site_url(), 'refresh');
}
?>
