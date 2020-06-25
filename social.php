<?php 
  include 'includes/header.inc.php';
  include_once 'classes/dbh.class.php';
  include_once 'classes/users.class.php';
  include_once 'classes/usersview.class.php';
  include_once 'classes/userscontr.class.php';

?>
<div class="wrapper">
  
  <div>
    <h3>Users</h3>

    <?php
      $allUsers = new UsersView();
      $allUsers->displayAllUserProfiles();
    ?>
  </div>
  
</div>

<?php 
  include 'includes/footer.inc.php';
?>