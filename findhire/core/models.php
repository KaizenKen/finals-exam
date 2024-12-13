<?php
  require_once 'dbConfig.php';

  function checkUserExists($pdo, $username, $password=null) {
    if($password != null){
      $sql = 'SELECT * FROM users WHERE user_name = ? AND user_password = ?';
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$username, $password]);

      if($stmt) {
        return $stmt->fetch();
      }
    }
    else {
      $sql = 'SELECT * FROM users WHERE user_name = ?';
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$username]);

      if($stmt) {
        return $stmt->fetchAll();
      }
    }
  }

  function insertNewUser($pdo, $username, $password, $firstname, $lastname){
    $sql = 'INSERT INTO users(user_name, user_password, first_name, last_name, user_role) VALUES(?,?,?,?,"Applicant")';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $password, $firstname, $lastname]);

    if($stmt){
      return true;
    }
  }

  function getAllJobPosts($pdo, $user_id=null){
    if($user_id != null){
      $sql = 'SELECT * FROM job_posts WHERE posted_by = ?';
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$user_id]);

      if($stmt) {
        return $stmt->fetchAll();
      }
    } else {
      $sql = 'SELECT * FROM job_posts';
      $stmt = $pdo->prepare($sql);
      $stmt->execute();

      if($stmt) {
        return $stmt->fetchAll();
      }
    }
  }

  function getUserById($pdo, $user_id){
    $sql = 'SELECT * FROM users WHERE user_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);

    if($stmt) {
      return $stmt->fetch();
    }
  }

  function insertNewPost($pdo, $post_title, $post_desc, $posted_by){
    $sql = 'INSERT INTO job_posts(post_title, post_description, posted_by) VALUES(?,?,?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$post_title, $post_desc, $posted_by]);

    if($stmt){
      return true;
    }
  }

  function insertNewApplication($pdo, $user_id, $job_post_id, $app_desc){
    $sql = 'INSERT INTO job_applications(user_id, job_post_id, app_desc) VALUES(?,?,?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $job_post_id, $app_desc]);

    if($stmt){
      return true;
    }
  }

  function getPostById($pdo, $post_id){
    $sql = 'SELECT * FROM job_posts WHERE post_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$post_id]);

    if($stmt) {
      return $stmt->fetch();
    }
  }

  function getApplicantsById($pdo, $post_id){
    $sql = 'SELECT * FROM job_applications WHERE job_post_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$post_id]);

    if($stmt) {
      return $stmt->fetchAll();
    }
  }

  function updateAppStatus($pdo, $newStatus, $user_id, $job_post_id){
    $sql = 'UPDATE job_applications SET app_status = ? WHERE user_id = ? AND job_post_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$newStatus, $user_id, $job_post_id]);

    if($stmt) {
      return true;
    }
  }