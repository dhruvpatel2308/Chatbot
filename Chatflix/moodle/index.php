

<?php

  session_start();

  if(!isset($_SESSION['user_username']))
  {

    echo "<script>window.open('login.php','_self')</script>";

  }
  else
  {

    date_default_timezone_set('America/Toronto');

    $current_year = date('Y');

    include("partials/connect.php");

    $user_username = $_SESSION['user_username'];

    $select_user = "select * from users_tbl where user_username='$user_username'";

    $run_user = pg_query($con,$select_user);

    $row_user = pg_fetch_array($run_user);

    $user_id = $row_user['user_id'];


    $config_path = realpath(dirname(__FILE__) . '/../config.ini');
    $config = parse_ini_file($config_path, true);
    $backendIP = $config['backend']['ip'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Home | Loyalist College in Toronto</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/images/logo.png" rel="icon">

   <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src=" https://unpkg.com/showdown/dist/showdown.min.js"></script>
</head>
<body>
    <!-- Your website content -->
    <img src="images/bg.jpeg" style="width: 100%; object-fit: cover;">

    <!-- Chatbot Button -->
    <button id="openChatbotBtn" class="chatbot-btn">
        <i class="fas fa-comments"></i>
    </button>

    <!-- Chatbot Popup -->
    <div id="chatbotPopup" class="chatbot-popup">
        <div class="chatbot-header">
            <img src="images/logo_v2.png" alt="Chatbot Logo" class="logo"> <!-- Add your logo here -->
            <span>ChatFlix Moodle Assistant</span>
            <button id="enlargeChatbotBtn" class="enlarge-btn"><i class="fas fa-expand-arrows-alt"></i></button>
        </div>
        <div id="chatbox" class="chatbox"></div>
        <div class="chatbot-footer">
            <textarea id="input" class="chat-input" placeholder="Type your message..."></textarea>
            <button id="sendButton" class="send-btn">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>

    <!-- Floating Greeting Message -->
    <div id="floatingGreeting" class="floating-greeting">
        Welcome! How can I assist you today?
    </div>
    <script>
        const backendIP = '<?php echo $backendIP; ?>';
    </script>
    <script src="chatbot.js"></script>
    <script src=" https://unpkg.com/showdown/dist/showdown.min.js"></script>
</body>
</html>

<?php } ?>
