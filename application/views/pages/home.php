<h2>It's CodeIgniter</h2>
<p class="lead">Hello there, this is my CodeIgniter project</p>
<?php
if (isset($msg))
{
  if ($msg == 'Your order was sent to the admin')
  {
?>
<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong><?php echo $msg; ?></strong>
</div>
<?php
  }
  elseif ($msg == 'Something missing')
  {
?>
<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong><?php echo $msg; ?></strong>
</div>
<?php
  }
  elseif ($msg == 'You are registered user. Sign in and make your order!')
  {
?>
<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong><?php echo $msg; ?></strong>
</div>
<?php
  }
  elseif ($msg == "You didn't ordered any products")
  {
?>
<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong><?php echo $msg; ?></strong>
</div>
<?php
  }
}
?>
