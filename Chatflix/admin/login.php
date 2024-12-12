
<?php

session_start();

include('partials/connect.php');
// Check if the session exists
// if (!isset($_SESSION['admin_username'])) {
//   echo "<script>
//       const expiry = localStorage.getItem('admin_username_expiry');
//       const currentTime = Date.now();

//       if (!expiry || currentTime > expiry) {
//           // Clear localStorage if expired
//           localStorage.removeItem('admin_username');
//           localStorage.removeItem('admin_username_expiry');
//           window.open('login.php', '_self');
//       } else {
//           // Set the session again if still within expiry
//           const adminUsername = localStorage.getItem('admin_username');
//           // You may set this in the session if needed
//       }
//   </script>";
//   exit;
// }
?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr" data-navigation-type="default" data-navbar-horizontal-shape="default">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- ===============================================-->
  <!--    Document Title-->
  <!-- ===============================================-->
  <title>Chatflix | Admin Login</title>

  <!-- ===============================================-->
  <!--    Favicons-->
  <!-- ===============================================-->
    <!-- <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
    <link rel="manifest" href="assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png"> -->
    <link rel='shortcut icon' type='image/x-icon' href='assets/images/favicon.png' />
    <meta name="theme-color" content="#ffffff">
    <script src="vendors/simplebar/simplebar.min.js"></script>
    <script src="assets/js/config.js"></script>

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="vendors/simplebar/simplebar.min.css" rel="stylesheet">
    <link rel="stylesheet" href="unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="assets/css/theme-rtl.min.css" type="text/css" rel="stylesheet" id="style-rtl">
    <link href="assets/css/theme.min.css" type="text/css" rel="stylesheet" id="style-default">
    <link href="assets/css/user-rtl.min.css" type="text/css" rel="stylesheet" id="user-style-rtl">
    <link href="assets/css/user.min.css" type="text/css" rel="stylesheet" id="user-style-default">
    <script>
      var phoenixIsRTL = window.config.config.phoenixIsRTL;
      if (phoenixIsRTL) {
        var linkDefault = document.getElementById('style-default');
        var userLinkDefault = document.getElementById('user-style-default');
        linkDefault.setAttribute('disabled', true);
        userLinkDefault.setAttribute('disabled', true);
        document.querySelector('html').setAttribute('dir', 'rtl');
      } else {
        var linkRTL = document.getElementById('style-rtl');
        var userLinkRTL = document.getElementById('user-style-rtl');
        linkRTL.setAttribute('disabled', true);
        userLinkRTL.setAttribute('disabled', true);
      }
    </script>
  </head>

  <body>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <div class="container-fluid bg-body-tertiary dark__bg-gray-1200">
        <div class="bg-holder bg-auth-card-overlay" style="background-image:url(assets/img/bg/37.png);"></div>
        <!--/.bg-holder-->
        <div class="row flex-center position-relative min-vh-100 g-0 py-5">
          <div class="col-11 col-sm-10 col-xl-8">
            <div class="card border border-translucent auth-card">
              <div class="card-body pe-md-0">
                <div class="row align-items-center gx-0 gy-7">
                  <div class="col-auto bg-body-highlight dark__bg-gray-1100 rounded-3 position-relative overflow-hidden auth-title-box">
                    <div class="bg-holder" style="background-image:url(assets/img/bg/38.png);"></div>
                    <!--/.bg-holder-->
                    <div class="position-relative px-4 px-lg-7 pt-7 pb-7 pb-sm-5 text-center text-md-start pb-lg-7 pb-md-7">
                      <h3 class="mb-3 text-body-emphasis fs-7">ChatFlix Authentication</h3>
                      <p class="text-body-tertiary">Give yourself some hassle-free development process with the uniqueness of Phoenix!</p>
                      <ul class="list-unstyled mb-0 w-max-content w-md-auto">
                        <li class="d-flex align-items-center"><span class="uil uil-check-circle text-success me-2"></span><span class="text-body-tertiary fw-semibold">Fast</span></li>
                        <li class="d-flex align-items-center"><span class="uil uil-check-circle text-success me-2"></span><span class="text-body-tertiary fw-semibold">Simple</span></li>
                        <li class="d-flex align-items-center"><span class="uil uil-check-circle text-success me-2"></span><span class="text-body-tertiary fw-semibold">Responsive</span></li>
                      </ul>
                    </div>
                    <div class="position-relative z-n1 mb-6 d-none d-md-block text-center mt-md-15"><img class="auth-title-box-img d-dark-none" src="assets/img/spot-illustrations/auth.png" alt="" /><img class="auth-title-box-img d-light-none" src="assets/img/spot-illustrations/auth-dark.png" alt="" /></div>
                  </div>
                  <div class="col mx-auto">
                    <form action="login.php" method="POST">
                      <div class="auth-form-box">
                        <div class="text-center mb-7"><a class="d-flex flex-center text-decoration-none mb-4" href="index.html">
                          <div class="d-flex align-items-center fw-bolder fs-3 d-inline-block"><img src="assets/images/name.png" alt="phoenix" width="100" /></div>
                        </a>
                        <h3 class="text-body-highlight">Sign In</h3>
                        <p class="text-body-tertiary">Get access to your account</p>
                      </div>
                      <button class="btn btn-phoenix-secondary w-100 mb-3"><span class="fab fa-google text-danger me-2 fs-9"></span>Sign in with google</button><button class="btn btn-phoenix-secondary w-100"><span class="fab fa-facebook text-primary me-2 fs-9"></span>Sign in with facebook</button>
                      <div class="position-relative">
                        <hr class="bg-body-secondary mt-5 mb-4" />
                        <div class="divider-content-center bg-body-emphasis">or use email</div>
                      </div>                    
                      <div class="mb-3 text-start"><label class="form-label" for="admin_username_login">Username</label>
                        <div class="form-icon-container"><input class="form-control form-icon-input" id="admin_username_login" type="text" placeholder="name@example.com" name="admin_username_login" /><span class="fas fa-user text-body fs-9 form-icon"></span></div>
                      </div>
                      <div class="mb-3 text-start"><label class="form-label" for="password">Password</label>
                        <div class="form-icon-container" data-password="data-password"><input class="form-control form-icon-input pe-6" id="password" type="password" placeholder="Password" data-password-input="data-password-input" name="admin_password_login" /><span class="fas fa-key text-body fs-9 form-icon"></span><button class="btn px-3 py-0 h-100 position-absolute top-0 end-0 fs-7 text-body-tertiary" data-password-toggle="data-password-toggle"><span class="uil uil-eye show"></span><span class="uil uil-eye-slash hide"></span></button></div>
                      </div>
                      <div class="row flex-between-center mb-7">
                        <div class="col-auto">
                        <div class="form-check mb-0">
                          <input class="form-check-input" id="basic-checkbox" type="checkbox" name="remember_me" />
                          <label class="form-check-label mb-0" for="basic-checkbox">Remember me</label>
                          </div>
                        </div>
                        <div class="col-auto"><a class="fs-9 fw-semibold" href="forgot-password.html">Forgot Password?</a></div>
                      </div><button type="submit" class="btn btn-primary w-100 mb-3" name="admin_login">Sign In</button>
                      <div class="text-center"><a class="fs-9 fw-bold" href="register.php">Create an account</a></div>
                    </div>
                  </form>
                  <script>
                    document.addEventListener("DOMContentLoaded", function() {
                    const storedUsername = localStorage.getItem('admin_username');
                    if (storedUsername) {
                      document.getElementById('admin_username_login').value = storedUsername;
                    }
                  });
                </script>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main><!-- ===============================================-->
  <!--    End of Main Content-->
  <!-- ===============================================-->


  <!-- ===============================================-->
  <!--    JavaScripts-->
  <!-- ===============================================-->
  <script src="vendors/popper/popper.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.min.js"></script>
  <script src="vendors/anchorjs/anchor.min.js"></script>
  <script src="vendors/is/is.min.js"></script>
  <script src="vendors/fontawesome/all.min.js"></script>
  <script src="vendors/lodash/lodash.min.js"></script>
  <script src="vendors/list.js/list.min.js"></script>
  <script src="vendors/feather-icons/feather.min.js"></script>
  <script src="vendors/dayjs/dayjs.min.js"></script>
  <script src="assets/js/phoenix.js"></script>
</body>


<!-- Mirrored from prium.github.io/phoenix/v1.18.0/pages/authentication/card/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 09 Jul 2024 19:57:32 GMT -->
</html>


<?php

if(isset($_POST['admin_login'])){

  $admin_username = pg_escape_string($con, $_POST['admin_username_login']);
  $admin_password = pg_escape_string($con, $_POST['admin_password_login']);

  $decrypt_get_admin = "select * from admin_tbl where admin_username='$admin_username'";

  $decrypt_run_admin = pg_query($con,$decrypt_get_admin);

  $row_decrypt_admin = pg_fetch_array($decrypt_run_admin);

  if(!$row_decrypt_admin) {
    echo "<script>alert('User not found')</script>";
    exit();
  }

  $hash_password = $row_decrypt_admin["admin_password"];

  // Debugging outputs
  //echo "<script>console.log('Hashed password from DB: $hash_password');</script>";
  //echo "<script>console.log('Entered password: $admin_password');</script>";

  $decryt_password = password_verify($admin_password, $hash_password);

  if(!$decryt_password) {
    echo "<script>alert('Password verification failed: Email Or Password Is Wrong, Please Try Again')</script>";
  } else {
    $_SESSION['admin_username'] = $admin_username;

    echo "<script>
            const expiryTime = Date.now() + 30 * 24 * 60 * 60 * 1000; // 30 days
            localStorage.setItem('admin_username', '$admin_username');
            localStorage.setItem('admin_username_expiry', expiryTime);
            alert('You are logged into the Admin Panel');
            window.open('index.php?dashboard', '_self');
        </script>";
  }

}

?>