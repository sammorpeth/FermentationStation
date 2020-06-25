<?php 
  include 'includes/header.inc.php'; 
  include_once 'classes/dbh.class.php';
  include_once 'classes/users.class.php';
  include_once 'classes/usersview.class.php';
  include_once 'classes/userscontr.class.php';

  $username = $_SESSION['username'];
  $userProfile = new UsersView();

  if(isset($_POST['submit-ferment'])) {
    $newFerment = new UsersContr();

    $name = $_POST['name'];
    $startDate = $_POST['start-date'];
    $endDate = $_POST['end-date'];
    $type = $_POST['type'];
    $totalDays = $_POST['total-days'];
    $spices = $_POST['spices'];
    $instructions = $_POST['instructions'];
    $notes = $_POST['notes'];

    $newFerment->createFerment($name, $startDate, $endDate, $type, $totalDays, $spices, $instructions, $notes);
  }
?>

<div class="wrapper">
<!-- Modal -->
  <div class="modal-container" id="modal">
    <div class="modal">
      <div class="modal-header">
        <button class="close-btn" id="close-modal">X</button>
        <h3>Create a new recipe</h3>
      </div>
      <div class="modal-content">
        <form action="" method="post">
          Name: <input type="text" name="name"> <br>
          Start date: <input type="text" name="start-date"> <br>
          End date: <input type="text" name="end-date"> <br>
          Type: <input type="text" name="type"> <br>
          Total days: <input type="text" name="total-days"> <br>
          Spices: <input type="text" name="spices"> <br>
          Notes: <input type="text" name="notes"> <br> <br>
          Instructions: <textarea name="instructions"></textarea>
          <input type="submit" name="submit-ferment" value="Submit"> 
        </form>
      </div>
    </div>
  </div>
<!-- /end Modal -->

<!-- Display users ferments with a recent comment -->
  <div class="col-split">
  <!-- <button class="btn-orange" id="open-modal">Add Ferment </button> -->
    <?php 
      $userProfile->showUserFerments($username);
    ?>
  </div>


  <?php
    // if the current user is the same as a user who is clicked on in a recipe page for example,
    // that is passed in as the user's profile to be displayed. If not it checks the $_GET['username'] variable
    // to see whihc profile had been clicked on in the link. Could maybe make this its own function? 
    $profileUsername = $_GET['username'];
    $currentUsername = $_SESSION['username'];

    if ($profileUsername == $currentUsername) {
      $username = $profileUsername;
    } else {
      $username = $userProfile; 
    }

  ?>
  </div>

</div>

<?php
  include 'includes/footer.inc.php'; 
?>

