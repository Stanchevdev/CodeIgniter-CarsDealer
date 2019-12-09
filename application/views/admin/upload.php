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
<form action="upload" method="post" style="margin-right:auto; margin-left:auto; width:40%; display:flex;">
      <input type="text" name="name" placeholder="Brand">
      <input type="text" name="model" placeholder="Model">
      <input type="text" name="description" placeholder="Description">
      <input type="text" name="price" placeholder="Price">
      <input type="text" name="miniprice" style="width:50px;" maxlength="2" placeholder="Cents">
      <input type="submit" name="submitUpload" value="Upload">
</form>
