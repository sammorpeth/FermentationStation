<?php

// todo: create a new fermentation table for each user and add it to their specific user table 

include_once 'classes/dbh.class.php';

class Users extends Dbh {

  // todo: check info using session variables.
  // change info on page shown depending on what kind of user is logged in.
  // allow admins to edit and view other users information
  // allow only users to edit their own content
  // allow users to comment on other users' fermentations
  // allow users to vote for their favourite 
  // display the most popular recipes with a comment

  // ============================================================================= //
  // ==================== LOG IN/ VERIFICATION =================================== //
  // ============================================================================= //

  // Verify the info in the db matches the data entered by user
  protected function checkUserLoginInfo($username, $pwd) {
    if (empty($username) || empty($pwd)) {
      header("Location: index.php");
      exit();
    } else {
      $sql = "SELECT * FROM users WHERE username = ?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$username]);
      $results = $stmt->fetchAll();

      $pwdCheck = password_verify($pwd, $results[0]['hashed_pwd']);
      if ($pwdCheck == false) {
        echo 'pwd nat kewl';
      } else if ($pwd == true) {
        session_start();
        $_SESSION['username'] = $results[0]['username'];
        $_SESSION['user_type'] = $results[0]['user_type'];

      }
    }
  }

  // validate and create user. maybe should split into two functions. validation
  // and creation? 
  protected function createUser($username, $email, $pwd, $pwdRepeat) {

    $previousUser = $this->checkPreviousUser($username, $email);
    // check for empty values
    if (empty($username) || empty($email) || empty($pwd) || empty($pwdRepeat)) {
      // does not seem to repopulate the fields for some reason.
      header('Location: signup.php?error=emptyfields&username='.$username);
      exit();
    } else if ($pwd !== $pwdRepeat) {
      // does not seem to repopulate the fields for some reason.
      header('Location: signup.php?error=mismatchedpasswords&username='.$username);
      exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      header('Location: signup.php?error=invalidemail');
      exit();
    } else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
      header('Location: signup.php?error=invalidusername');
      exit();
    } else if($previousUser >= 1) {
      // TODO: format error message. 
      header('Location: signup.php?error=usernametaken');
      echo "USERNAME OR EMAIL TAKEN";
      exit();
    }
    else {
      // new users are automatically assigned the user type of "user". 
      $date = date('Y-m-d');
      $sql = "INSERT INTO users (username, email, hashed_pwd, user_type, user_since) VALUES (?, ?, ?, ?, ?)";
      $stmt = $this->connect()->prepare($sql);
      $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
      $stmt->execute([$username, $email, $hashedPwd, "user", $date]);
    }
  }

  // Checks to see if there is an existing email or user by this name. 
  // TODO: Create an error message if this is the case.
  protected function checkPreviousUser($username, $email) {
    $sql = "SELECT COUNT(1) FROM users WHERE username = ? OR email = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$username, $email]);

    $results = $stmt->fetchAll();
    return $results[0]['COUNT(1)'];
  }

  
  // ============================================================================= //
  // =========================== USER  =========================================== //
  // ============================================================================= //

  // possibly use userId in future 
  protected function getUserProfile($username) {
    $sql = "SELECT username, email, user_type, user_since FROM users WHERE username = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$username]);

    $results = $stmt->fetchAll();
    return $results;
  }
  
  // Get all the information for the users. For use in the social page.
  protected function getAllUserProfiles() {
    $sql = "SELECT username, email, user_type, user_since FROM users";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();

    $results = $stmt->fetchAll();
    return $results;
  }

  // Not sure what this is for anymore. 
  protected function getNumOfUsers() {
    $sql = "SELECT COUNT(user) FROM ferments WHERE username = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetchAll();
   
    return $result;
  }

  // could probably alter this so that it is more versatile
  protected function getNumOfFerments($username) {
    $sql = "SELECT COUNT(user) FROM ferments WHERE user = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$username]);

    $results = $stmt->fetchAll();
    foreach ($results as $row) {
      return $row['COUNT(user)'];
    }
  }

  // ============================================================================= //
  // =========================== SOCIAL SYSTEMS  ================================= //
  // ============================================================================= //

  // ================ COMMENTS SYSTEM ================== //


  // Formate the date and time for SQL. 
  // Insert a comment into the DB
  protected function writeComment($idFerment, $commenter, $recipient, $comment) {
    $date = date('Y-m-d');
    $time = date('H:i:s');
    $sql = "INSERT INTO comments (idFerment,	commenter,	recipient,	comment, date_written, time_written) 
                        VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$idFerment, $commenter, $recipient, $comment, $date, $time]);
  }

  // Get the highest value comment on the relevant ferment. This should return the most recent comment
  protected function getRecentCommentId($idFerment) {
    $sql = "SELECT MAX(idComment) FROM comments WHERE idFerment = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$idFerment]);

    $results = $stmt->fetchAll();
    return $results[0]['MAX(idComment)'];
  }

  // Get the most recent comment. For use on the profile page. 
  protected function getRecentComment($idFerment) {
    $idComment = $this->getRecentCommentId($idFerment);
    $sql = "SELECT commenter, comment, date_written, time_written 
            FROM comments WHERE idFerment = ? AND idComment = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$idFerment, $idComment]);
    $results = $stmt->fetchAll();
    return $results;
  }

  // Get the recent comment on a ferment. Used to apend a recent comment on the "Your profile" page to a user's ferment 
  protected function getRecentCommentsProfile($username, $idFerment) {
    // Can't get this to return the TOP of anything. No idea why. It will return MAX(idComment) or any other thing, but not TOP. 
    // Turns out TOP is for another type of SQL. LIMIT is the mySQL equivalent.
    $sql = "SELECT idComment, comment, recipient, date_written, time_written 
            FROM comments WHERE idFerment = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$username]);

    $results = $stmt->fetchAll();
    return $results;
  }

  // Return the 5 most recent comments on a ferment. Used when the recipe is fully displayed
  protected function get5RecentComments($idFerment) {
    $sql = "SELECT idComment,  commenter, recipient, comment, date_written, time_written 
            FROM comments WHERE idFerment = ?
            ORDER BY idComment DESC LIMIT 5 ";
            // GROUP BY v.idFerment ORDER BY COUNT(v.idFerment) DESC LIMIT 5";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$idFerment]);
    $results = $stmt->fetchAll();
    return $results;
  }

  // Check if there was a previous comment so that a message can be displayed if there are no previous messages.
  protected function checkPreviousComments($idFerment) {
    $sql = "SELECT idFerment FROM comments WHERE idFerment = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$idFerment]);
    $results = $stmt->fetchAll();
    return $results;
  }

  // ================ VOTE SYSTEM ================== //

  // Check to see if a user has previously voted for a recipe. 
  protected function checkVoteExists($voter, $idFerment) {
    $sql = "SELECT COUNT(1) FROM voters WHERE voter = ? AND idFerment = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$voter, $idFerment]);
    $results = $stmt->fetchAll();
    return $results[0]['COUNT(1)'];
  }

  // Add a vote to the DB along with the voter's username
  protected function addVote($voter, $idFerment) {
    $sql = "INSERT INTO voters(voter, idFerment) VALUES(?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$voter, $idFerment]);
  }


 

  // ================ ADMIN FEATURES ================== //

  // Get the user's type and other info for the admin page 
  protected function getUserTypes() {
    // find user, upgrade depending on radio button clicked
    $sql = "SELECT userId, username, user_type, user_since FROM users";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
    return $results;
  }

  // Change a user's type depending on what option the admin selected
  protected function upgradeUserType($userType, $userId) {
    $sql = "UPDATE users SET user_type = ? WHERE userId = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$userType, $userId]);
  }

  // ============================================================================= //
  // =========================== FERMENTATIONS =================================== //
  // ============================================================================= //

  // get single ferment. use for a search funtion later on
  protected function getFerment($idFerment) {
    // can be used for a search function as it targets the name
    $sql = "SELECT * FROM ferments WHERE idFerment = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$idFerment]);
    $results = $stmt->fetchAll();
    return $results;
  }

  // return name for display message purposes
  protected function getFermentName($idFerment) {
    // targets a current entry based on the idFerment of the entry 
    // which is set by the page of the relevant entry
    $sql = "SELECT name FROM ferments WHERE idFerment = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$idFerment]);
    $result = $stmt->fetchAll();
    $fermentName = $result[0]['name'];
    return $fermentName;
  }

  // get a list of all ferments. use for individual users later on.
  protected function getAllFerments() {
    $sql = "SELECT * FROM ferments";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
    return $results;
  }

  // Get all the user's ferments. Used to display the user's recipes on the profile page.
  protected function getUserFerments($username) {
    $sql = "SELECT u.username, f.name, f.type, f.spices, f.idFerment, f.description, f.total_days, f.votes
            FROM users AS u
            JOIN ferments AS f
            ON u.username=f.user
            WHERE u.username = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$username]);
    $results = $stmt->fetchAll();
    return $results;
  }

  // Return the top 5 ferments based on how many votes are in the voters table
  protected function getFermentsPopList() {
    // returns a list of items which match on both idFerments in each column and counts how many times the idFerment appears in the voters
    // table. this allows us to see how many times a certain ferment appears in the voters table and then get the name of the relevant
    // ferment from the ferments table. 
    $sql = "SELECT v.idFerment,  COUNT(v.idFerment), f.name, f.idFerment, f.user
            FROM voters AS v
            JOIN ferments AS f
            ON v.idFerment = f.idFerment
            GROUP BY v.idFerment ORDER BY COUNT(v.idFerment) DESC LIMIT 5";
  // -- GROUP BY idFerment ORDER BY COUNT(idFerment) DESC LIMIT 5 //// COUNT(idFerment),
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
    return $results;
  }

  // Return the top 5 ferments based on how many comments are in the comments table
  
  protected function getFermentsDiscussList() {
    // does the same as the function above, but looks for the most discussed fermentation
    $sql = "SELECT c.idFerment, COUNT(c.idFerment), f.idFerment, f.name, f.user
            FROM comments as c
            JOIN ferments as f
            ON c.idFerment = f.idFerment
            GROUP BY c.idFerment ORDER BY COUNT(c.idFerment) DESC LIMIT 5";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();

    return $results;
  }

  // Make the ingredients into an array so they can be formatted properly into a list on the recipes page
  protected function explodeIngredients($ingredients) {
    $indvIngredients = explode(", ", $ingredients);
    return $indvIngredients;
  } 

  // $ingredients = "cumin, seven spice mix, flake, sprinkles";
  // $indvIngredients = explode(", ", $ingredients);
  // echo $indvIngredients[0];

  // =============================================================================== //
  // =========================== CRUD FERMENTATIONS ================================ //
  // =============================================================================== //

  // Create a new fermentation entry
  protected function setFerment($name, $startDate, $endDate, $type, 
  $totalDays, $spices, $instructions, $notes) {
    $sql = "INSERT INTO ferments(name, start_date, end_date, type, 
            total_days, spices, instructions, notes) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$name, $startDate, $endDate, $type, 
                    $totalDays, $spices, $instructions, $notes]);
  }

  // Update current fermentation entry - relevant to current page
  protected function updateEntry($name, $startDate, $endDate, $type, 
  $totalDays, $spices, $notes, $idFerment) {
    $sql = "UPDATE ferments SET name=?, start_date=?, end_date=?, type=?, total_days=?,
             spices=?, notes=? WHERE idFerment=?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$name, $startDate, $endDate, $type, 
                    $totalDays, $spices, $notes, $idFerment]);

  }

  // Delete current ferementation entry - relevant to current page
  protected function deleteEntry($idFerment) {
    $sql = "DELETE FROM ferments WHERE idFerment=?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$idFerment]);

  }

}