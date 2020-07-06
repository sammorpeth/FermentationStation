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

    $user = $_SESSION['username'];
    $name = $_POST['name'];
    $startDate = $_POST['start-date'];
    $endDate = $_POST['end-date'];
    $type = $_POST['type'];
    $totalDays = $_POST['total-days'];
    $spices = $_POST['spices'];
    $instructions = $_POST['instructions'];
    $notes = $_POST['notes'];

    $newFerment->createFerment($user, $name, $startDate, $endDate, $type, $totalDays, $spices, $instructions, $notes);
  }
?>

<div class="wrapper">

<!-- Display users ferments with a recent comment -->
<div class="message">
    <?php 
      if(isset($_GET['username'])) {
        echo "<h2>" . $name . " Recipes";
      } else {
        echo "<h2>" . $name . " Recipes" . 
        "<button class='btn-orange' id='open-modal'>Add Recipe +</button>";
      }
    ?>
  </div> <!-- /end messsage -->
  <div class="col-split">
    <?php 
      $userProfile->showUserFerments($username);
    ?>
  </div>
 

</div>
<!-- Modal -->
  <div class="modal-container" id="modal">
    <div class="modal">
      <div class="modal-header">
        <button class="close-btn" id="close-modal">X</button>
        <h3>Create a new recipe</h3>
      </div>
      <div class="modal-content">
        <form action="" method="post" class="modal-form">
        <div>
          <label for="name">Name<label>
          <input class="form-input" type="text" name="name" placeholder="Sam's Sauerkraut">
        </div>
        <div>
          <label for="start-date">Start date<label>
          <input class="form-input" type="text" name="start-date" placeholder="2020-06-18"> 
        </div>
        <div>
          <label for="end-date">End date<label>
          <input class="form-input" type="text" name="end-date"> 
        </div>
        <div>
          <label for="type">Type<label>
          <input class="form-input" type="text" name="type">
        </div>
        <div>
          <label for="total-days">Total days<label>
          <input class="form-input" type="text" name="total-days">
        </div>
        <div>
          <label for="spices">Spices<label>
          <input class="form-input" type="text" name="spices" placeholder="Use a comma to separate. E.g. 'cumin, dill'"> 
        </div>
        <div>
          <label for="notes">Notes<label>
          <input class="form-input" type="text" name="notes">
        </div>
        <div>
          <label for="instructions">Instructions<label>
          <textarea name="instructions"></textarea>
        </div>
          <input class="btn-orange" type="submit" name="submit-ferment" value="Submit"> 
        </form>
      </div>
    </div>
  </div>
<!-- /end Modal -->



<script src="carousel.js"></script>
<?php
  include 'includes/footer.inc.php'; 
?>

