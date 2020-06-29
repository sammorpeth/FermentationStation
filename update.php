
<?php
  include 'includes/header.inc.php';
  include_once 'classes/users.class.php';
  include_once 'classes/usersview.class.php';
  include_once 'classes/userscontr.class.php';

  $hello = 'bingo';

  if (isset($_POST['update'])) {

      $name = $_POST['name'];
      $startDate = $_POST['start-date'];
      $endDate = $_POST['end-date'];
      $type = $_POST['type'];
      $totalDays = $_POST['total-days'];
      $spices = $_POST['spices'];
      $notes = $_POST['notes'];
      $idFerment = $_GET['idFerment'];
  
      $newFerment = new UsersContr();
      $newFerment->insertUpdate($name, $startDate, $endDate, $type, $totalDays, 
                                  $spices, $notes, $idFerment);

      $newMsg = new UsersView();
      $newMsg->showMsg($idFerment, "updated");
    }
   
  
?>
<div class="container">

  <h1>Update entry:
  <?php 
    // this is set before the update button is submitted which explains why it was returning
    // null before.
    $idFerment = $_GET['idFerment'];
    $entry = new UsersView();
    $entry->showFermentName($idFerment);
  ?>
  </h1>

  <form action="" method="post">
    Name: <input type="text" name="name"> <br>
    Start date: <input type="text" name="start-date"> <br>
    End date: <input type="text" name="end-date"> <br>
    Type: <input type="text" name="type"> <br>
    Total days: <input type="text" name="total-days"> <br>
    Spices: <input type="text" name="spices"> <br>
    Notes: <input type="text" name="notes"> <br> <br>
    <input type="submit" name="update" value="Update Entry"> 
  </form>

 



<?php
  include 'includes/footer.inc.php';
?>

