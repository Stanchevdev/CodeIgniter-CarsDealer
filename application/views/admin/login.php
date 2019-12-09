<?php
  if (isset($warning))
  {
?>
<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong><?php echo $warning; ?></strong>
</div>
<?php
  }
?>
<form action="loginCheck" method="post" style="margin-right:auto; margin-left:auto; width:40%;">
  <fieldset>
    <div class="form-group">
      <h4>Login</h4>
      <input type="text" name="user" class="form-control" placeholder="Username">
      <input type="password" name="pass" class="form-control" placeholder="Pass">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Log in</button>
  </fieldset>
</form>
