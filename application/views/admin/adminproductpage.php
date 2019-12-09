<?php
if (!empty($_SESSION['loggedin']))
{
  if(isset($warning))
  {
?>
<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong><?php echo $warning; ?></strong>
</div>
<?php
  }
  elseif (isset($msg))
  {
?>
    <div class="alert alert-dismissible alert-success">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong><?php echo $msg; ?></strong>
    </div>
<?php
  }
?>
<a href="<?php echo site_url();?>admin/login" class="btn btn-primary">Back to the list</a>
  <form action="<?php echo site_url();?>products/edit" method="post">
  <br/><br/><br/><br/><br/>
  <?php foreach ($carId as $car) : ?>
    <div class="card mb-3" style="width:30%;">
      <input type="text" name="editName" class="card-header" placeholder="<?php echo $car['name']; ?>" value="<?php echo $car['name']; ?>">
      <input type="text" name="editModel" class="card-header" placeholder="<?php echo $car['model']; ?>" value="<?php echo $car['model']; ?>">
      <img style="height: 200px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22318%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20318%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_158bd1d28ef%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A16pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_158bd1d28ef%22%3E%3Crect%20width%3D%22318%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22129.359375%22%20y%3D%2297.35%22%3EImage%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Card image">
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Price:<input type="text" name="editPrice" class="card-header" placeholder="<?php echo $car['price']; ?>" value="<?php echo $car['price']; ?>"></li>
      </ul>
    </div>
    <input type="hidden" name="id" value="<?php echo $car['id'];?>">
    <input type="submit" name="submitEdit" value="Edit">
  </form>
    <br/>
  <?php endforeach;
}
else
{
  redirect(site_url(), 'refresh');
}
?>
