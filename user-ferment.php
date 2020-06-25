<?php
 require 'includes/header.inc.php';
 include_once 'classes/dbh.class.php';
 include_once 'classes/users.class.php';
 include_once 'classes/usersview.class.php';
 include_once 'classes/userscontr.class.php';
?>
<?php 
  // todo: put this is in the same area as the recipe list
  // $username = $_GET['username'];
  // echo $username . " 's recipes";

  if (isset($_POST['submit'])) {

    $idFerment = $_POST['idFerment'];
    $commenter = $_SESSION['username'];
    $recipient = $_GET['username'];
    $comment = $_POST['comment'];

    $newComment = new UsersContr();
    $newComment->enterComment($idFerment, $commenter, $recipient, $comment);
  }

  if (isset($_POST['vote'])) {
    $voter = $_SESSION['username'];
    $idFerment = $_POST['idFerment'];

    $newVote = new UsersContr();
    $previousVote = $newVote->verifyVoteExists($voter, $idFerment);
    
    if ($previousVote >= 1) {
      // TODO: change error message to tell the user they can only vote once per recipe.
      echo "ERROR. ERROR.";
    } else {
      $newVote->enterVote($voter, $idFerment);
    }

  }
?>

<div class="user-ferments">
  <?php
    $username = $_GET['username'];
    $userFerments = new UsersView();
    $userFerments->showUserFerments($username);
  ?>
</div>

<?php
  require 'includes/footer.inc.php';
?>
