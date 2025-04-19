<?php
  include_once('config.php');

  if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the current details of the user
    $sql = "SELECT * FROM users WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $user = $stmt->fetch();
  }

  if(isset($_POST['submit'])) {
    // Collect new data from the form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $confirm_password = password_hash($_POST['confirm_password'], PASSWORD_DEFAULT);
    $is_admin = $_POST['is_admin'];

    // Update user information
    $sql = "UPDATE users SET username=:username, email=:email, password=:password, confirm_password=:confirm_password, is_admin=:is_admin WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':confirm_password', $confirm_password);
    $stmt->bindParam(':is_admin', $is_admin);
    
    if($stmt->execute()) {
      header("Location: dashboard.php");
    } else {
      echo "Error updating user.";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Edit User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <div class="container mt-5">
    <h2>Edit User Details</h2>
    <form action="" method="POST">
      <div class="form-group mb-3">
        <label for="username">Username:</label>
        <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>" required>
      </div>

      <div class="form-group mb-3">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
      </div>

      <div class="form-group mb-3">
        <label for="password">New Password:</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>

      <div class="form-group mb-3">
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
      </div>

      <div class="form-group mb-3">
        <label for="is_admin">Admin Status:</label>
        <select class="form-control" id="is_admin" name="is_admin">
          <option value="true" <?php if($user['is_admin'] == 'true') echo 'selected'; ?>>Admin</option>
          <option value="false" <?php if($user['is_admin'] == 'false') echo 'selected'; ?>>User</option>
        </select>
      </div>

      <button type="submit" class="btn btn-primary" name="submit">Update User</button>
    </form>
  </div>
</body>
</html>
