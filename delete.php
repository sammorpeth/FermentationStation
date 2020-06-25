
<?php
  include 'includes/header.inc.php';
  include_once 'classes/users.class.php';
  include_once 'classes/usersview.class.php';
  include_once 'classes/userscontr.class.php';

  require 'includes/auth.inc.php';

  if (isset($_GET['idFerment']) && ctype_digit($_GET['idFerment'])) {
    $idFerment = $_GET['idFerment'];
  } else {
    header('Location: select.php');
  }

  $newFerment = new UsersContr();
  $entryName = $newFerment->returnFermentName($idFerment);
  echo $entryName;
  $newMsg = new UsersView();

  $newMsg->showMsg($idFerment, "deleted");

  $newFerment->deleteFerment($idFerment);
  
    
   
  
?>


 

<?php
  include 'includes/footer.inc.php';
?>

