
<?php

  session_start();

  if (!isset($_SESSION['admin_username']) || empty($_SESSION['admin_username'])) {
    echo "<script>window.open('login.php','_self')</script>";
}
  else
  {

    date_default_timezone_set('America/Toronto');

    $current_year = date('Y');

    include("partials/connect.php");

    $admin_username = $_SESSION['admin_username'];

    $select_admin = "select * from admin_tbl where admin_username='$admin_username'";

    $run_admin = pg_query($con, $select_admin);

if ($run_admin === false) {
    die("Query failed: " . pg_last_error($con));
}


$row_admin = pg_fetch_array($run_admin);

if ($row_admin === false) {
    die("No admin found for username: $admin_username");
}


    $admin_id = $row_admin['admin_id'];

    $admin_name = $row_admin['admin_name'];

    $admin_email = $row_admin['admin_email'];

    $admin_contact = $row_admin['admin_contact'];

    $admin_location = $row_admin['admin_location'];

    $admin_pic = $row_admin['admin_pic'];

    $admin_password = $row_admin['admin_password'];

    $created_at = $row_admin['created_at'];

?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr" data-navigation-type="default" data-navbar-horizontal-shape="default">

  
<head>
    <?php include('partials/head.php'); ?>

     <?php include('partials/css.php'); ?>
    
  </head>

  <body>

    <main class="main" id="top">
      <?php include('partials/sidebar.php'); ?>
      <?php include('partials/topnav.php'); ?>
    
    <?php

      if (isset($_GET['dashboard']))
      {
        include('dashboard.php');
      }

      else if (isset($_GET['knowledge_base']))
      {
        include('knowledge_base.php');
      }

      else if (isset($_GET['kb_delete']))
      {
        include('kb_delete.php');
      }

      else if (isset($_GET['users']))
      {
        include('users.php');
      }
      else if (isset($_GET['profile']))
      {
        include('profile.php');
        
      }
      else if (isset($_GET['security']))
      {
        include('security.php');
      }
      else if (isset($_GET['helpcenter']))
      {
        include('helpcenter.php');
      }
      


    ?>

    </main>

    <!-- <?php include('partials/customizer.php'); ?> -->

    <?php include('partials/js.php'); ?>
  </body>
</html>

<?php } ?>