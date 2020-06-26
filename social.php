<?php 
  include 'includes/header.inc.php';
  include_once 'classes/dbh.class.php';
  include_once 'classes/users.class.php';
  include_once 'classes/usersview.class.php';
  include_once 'classes/userscontr.class.php';

?>
<div class="wrapper">

    <div class="message">
      <div >
        <h2>Users</h2>
      </div>
      <div >
        <h2>Users's Recipes</h2>
      </div>
    </div>
    <div class="social-col-split">
      <?php
        $allUsers = new UsersView();
        $allUsers->displayAllUserProfiles();
      ?>
    </div>
  
</div>

<?php 
  include 'includes/footer.inc.php';
?>