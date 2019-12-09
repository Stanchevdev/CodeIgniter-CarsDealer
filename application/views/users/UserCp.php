<?php
if (!empty($_SESSION['userLogedIn']))
{
  // var_dump($user);
  echo "Heyy " .$user['first_name']. " ";
}
else
{
  redirect(site_url(), 'refresh');
}
?>
