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
                <li>Dashboard</li>
                <li>History</li>
                <li>Insights</li>
                <li>Settings</li>
            </ul>
        </div>
    </header>
    <div class="container">
        <h1 id="bd_h">Track Your Daily Mood</h1>
        <p id="bd_p">Record how you feel each day and discover patterns in your emotional wellbeing</p>

        <div class="form-section">
            <div class="f_header">
                <h2>How are you feeling today?</h2>
                <p>Track your mood and add a note about your day</p>
            </div>
            <div class="f_selection">
                <h2>Select your mood</h2>
                <select name="mood" id="mood">
                    <option value="amazing">Amazing 😄</option>
                    <option value="good">Good 🙂</option>
                    <option value="okay">Okay 😐</option>
                    <option value="meh">Meh 😕</option>
                    <option value="bad">Bad 😞</option>
                    <option value="terrible">Terrible 😫</option>
                </Select>
            </div>
            <div class="f_note">
                <h2>Add a note (optional)</h2>
                <textarea name="note" id="note" placeholder="What made you feel this way today?" ></textarea>

                </textarea>
            </div>
        </div>
        
        <div class="quote-section">
            <div class="quote-content">
                <p id="quote-text">"Your emotions are the slaves to your thoughts, and you are the slave to your emotions."</p>
                <small id="quote-author">DIPLO SPY</small>
            </div>
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