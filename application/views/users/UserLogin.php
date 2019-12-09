<?php
  if ($msg == NULL)
  {

  }
  elseif ($msg == 'Wrong password')
  {
?>
  <div class="alert alert-danger">
    <?php echo $msg; ?>
  </div>
<?php
  }
  elseif ($msg = 'Wrong email')
  {
?>
  <div class="alert alert-danger">
    <?php echo $msg; ?>
  </div>
<?php
  }
?>

<form action="LoginCheck" method="post" style="width:40%; margin:0% auto;">
  <input type="text" name="email" class="form-control" value="<?php echo set_value('email'); ?>" placeholder="Email"/>
  <span class="text-danger"><?php echo form_error('email');?></span>
  <input type="password" name="pass" class="form-control" placeholder="Pass"/>
  <span class="text-danger"><?php echo form_error('pass');?></span>
  <br/>
  <br/>
  <input type="submit" name="submitUserLogin" value="Login" class="btn btn-info">
</form>
