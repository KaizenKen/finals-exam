<?php
  require_once 'dbConfig.php';
  require_once 'models.php';
  
  if(isset($_POST['loginBtn'])){
    $loginUsername = $_POST['loginUsername'];
    $loginPassword = $_POST['loginPassword'];

    $checkUserExists = checkUserExists($pdo, $loginUsername, $loginPassword);
    
    if($checkUserExists){
      $_SESSION['user_id'] = $checkUserExists['user_id'];
      $_SESSION['username'] = $checkUserExists['user_name'];
      $_SESSION['first_name'] = $checkUserExists['first_name'];
      $_SESSION['last_name'] = $checkUserExists['last_name'];
      $_SESSION['user_role'] = $checkUserExists['user_role'];
      
      header('location: ../index.php');
    }
    else {
      $_SESSION['message'] = '<h3 style="color: red">Incorrect Username or Password.<br>Please try again.</h3>';
      header('location: ../login.php');
    }
  }

  if(isset($_POST['signupBtn'])){
    $signupUsername = $_POST['signupUsername'];
    $signupPassword = $_POST['signupPassword'];
    $signupFirstName = $_POST['signupFirstName'];
    $signupLastName = $_POST['signupLastName'];

    if($signupUsername == null || $signupPassword == null || $signupFirstName == null || $signupLastName == null){
      $_SESSION['message'] = '<h3 style="color: red">Some fields are empty!<br>Please try again.</h3>';
      header('location: ../login.php');
    } else {
      $checkUserExists = checkUserExists($pdo, $signupUsername);

      if(count($checkUserExists) >= 1){
        $_SESSION['message'] = '<h3 style="color: red">Username already taken!<br>Please try again.</h3>';
        header('location: ../login.php');
      }
      else {
        $insertNewUser = insertNewUser($pdo, $signupUsername, $signupPassword, $signupFirstName, $signupLastName);
        $_SESSION['message'] = '<h3 style="color: green">Sign Up success!<br>Please Log In to continue.</h3>';
        header('location: ../login.php');
      }
    }
  }

  if(isset($_POST['logoutBtn'])){
    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
    header('location: ../index.php');
  }

  if(isset($_POST['postnewjobBtn'])){
    $newjobTitle = $_POST['newjobTitle'];
    $newjobDesc = $_POST['newjobDesc'];
    $posted_by = $_POST['postedBy'];

    $insertNewPost = insertNewPost($pdo, $newjobTitle, $newjobDesc, $posted_by);

    if($insertNewPost){
      header('location: ../postNewJob.php');
      $_SESSION['message'] = '<h3 style="color: green">Job posted successfully!';
    }
  }

  if(isset($_POST['appSubmit'])){
    $user_id = $_SESSION['user_id'];
    $job_post_id = $_POST['post_id'];
    $appDesc = $_POST['appDesc'];
    // $appFile = $_POST['appFile'];

    $insertNewApplication = insertNewApplication($pdo, $user_id, $job_post_id, $appDesc);

    if($insertNewApplication){
      $_SESSION['message'] = '<h3 style="color: green">Application sent successfully!</h3>';
      header('location: ../jobPosts.php');
    }
  }

  if(isset($_POST['appAccept'])){
    $user_id = $_POST['user_id'];
    $job_post_id = $_POST['job_post_id'];

    $updateAppStatus = updateAppStatus($pdo, 'accepted', $user_id, $job_post_id);

    if($updateAppStatus){
      header('location: ../viewApplicants.php?post_id='.$job_post_id);
    }
  }

  if(isset($_POST['appReject'])){
    $user_id = $_POST['user_id'];
    $job_post_id = $_POST['job_post_id'];

    $updateAppStatus = updateAppStatus($pdo, 'rejected', $user_id, $job_post_id);

    if($updateAppStatus){
      header('location: ../viewApplicants.php?post_id='.$job_post_id);
    }
  }