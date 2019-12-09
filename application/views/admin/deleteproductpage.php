<?php
if (!empty($_SESSION['loggedin']))
{
?>
<div class="alert alert-dismissible alert-danger">
  <strong>Do you really want to delete this product?</strong>
  <br/>
  <?php foreach ($carId as $car) : ?>
  <a href="<?php echo site_url();?>products/adminpage/?id=<?php echo $car['id']; ?>" class="btn btn-danger">No!</a>
  <form action="<?php echo site_url();?>products/deleteproduct" method="post">
    <input type="hidden" name="idDel" value="<?php echo $car['id']; ?>">
    <input type="submit" name="submitDelete" value="Yes" class="btn btn-success">
  </form>
<?php endforeach; ?>
</div>
<?php
}
else
{
  redirect(site_url(), 'refresh');
}
?>
