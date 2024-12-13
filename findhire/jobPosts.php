<?php
  require_once 'core/dbConfig.php';
  require_once 'core/models.php';

  if(!isset($_SESSION['username'])){
    $_SESSION['message'] = '<h3 style="color: red">Please Log In to continue.</h3>';
    header('location: login.php');
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
  <a href="index.php">Go Back</a>
  <h1>FindHire</h1>
  <?php if(isset($_SESSION['message'])) {?>
    <?php
      echo $_SESSION['message'];
      unset($_SESSION['message']);
    ?>
  <?php } ?>
  <h2>Job Posts:</h2>
  <?php $getAllJobPosts = getAllJobPosts($pdo)?>
  <?php foreach ($getAllJobPosts as $row) {?>
    <div style="border:1px solid black; width:25%; padding:10px; margin-top:25px">
      <h3>Job Title: <?php echo $row['post_title']?></h3>
      <p>Description: <?php echo $row['post_description']?></p>
      <?php $getUserByID = getUserByID($pdo, $row['posted_by'])?>
      <p>Posted By: <?php echo $getUserByID['first_name']?></p>
      <p>Date Posted: <?php echo $row['date_posted']?></p>
      <a href="applyJob.php?post_id=<?php echo $row['post_id']?>">Apply</a>
    </div>
  <?php } ?>
</body>
</html>