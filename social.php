<?php 
  include 'includes/header.inc.php';
  include_once 'classes/dbh.class.php';
  include_once 'classes/users.class.php';
  include_once 'classes/usersview.class.php';
  include_once 'classes/userscontr.class.php';

?>

<div class="user-profiles">
  <?php
    $allUsers = new UsersView();
    $allUsers->displayAllUserProfiles();
  ?>
</div>

<?php 
  include 'includes/footer.inc.php';
?>