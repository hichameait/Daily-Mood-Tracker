<?php
session_start();
require_once 'includes/config.php';

$error = "";
$quots = "";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['add'])) {
    if (!empty($_POST["mood"]) || !empty($_POST["note"])) {
        $user_id = $_SESSION['user_id'];
        
        $mood = htmlspecialchars($_POST["mood"]);
        $note = htmlspecialchars($_POST["note"]);
    
        $sql = "INSERT INTO mood_history (user_id, mood, note, created_at) VALUES (:userid , :mood, :note , :created_at)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':userid' => $user_id,
            ':mood' => $_POST["mood"],
            ':note' => $_POST["note"],
            ':created_at' => date("Y-m-d H:i:s")
        ]);

        $quote = file_get_contents("https://quotes-api-self.vercel.app/quote");
        $quoteData = json_decode($quote, true);


        if (isset($quoteData['quote']) && isset($quoteData['author'])) {
            $quots = "<div class='quote-section'>
                <div class='quote-content'>
                    <p id='quote-text'>{$quoteData['quote']}</p>
                    <small id='quote-author'>{$quoteData['author']}</small>
                </div>
            </div>";
        } else {
            $quots = "";
        }

        // $data = [
        //     'user_id' => $_SESSION['user_email'],
        //     'mood' => $_POST["mood"],
        //     'note' => $_POST["note"],
        //     'quote' => $quoteData['quote'],
        //     'author' => $quoteData['author']
        // ];
        
        $data = [
            "data" => [
                'user_id' => $_SESSION['user_email'],
                'mood' => $_POST["mood"],
                'note' => $_POST["note"],
                'quote' => $quoteData['quote'],
                'author' => $quoteData['author']
            ]
        ];
        
        // Webhook URL dyal n8n
        $webhook_url = "https://hook.eu2.make.com/4mefvodjsa2e5jrgtanfvxtbv0qkbbx5";
        
        $ch = curl_init($webhook_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($ch);
        curl_close($ch);
        
    }else {
        $error = "Please fill in all fields";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Daily Mood Tracker ✨</title>
</head>

<body>
    <header>
        <div class="nav">
            <div class="logo">
                <h2>DailyMood</h2>
            </div>
            <ul class="menu-List">
                <li><a href="history.php">History</a></li>
            </ul>
        </div>
    </header>
    <div class="container">
        <h1 id="bd_h">Track Your Daily Mood</h1>
        <p id="bd_p">Record how you feel each day and discover patterns in your emotional wellbeing</p>

        <form action="" method="post">
            <div class="form-section">
                <div class="f_header">
                    <h3>How are you feeling today?</h3>
                    <p>Track your mood and add a note about your day</p>
                </div>
                <div class="f_selection">
                    <h4>Select your mood</h4>
                    <select name="mood" id="mood" required>
                        <option value="">Choose your mood...</option>
                        <option value="Amazing">Amazing 😄</option>
                        <option value="Good">Good 🙂</option>
                        <option value="Okay">Okay 😐</option>
                        <option value="Meh">Meh 😕</option>
                        <option value="Bad">Bad 😞</option>
                        <option value="Terrible">Terrible 😫</option>
                    </select>
                </div>
                <div class="f_note">
                    <h4>Add a note</h4>
                    <textarea name="note" id="note" placeholder="What made you feel this way today?" required></textarea>
    
                    </textarea>
                </div>
                <p style="color:red;"><?= $error ?></p>
                <button type="submit" class="btn btn-primary" name="add">Save Today's Mood</button>
            </div>
            <?= $quots?>
        </form>

    </div>
    <footer class="footer">
    <div class="footer-content">
        <div class="footer-links">
            <a href="#">About</a>
            <a href="#">Privacy</a>
            <a href="#">Terms</a>
            <a href="#">Contact</a>
        </div>
        <div class="copyright">
            <p>&copy; 2025 DailyMood. All rights reserved.</p>
        </div>
    </div>
</footer>

</body>

</html>