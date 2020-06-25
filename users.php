<?php 
  include 'includes/header.inc.php';
  include_once 'classes/dbh.class.php';
  include_once 'classes/users.class.php';
  include_once 'classes/usersview.class.php';
  include_once 'classes/userscontr.class.php';

  // when btn is submitted, check id and value of upgrade column.
  // pass those as arguments to upgradeUserType()

  if (isset($_POST['submit'])) {
    $userId = $_POST['userId'];
    $upgradeType = $_POST['upgrade-type'];
    var_dump ($userId);

    $userUpdate = new UsersContr();
    $userUpdate->updateUserType($upgradeType, $userId);
  }

?>

<div class="wrapper">

  <table>
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