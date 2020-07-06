<?php
  include 'includes/header.inc.php';
  include_once 'classes/users.class.php';
  include_once 'classes/usersview.class.php';
  include_once 'classes/userscontr.class.php';
?>


<div class="wrapper">
  <div class="message">
    <h2>All Recipes</h2>
  </div>
  <div class="col-split">
    <div class="main-col">
      <?php
   
        $fermentList = new UsersView();
        $fermentList->showAllFerments();
      ?>
    </div>

    <div class="ad-col">
      <h2>Advert</h2>
      <img src="img/ads/fairy.gif">
      

      <h2>Advert</h2>
      <img src="img/ads/clothes.png">

    </div> <!-- end /.ad-col -->
  </div>
</div>

<?php
  include 'includes/footer.inc.php';
?>