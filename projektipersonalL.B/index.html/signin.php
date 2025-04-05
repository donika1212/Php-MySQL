<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";

$connect = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'login') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM users WHERE username=?";
        $query = $connect->prepare($sql);
        $query->execute(array($username));
        $row = $query->rowCount();
        $fetch = $query->fetch();
        if ($row > 0) {
            if (password_verify($password, $fetch["password"])) {
                $_SESSION["username"] = $fetch["username"];
                $_SESSION['isAdmin'] = $fetch["is_admin"];
                header("Location: index.php");
            }
        } else {
            echo $row;
            echo $sasd;
            $message = '<label>Wrong Data</label>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Sign In</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>User Sign In</h1>
        </header>
        <main>
            <?php if (isset($error)): ?>
                <p style="color:red;"><?php echo $error; ?></p>
            <?php endif; ?>
            <form action="" method="post">
                <input type="hidden" name="action" value="login">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Sign In</button>
            </form>
            <p><a href="signup.php">Don't have an account? Click here to sign up.</a></p>
        </main>
    </div>
</body>

</html>
