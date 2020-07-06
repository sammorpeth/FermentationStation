<?php
  include 'includes/header.inc.php';
  include_once 'classes/users.class.php';
  include_once 'classes/usersview.class.php';
  include_once 'classes/userscontr.class.php';

  // require 'includes/auth.inc.php';

  // Handle comment form submission
  if (isset($_POST['submit-comment'])) {
    $newComment = new UsersContr();
    $idFerment = $_GET['idFerment'];
    $commenter = $_SESSION['username'];
    $recipient = $_GET['user'];
    $userComment = $_POST['comment'];

    $newComment->enterComment($idFerment, $commenter, $recipient, $userComment);
  }

  // Handle delete CRUD
  if (isset($_POST['delete'])) {
    $idFerment = $_GET['idFerment'];

    // Handle successful completion of entry being deleted
    $newFerment = new UsersContr();
    $entryName = $newFerment->returnFermentName($idFerment);
    $newMsg = new UsersView();
    $newMsg->showMsg($entryName, "deleted");
  
    $newFerment->deleteFerment($idFerment);

    header('Location: delete.php?entryName=' . $entryName);
  }
?>

<div class="wrapper">
  <?php
  // Handle update form submission
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
  <div class="col-split">
    <div class="main-col">
      <?php 
        // Show formatted recipe
        $ferment = new UsersView();
        $idFerment = $_GET['idFerment'];
        $ferment->showFerment($idFerment);      
      ?>
      
      <div class="comment-box">
      <h2>Leave a comment</h2>

        <form action="" method="post">
          Comment:<textarea name="comment"></textarea>
          <input class="btn-orange" type="submit" name="submit-comment" value="Submit">
        </form>
      </div>
      <?php
        $ferment->show5RecentComments($idFerment);

      ?>
    </div>
    <div class="ad-col">
      <h2>Advert</h2>
      <img src="img/ads/laithwaites.gif">

      <h2>Advert</h2>
      <img src="img/ads/clothes.png">
    </div>
  </div>

   <!-- Modal -->
 <div class="modal-container" id="modal">
  <div class="modal">
    <button class="close-btn" id="close-modal">X</button>
    <div class="modal-header">
      <h3>Update the current recipe</h3>
    </div>
    <div class="modal-content">
      <form method="post" class="modal-form">
        <div>
          <label for="name">Name of fermentation</label>
          <input name="name" type="text" id="name" placeholder="Enter Name of Fermentation" class="form-input">
        </div>
        <div>
          <label for="start-date">Start Date</label>
          <input name="start-date" type="text" id="start-date" placeholder="E.g. 2020/05/19"  class="form-input">
        </div>
        <div>
          <label for="end-date">End Date</label>
          <input name="end-date" type="text" id="text" placeholder="E.g. 2020/06/01"  class="form-input">
        </div>
        <div>
          <label for="type">Type</label>
          <input name="type" type="text" id="type" placeholder="Brine/pickle/sugar"  class="form-input">
        </div>
        <div>
          <label for="total-days">Total Days</label>
          <input name="total-days" type="text" id="type" placeholder="Brine/pickle/sugar"  class="form-input">
        </div>
        <div>
          <label for="password2">Spices</label>
          <input name="spices" type="text" id="spices" placeholder="Cumin, cloves, pepper etc."  class="form-input">
        </div>
        <div>
          <label for="password2">Notes</label>
          <input name="notes" type="text" id="notes" placeholder="Great with a salad!"  class="form-input">
        </div>
        <input class="btn-orange" type="submit" name="update" value="Submit"> 

      </form>
    </div>
  </div>
</div> 
</div>
  
</div>

<?php
  include 'includes/footer.inc.php';
?>