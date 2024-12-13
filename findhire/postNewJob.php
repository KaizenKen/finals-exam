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
  <form action="core/handleForms.php" method="POST">
    <h2>Post new Job Application:</h2>
    <p>
      <label for="">Job Title:</label>
      <input type="text" name="newjobTitle">
    </p>
    <p>
      <label for="">Job Description:</label>
      <input type="text" name="newjobDesc">
    </p>
    <input type="hidden" name="postedBy" value="<?php echo $_SESSION['user_id']?>">
    <input type="submit" value="Post" name="postnewjobBtn">
  </form>
  <?php if(isset($_SESSION['message'])) {?>
    <?php
      echo $_SESSION['message'];
      unset($_SESSION['message']);
    ?>
  <?php } ?>
</body>
</html>