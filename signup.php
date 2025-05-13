<?php

session_start();
require_once 'includes/config.php';

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    if (empty($email) || empty($password) || empty($name)) {
        $error = "Please fill in all fields";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password , created_at) VALUES (:user , :email, :pass , :datetimee)");
        $stmt->execute([
            ':user' => $name,
            ':email' => $email,
            ':pass' => $password,
            ':datetimee' => date("Y-m-d H:i:s")
        ]);

        header("Location: login.php");
        exit();
}}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Daily Mood Tracker ✨ | Singup</title>
</head>

<body>
    <header>
        <div class="nav">
            <div class="logo">
                <h2>DailyMood</h2>
            </div>
            <!-- <ul class="menu-List">
                <li>History</li>
            </ul> -->
        </div>
    </header>
<main class="container auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1>Singup</h1>
            <p>Hi! Please enter your information to creat a account</p>
        </div>
        
        <?php if (!empty($error)): ?>
            <div class="alert alert-error">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="auth-form">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn btn-primary btn-block">Sign up</button>
        </form>
        
        <div class="auth-footer">
            <p>Don't have an account? <a href="./login.php">login</a></p>
        </div>

    </div>
</main>
</body>