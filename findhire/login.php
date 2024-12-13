<?php
  require_once 'core/dbConfig.php';
  require_once 'core/models.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<h>
  <h1>Welcome to FindHire!</h1>

  <form action="core/handleForms.php" method="POST">
    <h3>Please Log In to continue:</h3>
    <p>
      <label for="">Username: </label>
      <input type="text" name="loginUsername">
    </p>
    <p>
      <label for="">Password: </label>
      <input type="password" name="loginPassword">
    </p>
    <p>
      <input type="submit" value="Log In" name="loginBtn">
    </p>

    <h3>Or Sign Up:</h3>
    <p>
      <label for="">Username: </label>
      <input type="text" name="signupUsername">
    </p>
    <p>
      <label for="">First Name: </label>
      <input type="text" name="signupFirstName">
    </p>
    <p>
      <label for="">Last Name: </label>
      <input type="text" name="signupLastName">
    </p>
    <p>
      <label for="">Password: </label>
      <input type="password" name="signupPassword">
    </p>
    <p>
      <input type="submit" value="Sign Up" name="signupBtn">
    </p>
  </form>
  <?php if(isset($_SESSION['message'])) {?>
    <?php
      echo $_SESSION['message'];
      unset($_SESSION['message']);
    ?>
  <?php } ?>
</body>
</html>