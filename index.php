<?php 
  include_once 'classes/dbh.class.php';
  include_once 'classes/users.class.php';
  include_once 'classes/usersview.class.php';
  include_once 'classes/userscontr.class.php';

  $fermentsList = new UsersView();

  // Handle log in form submission
  if (isset($_POST['login-sbmt'])) {
    $username = $_POST['uid'];
    $pwd = $_POST['pwd'];

    // Check the details the user has entered agains the details for that user in the DB.
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

<?php
  require 'includes/header.inc.php';
?>


<div class="container">

<div>
  <?php 
    // if the form is successfully submitted a message is created telling the user they successfully created
    // an account
    if (isset($_POST['sign-up'])) {
      $newMsg = new UsersView();
      $newMsg->showGeneralMsg('User', 'created');
    }

    // Display appropriate error messages for the sign-up form
    if (isset($_GET['error'])) {
      $newMsg = new UsersView();
      $newMsg->showError($_GET['error']);
    }
  ?>
</div>


<div class="intro">
  <h2>Welcome to the Fermentation Station!</h2>
  <p>Lorem ipsum dolor sit amet consectetur <a href=''>adipisicing elit</a>. Autem assumenda minus porro expedita sed saepe inventore commodi molestiae, 
  at aspernatur amet quia voluptatem laboriosam ducimus iusto dignissimos mollitia illo magni.</p>
   <p>Lorem ipsum dolor sit amet consectetur, <a href=''>adipisicing</a> elit. Nobis nesciunt, blanditiis fugit assumenda itaque recusandae 
  rem placeat velit dolorum odio,saepe quo voluptatem! Aspernatur totam atque tempore, dignissimos illo nobis est modi at,
   facere nemo deserunt provident sequi quas vel maiores architecto in eaque quae, earum esse suscipit quod illum. Lorem ipsum dolor sit amet consectetur 
   adipisicing elit. Suscipit quae eum consectetur corporis nobis nisi, porro dolore, perspiciatis adipisci laudantium sed ipsa?
    Sed, animi ullam. Recusandae illo earum dolorem enim.</p>
     <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nobis<a href=''>nesciunt, blanditiis</a> fugit assumenda itaque recusandae 
  rem placeat velit dolorum odio,saepe quo voluptatem! Aspernatur totam atque tempore, dignissimos illo nobis est modi at,
   facere nemo deserunt provident sequi quas vel maiores architecto in eaque quae, earum esse suscipit quod illum. Lorem ipsum dolor sit amet consectetur 
   adipisicing elit. Excepturi molestiae, <a href=''>repellat sapiente asperiores</a> soluta id quis deleniti iure ipsam magni. Lorem ipsum dolor sit amet consectetur adipisicing
    elit. Ipsum quisquam recusandae odit natus nam voluptate cumque, culpa animi ratione saepe placeat quas! Odio consectetur recusandae adipisci, 
    quisquam explicabo fugit provident voluptas culpa voluptatum, ratione cumque neque. Error <a href=''>omnis </a>obcaecati possimus?</p>
   <div class="cta">
    <!-- Only visible if there is no user logged in. -->
   <?php if (!isset($_SESSION['username'])) {
      echo '<button class="btn-orange" id="open-modal">Sign Up</button>';
     };
   ?>
  </div>

</div>


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
        <?php $fermentsList->showList('voters', 'ferments', '5');?>
      </div>
      <div>
        <h3>Most Discussed:</h3>
        <?php $fermentsList->showList('comments', 'ferments', '5');?>

      </div>
    </div><!-- end /.pop-lists -->

    <h2>Advert</h2>
    <img src="img/ads/laithwaites.gif">

    <!-- Modal -->



  </div> <!-- end /.ad-col -->
</div> <!-- end /.col-split -->

<!-- Modal -->
 <div class="modal-container" id="modal">
  <div class="modal">
    <button class="close-btn" id="close-modal">X</button>
    <div class="modal-header">
      <h3>Sign Up</h3>
    </div>
    <div class="modal-content">
      <p>Sign up today for great recipes, new friends and more</p>
      <form action="" method="post" class="modal-form">
        <div>
          <label for="name">Name</label>
          <input name="username" type="text" id="name" placeholder="Enter Name" class="form-input">
        </div>
        <div>
          <label for="email"  >Email</label>
          <input name="email" type="email" id="email" placeholder="Enter Email"  class="form-input">
        </div>
        <div>
          <label for="password">Password</label>
          <input name="pwd" type="password" id="password" placeholder="Enter Password"  class="form-input">
        </div>
        <div>
          <label for="password2">Confirm password</label>
          <input name="pwd-confirm" type="password" id="password2" placeholder="Confirm Password"  class="form-input">
        </div>
        <input class="btn-orange" type="submit" name="sign-up" value="Submit"> 

      </form>
    </div>
  </div>
</div> 
  


<script src="js/carousel.js"></script>
<script src="js/modal.js"></script>

<?php
  require 'includes/footer.inc.php';
?>