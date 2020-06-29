<?php 
  include_once 'classes/dbh.class.php';
  include_once 'classes/users.class.php';
  include_once 'classes/usersview.class.php';
  include_once 'classes/userscontr.class.php';

  $fermentsList = new UsersView();

  if (isset($_POST['login-sbmt'])) {
    $username = $_POST['uid'];
    $pwd = $_POST['pwd'];

    $newUser = new UsersContr();
    $newUser->checkLoginDetails($username, $pwd);
  }
?>
<!----- Bubbles ------>

<ul class="bubbles">
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
  </ul>

<!-- end /Bubbles -->

<!-- banner image -->
<div class="banner-container">
  <div>
    <h1 data-title="Fermentation Station" class="text-fill title">Fermentation Station</h1>
    <div>
      <span class="span-fill">Welcome aboard</span>
    </div>
  </div>
  

</div>
<!-- /.end banner image -->
<div class="cta">
   <button class="btn-orange" id="open-modal">Sign Up</button>
</div>

<?php
  require 'includes/header.inc.php';
?>

<div class="nav-parent-wrapper">
  <div class="nav-wrapper">
    <?php
        require 'includes/nav.inc.php'; 
    ?>
  </div>
</div>
<div class="container">


<!----- Carousel ------>
 <div class="carousel">
  <button class="carousel__button carousel__button--left">
    <img src="img/carousel/left.svg" alt="">
  </button>

  <div class="carousel__track-container">
    <ul class="carousel__track">
      <li class="carousel__slide current-slide">
        <div class="carousel__story">
          <h1>Mollitia dolore voluptatum quam</h1>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Ab voluptas aspernatur cupiditate facilis, animi nisi.
          </p>
          <button>Read More </button> 
        </div>
      </li>
      <li class="carousel__slide">
        <div class="carousel__story">
          <h1>Mollitia dolore voluptatum quam</h1>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Ab voluptas aspernatur cupiditate facilis, animi nisi.
          </p>
          <button>Read More </button> 
        </div>
      </li>
      <li class="carousel__slide">
        <div class="carousel__story">
          <h1>Mollitia dolore voluptatum quam</h1>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Ab voluptas aspernatur cupiditate facilis, animi nisi.
          </p>
          <button>Read More </button> 
        </div>
      </li>
    </ul>
  </div>

  <button class="carousel__button carousel__button--right">
    <img src="img/carousel/right.svg" alt="">
  </button>

  <div class="carousel__nav">
    <button class="carousel__indicator current-slide"></button>
    <button class="carousel__indicator"></button>
    <button class="carousel__indicator"></button>
  </div>
 </div>
 
 <!----- end /Carousel ------>
 

<div class="col-split">
  <div class="main-col">
    <div class="videos">
      <h2> What's on this week... </h2>
        <iframe width="100%" height="450px" src="https://www.youtube.com/embed/?v=u80eGi6pTso&t=198s"> </iframe>

        <!----- Articles ------>

        <div class="articles">
          <div>
            <img class="article-img" src="img/hero-img.jpg">
            <h3><a href="">Lorem ipsum dolor sit amet consectetur adipisicing elit.</a></h3>
          </div>
          <div>
            <img class="article-img" src="img/papaya.jpg">
            <h3><a href="">Lorem ipsum dolor sit amet consectetur adipisicing elit.</a></h3>
            <div>
              <button class="btn-grey">Watch More Videos</button>
            </div>
          </div>
          <div>
            <img class="article-img" src="img/pickles.jpg">
            <h3><a href="">Lorem ipsum dolor sit amet consectetur adipisicing elit.</a></h3>
          </div>
        </div> <!-- end /.articles -->
        
      </div> <!-- end /.videos -->

      <div class="promos">
        <div class="articles">
            <div>
              <img class="article-img" src="img/jars.jpg">
              <h3><a href="">Lorem ipsum dolor sit amet consectetur adipisicing elit.</a></h3>
            </div>
            <div>
              <img class="article-img" src="img/pancakes.jpg">
              <h3><a href="">Lorem ipsum dolor sit amet consectetur adipisicing elit.</a></h3>
            </div>
            <div>
              <img class="article-img" src="img/spices.jpg">
              <h3><a href="">Lorem ipsum dolor sit amet consectetur adipisicing elit.</a></h3>
            </div>
          </div> <!-- end /.articles -->
        </div> <!-- end /.promos -->
        
        <!-- figure out how to do this in JS -->
        <div class="extras">
          <div class="row-1">
            <div class="pink-bg">
              <img class="article-img-shifted" src="img/rice-ramen.jpg" alt="">
              <h3>Health</h3>
            </div>
            <div class="teal-bg">
              <img class="article-img-shifted"  src="img/red-wine.jpg" alt="">
              <h3>Family</h3>
            </div>
          </div>
          <div class="row-2">
            <div class="orange-bg">
              <img class="article-img-shifted"  src="img/kimchi.jpg" alt="">
              <h3>Videos</h3>
            </div>
            <div class="blue-bg">
              <img class="article-img-shifted"  src="img/fish.jpg" alt="">
              <h3>Reviews</h3>
            </div>
          </div>
        </div>
    </div> <!-- end /.main-col -->
  <div class="ad-col">
    <h2>Advert</h2>
    <img src="img/ads/meal.jpg">
    
    
    <div class="pop-lists">
     
      <div>
        <h3>Most Popular:</h3>
        <?php $fermentsList->showPopList('5'); ?>
      </div>
      <div>
        <h3>Most Discussed:</h3>
        <?php $fermentsList->showDiscussList(); ?>
      </div>
    </div><!-- end /.pop-lists -->

    <h2>Advert</h2>
    <img src="img/ads/laithwaites.gif">

    <!-- Modal -->



  </div> <!-- end /.ad-col -->
</div> <!-- end /.col-split -->


<script src="js/carousel.js"></script>
<script src="js/modal.js"></script>

<?php
  require 'includes/footer.inc.php';
?>