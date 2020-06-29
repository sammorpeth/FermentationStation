<?php 

include_once 'classes/dbh.class.php';

class UsersContr extends Users {
  // ====================================================== //
  // ================= LOG IN/ VERIFICATION =============== //
  // ====================================================== //


  public function checkLoginDetails($username, $pwd) {
    $this->checkUserLoginInfo($username, $pwd);
  }

  public function enterNewUser($username, $email, $pwd, $pwdRepeat) {
    $this->createUser($username, $email, $pwd, $pwdRepeat);
  }

  public function verifyPreviousUser($username, $email) {
    return $this->checkPreviousUser($username, $email);
  }

   // ====================================================== //
  // ======================= USERS ======================== //
  // ====================================================== //

  // for individual profiles
  public function returnUserProfile($username) {
    $this->getUserProfile($username);
  }

  // for social page
  public function returnAllUserProfiles() {
    $this->getUserProfile();
  }

  public function returnNumOfUserFerments($username) {
    $this->getNumOfFerments($username);
  }

  public function returnNumOfUsers() {
    $this->getNumOfUsers();
  }

  // -------- duz nat werk -------
  public function returnInfo($info, $table, $clause, $match) {
    $this->getInfo($info, $table, $clause, $match);
  }

   // ===================================================== //
  // ==================== SOCIAL SYSTEM =================== //
  // ====================================================== //

  // ================ COMMENTS SYSTEM ================== //

  public function enterComment($idFerment, $commenter, $recipient, $comment) {
    $this->writeComment($idFerment, $commenter, $recipient, $comment);
  }

  public function returnRecentCommentId($idFerment) {
    $this->getRecentCommentId($idFerment);
  }

  public function returnRecentComment($idFerment) {
    $this->getRecentComment($idFerement);
  }

  public function returnRecentCommentsProfile($username) {
    return $this->getRecentCommentsProfile($username);
  }

  public function return5RecentComments($idComment) {
    return $this->get5RecentComments($idComment);
  }


  // ================ VOTE SYSTEM ================== //

  public function verifyVoteExists($voter, $idFerment) {
    return $this->checkVoteExists($voter, $idFerment);
  }

  public function enterVote($voter, $idFerment) {
    $this->addVote($voter, $idFerment);
  }

  public function returnPopularRecipe($username) {
    $this->getPopularRecipe($username);
  }

  // ================ ADMIN FEATURES ================== //

  public function returnUsersType() {
    $this->getUserTypes();
  }

  public function updateUserType($userId, $userType) {
    $this->upgradeUserType($userId, $userType);
  }

  // ====================================================== //
  // ================= FERMENTATIONS ====================== //
  // ====================================================== //
 
  public function returnFermentName($idFerment) {
    $this->getFermentName($idFerment);
  }

  public function returnFerment($idFerment) {
    return $this->getFerment($idFerment);
  }

  public function returnUserFerments($username) {
    $this->getUserFerments($username);
  }

  public function returnFermentsForList() {
    return $this->getFermentsForList();
  }

  public function returnAllFerments() {
    return $this->getAllFerments();
  }

  public function returnFermentsPopList($numOfResults) {
    return $this->getFermentsPopList($numOfResults);
  }

  public function returnFermentsDiscussList() {
    return $this->getFermentsDiscussList();
  }

  public function returnExplodedIngredients($ingredients) {
    return $this->explodeIngredients($ingredients);
  }

  public function returnUserRecentRecipe($username) {
    return $this->getUserRecentRecipe($username);
  }

  // ====================================================== //
  // ================= CRUD FERMENTATIONS ================= //
  // ====================================================== //

  public function createFerment($user, $name, $startDate, $endDate, $type, 
  $totalDays, $spices, $instructions, $notes) {
    
    $this->setFerment($user, $name, $startDate, $endDate, $type, 
    $totalDays, $spices, $instructions, $notes);
  }

  public function insertUpdate($name, $startDate, $endDate, $type, 
  $totalDays, $spices, $notes, $idFerment) {
    
    $this->updateEntry($name, $startDate, $endDate, $type, 
    $totalDays, $spices, $notes, $idFerment);
  }

  public function deleteFerment($idFerment) {
    $this->deleteEntry($idFerment);
  }

}

