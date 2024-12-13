<?php
  require_once 'core/dbConfig.php';
  require_once 'core/models.php';

  if(!isset($_SESSION['username'])){
    $_SESSION['message'] = '<h3 style="color: red">Please Log In to continue.</h3>';
    header('location: login.php');
  }

  if(!isset($_GET['post_id'])){
    header('location: index.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <a href="viewPosts.php">Go Back</a>
  <h1>FindHire</h1>

  <?php $getPostById = getPostById($pdo, $_GET['post_id'])?>
  <h2>Job Title: <?php echo $getPostById['post_title']?></h2>
  <h3>Job Description: <?php echo $getPostById['post_description']?></h3>

  <p>Applicants:</p>
  <?php $getApplicantsById = getApplicantsById($pdo, $_GET['post_id'])?>
  <?php foreach($getApplicantsById as $row) { ?>
    <div style="border:1px solid black; width:25%; padding:10px; margin-top:25px">
      <form action="core/handleForms.php" method="POST">
        <?php $getUserByID = getUserByID($pdo, $row['user_id'])?>
        <p>
          <label for="">First Name: <?php echo $getUserByID['first_name'] ?></label>
        </p>
        <p>
          <label for="">Last Name: <?php echo $getUserByID['last_name']?></label>
        </p>
        <p>
          <label for="">Reasons for hiring:<br><?php echo $row['app_desc']?></label>
        </p>
        <p>
          <label for="">Date Applied: <?php echo $row['date_applied']?></label>
        </p>
        <?php if($row['app_status'] == 'accepted') {?>
          <button disabled>Accepted</button>
        <?php } else if($row['app_status'] == 'rejected'){?>
          <button disabled>Rejected</button>
        <?php } else {?>
          <input type="hidden" name="user_id" value="<?php echo $row['user_id']?>">
          <input type="hidden" name="job_post_id" value="<?php echo $row['job_post_id']?>">

          <input type="submit" name="appAccept" value="Accept">
          <input type="submit" name="appReject" value="Reject">
          <input type="submit" name="appDownload" value="Download Resume">
        <?php }?>
      </form>
    </div>
  <?php } ?>
</body>
</html>