<?php
  if ($msg == NULL)
  {

  }
  else
  {
?>
<div class="alert alert-success">
  <?php echo $msg; ?>
</div>
<?php
  }
?>
<form action="Verification" method="post" style="width:40%; margin:0% auto;">
  <input type="text" name="firstname" class="form-control" value="<?php echo set_value('firstname'); ?>" placeholder="First name"/>
  <span class="text-danger"><?php echo form_error('firstname');?></span>
  <input type="text" name="lastname" class="form-control" value="<?php echo set_value('lastname'); ?>" placeholder="Last name"/>
  <span class="text-danger"><?php echo form_error('lastname');?></span>
  <input type="text" name="email" class="form-control" value="<?php echo set_value('email'); ?>" placeholder="Email"/>
  <span class="text-danger"><?php echo form_error('email');?></span>
  <input type="text" name="phone" class="form-control" value="<?php echo set_value('phone'); ?>" placeholder="Phone Number"/>
  <span class="text-danger"><?php echo form_error('phone');?></span>
  <input type="password" name="pass" class="form-control" placeholder="Pass"/>
  <span class="text-danger"><?php echo form_error('pass');?></span>
  <br/>
  <br/>
  <input type="submit" name="submitRegister" value="Register" class="btn btn-info">
</form>
