<?php
  if (isset($_SESSION['userLogedIn']))
  {
?>
    <form action="<?php echo site_url()."loged/NextStep";?>" method="post">
      <input type="text" name="address" placeholder="Delivery Address">
      <input type="submit" name="submitUserInfo" value="Done">
    </form>
<?php
  }
  else
  {
?>
<form action="<?php echo site_url()."NextStep";?>" method="post">
  <input type="text" name="fname" placeholder="First Name">
  <input type="text" name="lname" placeholder="Last Name">
  <input type="text" name="phone" placeholder="Phone Number">
  <input type="text" name="email" placeholder="Email">
  <input type="text" name="address" placeholder="Delivery Address">
  <input type="submit" name="submitUserInfo" value="Done">
</form>
<?php
}
?>
