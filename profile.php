<?php 
  include 'includes/header.inc.php'; 
  include_once 'classes/dbh.class.php';
  include_once 'classes/users.class.php';
  include_once 'classes/usersview.class.php';
  include_once 'classes/userscontr.class.php';

  // if get var is not set use session var for username
  // when a link to a user's page is clicked on a $_GET['username'] var is provided. However, if a user clicks on the "Your Profile" link
  // in the nav bar then the info is formatted using the $_SESSION['username'] var as we know who the user is from this.

  if (!isset($_GET['username'])) {
    $username = $_SESSION['username'];
    // Change the $name var so it doesn't say something like "Dosed's profile" when Dosed is logged in.
    $name = 'Your';
  } else {
    $username = $_GET['username'];
    $name = $username . "'s";
  }

  // $username = $_SESSION['username'];
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
  <div class="message">
    <?php echo "<h2>" . $name . " Recipes"?>
  </div> <!-- /end messsage -->
  <div class="col-split">
  <!-- <button class="btn-orange" id="open-modal">Add Ferment </button> -->
    <?php 
      $userProfile->showUserFerments($username);
    ?>
  </div>
 

</div>

<script src="carousel.js"></script>
<?php
  include 'includes/footer.inc.php'; 
?>

