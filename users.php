<?php 
  include 'includes/header.inc.php';
  include_once 'classes/dbh.class.php';
  include_once 'classes/users.class.php';
  include_once 'classes/usersview.class.php';
  include_once 'classes/userscontr.class.php';

  // when btn is submitted, check id and value of upgrade column.
  // pass those as arguments to upgradeUserType()

  if (isset($_POST['submit']) && isset($_POST['upgrade-type'])) {
    $userId = $_POST['userId'];
    $upgradeType = $_POST['upgrade-type'];

    $userUpdate = new UsersContr();
    $userUpdate->updateUserType($upgradeType, $userId);
    echo "user successfully updated to " . $upgradeType;
  } elseif (!isset($_POST['upgrade-type'])) {
    echo "pick a type dodo";
  }

?>

<div class="wrapper">
  <div class="message">
    <h2>Admin page</h2>
  </div>

  <table class="admin-table">
    <tr>
      <th>User ID</th>
      <th>Username</th>
      <th>User Since</th>
      <th>User Type</th>
      <th>Upgrade</th>
      <th></th>
    </tr>

  <?php 
    $usersTable = new UsersView();
    $usersTable->displayUserTypeTable();
  ?>

  </table>
 
</div>

<?php 
  include 'includes/footer.inc.php';
?>