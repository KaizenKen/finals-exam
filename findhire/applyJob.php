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
  <?php $getPostById = getPostById($pdo, $_GET['post_id'])?>
  <a href="jobPosts.php">Go Back</a>
  <h1>FindHire</h1>
  <h2>Job Title: <?php echo $getPostById['post_title']?></h2>
  <p>Job Description: <?php echo $getPostById['post_description']?></p>

  <form action="core/handleForms.php" method="POST">
    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']?>">
    <input type="hidden" name="post_id" value="<?php echo $getPostById['post_id']?>">
    <label for="">Why should you be hired for this job:</label><br>
    <textarea name="appDesc" style="width:250px;height:100px;resize:none;"></textarea>
    <br><br>
    <label for="">Upload Resume:</label>
    <input type="file" name="appFile">
    <br><br>
    <input type="submit" value="Submit" name="appSubmit">
  </form>
</body>
</html>