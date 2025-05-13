<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    require_once 'includes/config.php';

    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM mood_history WHERE user_id = :user_id ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Mood History ✨</title>
</head>
<body>
    <header>
        <div class="nav">
            <div class="logo">
                <h2>DailyMood</h2>
            </div>
            <ul class="menu-List">
                <li><a href="dashboard.php">Dashboard</a></li>
            </ul>
        </div>
    </header>

    <div class="container">
        <h1>Your Mood History</h1>
        <p id="bd_p">Track your emotional journey over time</p>

        <div class="history-section">
            <?php if (!empty($result)): ?>
                <?php foreach ($result as $row): ?>
                    <div class="mood-card">
                        <div class="mood-header">
                            <span class="mood-emoji">
                                <?php
                                    switch($row['mood']) {
                                        case 'Amazing': echo '😄'; break;
                                        case 'Good': echo '🙂'; break;
                                        case 'Okay': echo '😐'; break;
                                        case 'Meh': echo '😕'; break;
                                        case 'Bad': echo '😞'; break;
                                        case 'Terrible': echo '😫'; break;
                                        default: echo '😐';
                                    }
                                ?>
                            </span>
                            <span class="mood-date">
                                <?php echo date('F j, Y', strtotime($row['created_at'])); ?>
                            </span>
                        </div>
                        <div class="mood-note">
                            <?php echo htmlspecialchars($row['note'] ?? 'No note added'); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-moods">
                    <p>No mood entries yet. Start tracking your mood!</p>
                </div>
            <?php endif; ?>
        </div>
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