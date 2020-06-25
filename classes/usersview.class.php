<?php

include_once 'classes/users.class.php';

class UsersView extends Users {

  // display individFermentual ferment. use for searches later on.
  // public function showFermentSearch(string $name) {
  //   $results = $this->getFerment($name);
  //   echo "Name: " . $results[0]['name'];
  // }

  // ====================================================== //
  // ================= LOG IN / LOG OUT =================== //
  // ====================================================== //
  
  // Show log out button when a user successfully logs in
  public function loggedInDisplay() {
    echo '<p>Log in successful! Welcome, '.$_SESSION['username'].'!</p>
    <form action="logout.php" method="post">
      <input class="btn-orange" type="submit" name="logout" value="Log Out">
    </form>';
  }

  // Show log in button and form for a user to sign in. 
  public function loggedOutDisplay() {
    // temporarily have the button out of the form as when I was implementing the modal
    // the submission of the form was causing the page to reload and remove the modal 
    // from view
    echo '
    <form action="index.php" method="post">
      <div>
        <p>Email/username: <input type="text" name="uid" placeholder="example@example.com"></p>
        <p>Password: <input type="password" name="pwd"></p>
      </div>
    <input class="btn-orange" type="submit" name="login-sbmt" value="Log In">

    </form>
    <button class="btn-orange" id="open-modal">Sign Up</button>
    ';
  }

   // ====================================================== //
  // ======================= USERS ======================== //
  // ====================================================== //

  // ==== not sure I need this anymore
  //  individual users
  public function displayUserProfile($username) {
    $results = $this->getUserProfile($username);
    $numOfFerments = $this->getNumOfFerments($username);
  
    echo '<div>
    <h3>User\'s Profile</h3>
    <ul>'.
    '<img src="img/pickles.jpg" class="profile-pic">' . 
    '<li>Username: '.$results[0]['username'] . '</li>' .
    '<li>Registered email: '.$results[0]['email'] . '</li>' . 
    '<li>User type: '.$results[0]['user_type'] . '</li>' .
    '<li>Number of ferments: '. $numOfFerments .'</li>' .
    // todo: add a feature which tells the date when something was created.
    // add a carousel of most recent entries at the bottom of someone's profile
    // if the person is an admin allow them to see all other users profiles 
    '<li>Member since: '. $results[0]['user_since'].'</li>' 
    .'</ul>
    </div>';
  }

  // Display all the users pages with a placeholder 
  // for social page
  public function displayAllUserProfiles() {
    $results = $this->getAllUserProfiles();

    foreach ($results as $row) {
      $username = $row['username'];
      $numOfFerments = $this->getNumOfFerments($username);
      // get random num
      $randomNum = rand(0, 100);
      // determine the remainder
      $remainder = $randomNum % 2;
      
      // set the gender of the display pic based on if the random num is odd or even
      $gender = '';
      if ($remainder == 1) {
        $gender = 'women';
      } else {
        $gender = 'men';
      }

      echo '<div class="social-profile">
      <h3>' . $username.'\'s Profile</h3>
      <ul>'.
        '<img src="https://randomuser.me/api/portraits/'. $gender .'/' . $randomNum .'.jpg" class="profile-pic">' . 
        '<li><strong>Username</strong>: '.$row['username'] . '</li>' .
        '<li><strong>Number of ferments</strong>: '. $numOfFerments .'</li>' .
        // todo: add most popular recipe
        '<li><strong>Most popular recipe</strong>: '. $numOfFerments .'</li>' .
        '<li><strong>Member since</strong>: '. $row['user_since'].'</li>' 
     .'</ul>
      <a href="user-ferment.php?username='. $username.'">'. $username .'\'s Ferments</a>
      </div>';
      $usersRecipe = new UsersContr();
      $results = $usersRecipe->returnUserRecentRecipe($username);
      var_dump($results);
      if ($results[0] !== NULL ) {
        $idFerment = $results[0]['MAX(idFerment)'];
        $this->showFerment($idFerment);
      } else {
        echo "<h3>This user is yet to upload any recipes to the site.</h3>";
      }
      
    }
  }

  

  // ================ COMMENTS SYSTEM ================== //

  // Format and show the most recent comment on a given fermentation
  public function showRecentComment($idFerment) {
    $commentResults = $this->getRecentComment($idFerment);
    if (count($commentResults) > 0) {
      echo "<h4>Recent Comment</h4>
      <p>" . $commentResults[0]['comment'] . "</p>
      <li>By: " .  $commentResults[0]['commenter'] . "</li>" . 
      "<li>Date:" .  $commentResults[0]['date_written'] . "</li>".
      "<li>Time:" .  $commentResults[0]['time_written'] . "</li>";
    } else {
      echo "<h4>Recent Comment</h4>
            <span>It looks like no one's written a comment for this recipe yet. Why not be the first?</span>
            <br>
            <br>";
    }
  }

  // Format and show the most recent comment on a fermentation on a user's profile
  public function showRecentCommentsProfile($username, $idFerment) {
    $commentResults = $this->getRecentCommentsProfile($username, $idFerment);
    var_dump($commentResults);
    if (count($commentResults) > 0) {
      foreach($commentResults as $row) {
        echo "<h4>Recent Comment</h4>
        <p>" . $row['comment'] . "</p>
        <li>By: <strong>" .  $row['recipient'] . "</strong></li>" . 
        "<li>Date: <strong>" .  $row['date_written'] . "</strong></li>".
        "<li>Time: <strong>" .  $row['time_written'] . "</strong></li>";
      }
  
    } else {
      echo "<span>It looks like you haven't written any comments yet.</span>
            <br>
            <br>";
    }
  }

  // Format and show the most recent comment on a fermentation's full page
  public function show5RecentComments($idFerment) {
    $newContr = new UsersContr();
    $recentComments = $newContr->return5RecentComments($idFerment);
    if (count($recentComments) >= 1) {
      echo "<h2>Recent Comments</h2>
            <div class='comments'>";
      foreach($recentComments as $comment) {
        echo "<div>
                <p><strong>" . $comment['comment'] . "</strong></p>
                <li> Written by: " . $comment['commenter'] . "
                <li> Date written: " . $comment['date_written'] . "
                <li> Time written: " . $comment['time_written'] . "
              </div>";
      }
      echo "</div>";
    } else {
      echo "<h3>It looks like no one has written a comment. Why not be the first?</h3>";
    }
   
  }
  // use this when i've built the full recipe page
  // $idFerment = $row['idFerment'];
  // $this->showRecentComment($idFerment); 
  // // this should be its own function since it's handling a form submission and not just displaying stuff
  // $previousVote = $this->checkVoteExists($username, $idFerment);
  
  // echo "<span>Comment on this recipe</span>
  //         <form action='' method='post'>
  //           <textarea rows='4' cols='40' name='comment'></textarea>
  //           <input type='hidden' id='idFerment' name='idFerment' value='". $row['idFerment']."'>
  //           <br>
  //           <input type='submit' name='submit'>";
  //           if (!$previousVote == 1) {
  //             echo "<input type='submit' name='vote' value='Vote'>";
  //           }
  // echo "  </form>
  //       </div>";

  // ================ ADMIN VIEW ================== //

  // Display the users in a table with a form so that their user type can be upgraded
  public function displayUserTypeTable() {
    $results = $this->getUserTypes();
    foreach($results as $row) {
      echo '
          <tr>
          <td>'.$row['userId']. '</td>
          <td>'.$row['username']. '</td>
          <td>'.$row['user_since']. '</td>
          <td>'.$row['user_type']. '</td>
          <form action="" method="post">
            <td><li>Moderator</li><input type="radio" name="upgrade-type" 
                                  id="moderator" 
                                  value="moderator"></td>
            <td><li>Admin</li><input type="radio" name="upgrade-type" 
                                  id="admin" 
                                  value="admin"></td>
            <td>
              <input type="submit" name="submit" value="Upgrade">
            </td>
            <input type="hidden" id="userId" name="userId" value="'. $row['userId'] . '">
          </form>
          <tr>
          ';
    }
  }

  // ====================================================== //
  // =============== FERMENTATION STUFF =================== //
  // ====================================================== //

  public function showFermentName($idFerment) {
    $entryName = $this->getFermentName($idFerment);
    echo $entryName;
  }

  // Format and show the relevant recipe with full instructions
  public function showFerment($idFerment) {
    $fermentObj = new UsersContr();
    $ferment = $fermentObj->getFerment($idFerment);
    // the closed div for this is created in the showIngredientsList function so that styles can be applied to it. I'm sure this is a terrible way of doing things. 
         echo"<div class='full-recipe'>
                <div class='recipe-details'>
                  <img src='https://picsum.photos/200/300' class='full-recipe-img'>
                    <h2>" . $ferment[0]['name'] . "</h2>
                   
                    <ul>
                      <li><strong>Recipe by</strong>: <a href='profile.php?&username=" 
                      . $ferment[0]['user'] ."'>" . $ferment[0]['user']. "</a></li>
                      <li><strong>Votes:</strong>:" . $ferment[0]['votes']. "</a></li>
                      <li><strong>Description:</strong>:" . $ferment[0]['description']. "</li>
                    </ul>
                </div>
                  <p><strong>Instructions:</strong>:" . $ferment[0]['instructions']. "</p>
         ";
    $this->showIngredientsList($ferment[0]['spices']);
  }

  // Format the ingredients in a list
  public function showIngredientsList($ingredients) {
    $fermentObj = new UsersContr();
    $ingredients = $fermentObj->explodeIngredients($ingredients);
    $listCounter = 1;
    echo "<h3>Ingredients</h3> 
          <ul class='ingredients'>";
    foreach($ingredients as $ingredient) {
      echo "<li>". $listCounter. ". ". $ingredient . "</li>";
      $listCounter++;
    }
    echo "</ul>
          </div>";

  }
  
  // Show all different types of fermentations on select page
  public function showAllFerments() {
    // This seems to mean I can use the public methods from the UserContr class rather than essentially completely ignoring that class and
    // calling the protected methods directly. Not sure if this is the right thing to do though. Seems to work.
    $ferment = new UsersContr();
    $results = $ferment->returnAllFerments();
    foreach ($results as $row) {
      echo "<div class='recipe'>";
        echo "<div>";
         echo "<img src='https://picsum.photos/200/300' class='recipe-img'>";
        echo "</div>";
          echo "<div class='details'>";
          echo "<h2> " . $row['name'] . "</h2>";
          echo "<span><strong>Votes</strong>: " . $row['votes'] . "</span>";
          echo "<li><strong>Type</strong>: " . $row['type'] . "</li>";
          echo "<li><strong>Description</strong>: " . $row['description'] . "</li>";
          echo "<li><strong>Total days</strong>: " . $row['total_days'] . "</li>";
          echo "<div class='options'>
                  <div>
                    <a href='recipe.php?idFerment=". $row['idFerment'] ."&user=" . $row['user'] ."'>Read more...</a>
                  </div>";
        // TODO: if the user is equal to the recipe displayed they can also delete/update the entry from this page
          if (isset($_SESSION['user_type']) == 'admin') {
            echo "<div>
                    <a href='update.php?idFerment=" . $row['idFerment'] ."'>Update</a>" . 
                    " <a href='delete.php?idFerment=" . $row['idFerment'] ."'>Delete</a>
                    </div>
                  </div>" . " ";
          }
        echo "</div>";
      echo "</div>";
    }
  }

  // Show all of the logged in user's fermentations
  public function showUserFerments($username) {
    $ferment = new UsersContr();
    $results = $ferment->getUserFerments($username);
    foreach ($results as $row) {
      $idFerment = $row['idFerment'];
      echo "<div class='recipe'>";
        echo "<div>";
         echo "<img src='https://picsum.photos/200/300' class='recipe-img'>";
        echo "</div>";
          echo "<div class='details'>";
          echo "<h2> " . $row['name'] . "</h2>";
          echo "<li><strong>Description</strong>: " . $row['description'] . "</li>";
          echo "<li><strong>Type</strong>: " . $row['type'] . "</li>";
          echo "<li><strong>Total days</strong>: " . $row['total_days'] . "</li>";
          echo "<span><strong>Votes</strong>: " . $row['votes'] . "</span>";
          echo "<div class='options'>
                  <div>
                    <a href='recipe.php?idFerment=" . $row['idFerment']. "&user=" . $row['username'] ."'>Read more...</a>
                  </div>";
          echo "</div>";
          echo "</div>";
          echo "</div>";

      // checks if a comment exists 
      $previousCheck = $this->checkPreviousComments($idFerment);
      if (count($previousCheck) >= 1) {
        // if so this finds the relevant comment. I feel like this should be its own function run inside here.
        $recipeComment = $this->getRecentComment($idFerment);
        if (count($recipeComment[0]) >= 1) {
          echo "<div class='comment'>
                  <h2>Recent Comment</h2>
                  <p>" . $recipeComment[0]['comment'] . "</p>
                  <li><strong>Commenter</strong>: <a href='profile.php?username=". $recipeComment[0]['commenter']."'>" . $recipeComment[0]['commenter'] . "</a>
                  <li><strong>Time written</strong>: " . $recipeComment[0]['time_written'] . "
                  <li><strong>Date written</strong>: " . $recipeComment[0]['date_written'] . "
                </div>";
        } else {
          echo "lol";
        }
      }
    }
  }

  // should probably make these one function and change the parameters, although the SQL query is quite different.
  // Show the most popular fermentations in terms of votes and format them in a list.
  public function showPopList() {
    $ferment = new UsersContr();
    $results = $ferment->returnFermentsPopList();
    $counter = 1;
    foreach ($results as $row) {
      echo "<li>" . $counter . ". <a href='recipe.php?idFerment=" . $row['idFerment']. "&user=" . $row['user'] . "'>" . ucfirst($row['name']) . "</a></li>";
      $counter++;
    }
  }

  // Show the most popular fermentations in terms of comments and format them in a list.
  public function showDiscussList() {
    $ferment = new UsersContr();
    $results = $ferment->getFermentsDiscussList();
    $counter = 1;
    foreach ($results as $row) {
      echo "<li>" . $counter . ". <a href='recipe.php?idFerment=" . $row['idFerment']. "&user=" . $row['user'] . "'>" . ucfirst($row['name']) . "</a></li>";
      $counter++;
    }
  }

  // ====================================================== //
  // ================= MESSAGES =========================== //
  // ====================================================== //

  // display message upon deleting/updating an entry with relevant name
  public function showMsg($idFerment, string $type) {
    $entryName = $this->getFermentName($idFerment);
    echo "<h3>Entry of: " . "'" . $entryName ."'" . " successfully " . $type . "!</h3>";
  }

}