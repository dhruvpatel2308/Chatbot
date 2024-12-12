
<script>
          var navbarTopShape = window.config.config.phoenixNavbarTopShape;
          var navbarPosition = window.config.config.phoenixNavbarPosition;
          var body = document.querySelector('body');
          var navbarDefault = document.querySelector('#navbarDefault');
          var navbarTop = document.querySelector('#navbarTop');
          var topNavSlim = document.querySelector('#topNavSlim');
          var navbarTopSlim = document.querySelector('#navbarTopSlim');
          var navbarCombo = document.querySelector('#navbarCombo');
          var navbarComboSlim = document.querySelector('#navbarComboSlim');
          var dualNav = document.querySelector('#dualNav');

          var documentElement = document.documentElement;
          var navbarVertical = document.querySelector('.navbar-vertical');

          if (navbarPosition === 'dual-nav') {
            topNavSlim?.remove();
            navbarTop?.remove();
            navbarTopSlim?.remove();
            navbarCombo?.remove();
            navbarComboSlim?.remove();
            navbarDefault?.remove();
            navbarVertical?.remove();
            dualNav.removeAttribute('style');
            document.documentElement.setAttribute('data-navigation-type', 'dual');

          } else if (navbarTopShape === 'slim' && navbarPosition === 'vertical') {
            navbarDefault?.remove();
            navbarTop?.remove();
            navbarTopSlim?.remove();
            navbarCombo?.remove();
            navbarComboSlim?.remove();
            topNavSlim.style.display = 'block';
            navbarVertical.style.display = 'inline-block';
            document.documentElement.setAttribute('data-navbar-horizontal-shape', 'slim');

          } else if (navbarTopShape === 'slim' && navbarPosition === 'horizontal') {
            navbarDefault?.remove();
            navbarVertical?.remove();
            navbarTop?.remove();
            topNavSlim?.remove();
            navbarCombo?.remove();
            navbarComboSlim?.remove();
            dualNav?.remove();
            navbarTopSlim.removeAttribute('style');
            document.documentElement.setAttribute('data-navbar-horizontal-shape', 'slim');
          } else if (navbarTopShape === 'slim' && navbarPosition === 'combo') {
            navbarDefault?.remove();
            navbarTop?.remove();
            topNavSlim?.remove();
            navbarCombo?.remove();
            navbarTopSlim?.remove();
            dualNav?.remove();
            navbarComboSlim.removeAttribute('style');
            navbarVertical.removeAttribute('style');
            document.documentElement.setAttribute('data-navbar-horizontal-shape', 'slim');
          } else if (navbarTopShape === 'default' && navbarPosition === 'horizontal') {
            navbarDefault?.remove();
            topNavSlim?.remove();
            navbarVertical?.remove();
            navbarTopSlim?.remove();
            navbarCombo?.remove();
            navbarComboSlim?.remove();
            dualNav?.remove();
            navbarTop.removeAttribute('style');
            document.documentElement.setAttribute('data-navigation-type', 'horizontal');
          } else if (navbarTopShape === 'default' && navbarPosition === 'combo') {
            topNavSlim?.remove();
            navbarTop?.remove();
            navbarTopSlim?.remove();
            navbarDefault?.remove();
            navbarComboSlim?.remove();
            dualNav?.remove();
            navbarCombo.removeAttribute('style');
            navbarVertical.removeAttribute('style');
            document.documentElement.setAttribute('data-navigation-type', 'combo');
          } else {
            topNavSlim?.remove();
            navbarTop?.remove();
            navbarTopSlim?.remove();
            navbarCombo?.remove();
            navbarComboSlim?.remove();
            dualNav?.remove();
            navbarDefault.removeAttribute('style');
            navbarVertical.removeAttribute('style');
          }

          var navbarTopStyle = window.config.config.phoenixNavbarTopStyle;
          var navbarTop = document.querySelector('.navbar-top');
          if (navbarTopStyle === 'darker') {
            navbarTop.setAttribute('data-navbar-appearance', 'darker');
          }

          var navbarVerticalStyle = window.config.config.phoenixNavbarVerticalStyle;
          var navbarVertical = document.querySelector('.navbar-vertical');
          if (navbarVerticalStyle === 'darker') {
            navbarVertical.setAttribute('data-navbar-appearance', 'darker');
          }
        </script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
        }

        button {
            width: 48%;
            padding: 10px;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

    

        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <main class="main" id="top">
        

        <div class="container">
            <h2>Change Password</h2>
            <form method="POST" action="" name="">
                <div>
                    <input type="password" name="old_password" placeholder="Old Password" required>
                </div>
                <div>
                    <input type="password" name="new_password" placeholder="New Password" required>
                </div>
                <div>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                </div>

                <!-- Button Group with Submit and Home Button -->
                <div class="button-group">
                    <button type="submit" name="change_password">Submit</button>
                </div>
            </form>
        </div>
    </main>

<?php
    include 'partials/connect.php';
    include 'partials/topnav.php';
    include 'partials/sidebar.php';
    include 'partials/head.php';
    include 'partials/footer.php';
    include 'partials/additional.php';

    if(isset($_POST['change_password'])){
        $admin_username = $_SESSION['admin_username'];
        $old_password =  $_POST['old_password'];

        $decrypt_get_admin = "SELECT * FROM admin_tbl WHERE admin_username='$admin_username'";
        $decrypt_run_admin = pg_query($con, $decrypt_get_admin);

        if (pg_num_rows($decrypt_run_admin) > 0) {
            $row_decrypt_admin = pg_fetch_array($decrypt_run_admin);
            $hash_password = $row_decrypt_admin["admin_password"];

            if (password_verify($old_password, $hash_password)) {
                $new_password = $_POST['new_password'];
                $confirm_password = $_POST['confirm_password'];
                if($new_password == $confirm_password){
                    $new_hash = password_hash($confirm_password, PASSWORD_DEFAULT);
                    $update = "UPDATE admin_tbl SET admin_password = '$new_hash' where admin_username = '$admin_username'";
                    if(pg_query($con,$update)){
                        echo "<script>alert('Password Changed Successfully.')</script>";    
                    }
                    else{
                        die('Error: ' . pg_result_error($con));
                    }
                }
                else{
                    echo "<script>alert('New and Confirm Password does not match, Please Try Again')</script>";    
                }

            } else {
                echo "<script>alert('Old Password Is Wrong, Please Try Again')</script>";
            }
        }
    }

?>
</body>
</html>
