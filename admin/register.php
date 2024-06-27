
<!DOCTYPE html>
<html>
<head>
  <title>User Registration</title>
  <link rel="stylesheet" href="css/userreg.css" />
</head>
  <div class="container">
  <h1>User Registration</h1>
  <form method="post" action="#">
    
    <label for="username">Username:</label>
    <input type="text" id="username" name="name" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <label for="confirm-password">Confirm Password:</label>
    <input type="password" id="confirm-password" name="confirm-password" required>
    <br>
    <input type="submit" class="button" value="Register">
    <p>Already a member? <a href="login.php">Login</a></p>
  </form>

</div>
</body>
</html>
<?php
include '../components/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $password = $_POST['password'];
  $confirm_password = $_POST['password'];
  

  // Check if password and confirm password match
  if ($password !== $confirm_password) {
      echo "Passwords do not match.";
      exit();
  }

  // Hash the password
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Prepare and bind
  $stmt = $conn->prepare("INSERT INTO admin(name, password) VALUES (?, ?)");
  $stmt->bind_param("ss", $name, $password);

  // Execute the statement
  if ($stmt->execute()) {
      echo "Registration successful!";
      header("location: index.php");
  } else {
      echo "Error: " . $stmt->error;
  }

  $stmt->close();
}

$conn->close();
?>
    