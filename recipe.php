<?php
  include 'includes/header.inc.php';
  include_once 'classes/users.class.php';
  include_once 'classes/usersview.class.php';
  include_once 'classes/userscontr.class.php';

  if (isset($_POST['submit-comment'])) {
    $newComment = new UsersContr();
    $idFerment = $_GET['idFerment'];
    $commenter = $_SESSION['username'];
    $recipient = $_GET['user'];
    $userComment = $_POST['comment'];

    $newComment->enterComment($idFerment, $commenter, $recipient, $userComment);
  }
?>

<div class="wrapper">
  <div class="col-split">
    <div class="main-col">
      <?php 
        $ferment = new UsersView();
        $idFerment = $_GET['idFerment'];
        $ferment->showFerment($idFerment);      
      ?>

      
      <h2>Leave a comment</h2>
      <div class="comment-box">
        <form action="" method="post">
          Comment:<textarea name="comment"></textarea>
          <input type="submit" name="submit-comment" value="Submit">
        </form>
      </div>

          <!-- <div class="add-recipe">
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
    </div> -->
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
  
</div>

<?php
  include 'includes/footer.inc.php';

?>