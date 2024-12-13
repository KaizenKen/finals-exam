<?php
  require_once 'core/dbConfig.php';
  require_once 'core/models.php';

  if(!isset($_SESSION['username'])){
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
  <h1>FindHire</h1>
  <h2>Welcome back, <?php echo $_SESSION['first_name']?>!</h2>
  - <a href="profile.php">Profile</a>
  <?php if($_SESSION['user_role'] == 'Applicant') { ?>
    - <a href="jobPosts.php">View All Job Posts</a>
    - <a href="#">View Sent Applications</a> -
  <?php } else { ?>
    - <a href="postnewjob.php">Post New Job</a>
    - <a href="viewPosts.php">View Posted Jobs</a> -
  <?php }?>
  <form action="core/handleForms.php" method="POST" style="margin-top:25px;">
    <input type="submit" value="Log Out" name="logoutBtn">
  </form>
</body>
</html>