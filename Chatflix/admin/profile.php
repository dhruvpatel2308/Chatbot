
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


<?php

    include 'partials/connect.php';
    include 'partials/topnav.php';
    include 'partials/sidebar.php';
    include 'partials/head.php';
    include 'partials/footer.php';
    include 'partials/additional.php';

// Check if user is logged in
if (!isset($_SESSION['admin_username'])) {
    exit('Unauthorized access');
}

// Get logged-in user's username from session
$username = $_SESSION['admin_username'];

// Fetch current user data
$query = "SELECT * FROM admin_tbl WHERE admin_username = $1";
$result = pg_query_params($con, $query, array($username));

if ($result) {
    $user = pg_fetch_assoc($result);
    if ($user) {
        $email = $user['admin_email'];
        $contact = $user['admin_contact'];
        $profile_pic = $user['admin_pic'];
    } else {
        echo "<script>alert('User not found!');</script>";
        echo "<script>window.open('index.php', '_self')</script>";
        exit();
    }
} else {
    echo "<script>alert('Database query failed!');</script>";
    exit();
}

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $updated_email = $_POST['email'];
    $updated_contact = $_POST['contact'];
    $new_profile_pic = $profile_pic; // Initialize with the current picture path

    // Profile picture update logic
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['profile_pic']['tmp_name'];
        $file_name = uniqid() . '_' . basename($_FILES['profile_pic']['name']); // Generate unique file name
        $upload_directory = 'assets/images/';
        $file_path = $upload_directory . $file_name;

        // Move uploaded file to destination
        if (move_uploaded_file($file_tmp, $file_path)) {
            $new_profile_pic = $file_path; // Set the new profile picture path
           
        } else {
            echo "<script>alert('Failed to upload profile picture');</script>";
        }
    }

    // Ensure email and contact are not empty
    if (!empty($updated_email) && !empty($updated_contact)) {
        // Build SQL query based on the presence of a new profile picture
        if ($new_profile_pic !== $profile_pic) {
            $update_query = "UPDATE admin_tbl SET admin_email = $1, admin_contact = $2, admin_pic = $3 WHERE admin_username = $4";
            $params = array($updated_email, $updated_contact, $new_profile_pic, $username);
        } else {
            $update_query = "UPDATE admin_tbl SET admin_email = $1, admin_contact = $2 WHERE admin_username = $3";
            $params = array($updated_email, $updated_contact, $username);
        }

        // Execute the update query
        $update_result = pg_query_params($con, $update_query, $params);

        if ($update_result) {
            echo "<script>alert('Profile updated successfully!');</script>";
            // Get logged-in user's username from session
            $username = $_SESSION['admin_username'];
            echo "<script>alert(.$username.);</script>";
            // Fetch current user data
            $query = "SELECT * FROM admin_tbl WHERE admin_username = $1";
            $result = pg_query_params($con, $query, array($username));

            if ($result) {
                $user = pg_fetch_assoc($result);
                if ($user) {
                    $email = $user['admin_email'];
                    $contact = $user['admin_contact'];
                    $profile_pic = $user['admin_pic'];
                } else {
                    echo "<script>alert('User not found!');</script>";
                    echo "<script>window.open('index.php', '_self')</script>";
                    exit();
                }
            } else {
                echo "<script>alert('Database query failed!');</script>";
                exit();
            }

        } else {
            // Print SQL error for debugging
            echo "<script>alert('Error updating profile: " . pg_last_error($con) . "');</script>";
        }
    } else {
        echo "<script>alert('All fields are required!');</script>";
    }
}

include('partials/footer.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .profile-card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            margin: 50px auto;
            transition: transform 0.3s ease-in-out;
        }

        .profile-pic-container {
            position: relative;
            display: inline-block;
        }

        .profile-card img.profile-pic {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
            transition: all 0.3s ease-in-out;
            margin-bottom: 20px;
        }

        .profile-card h2 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #333;
        }

        .profile-card p {
            font-size: 18px;
            color: #666;
            margin: 5px 0;
        }

        .profile-pic-container .pencil-icon {
            position: absolute;
            bottom: 0;
            right: 10px;
            background-color: #007bff;
            color: white;
            border-radius: 50%;
            padding: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .profile-pic-container .pencil-icon:hover {
            background-color: #0056b3;
        }

        input[type="file"] {
            display: none;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            opacity: 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease-in-out, opacity 0.5s ease-in-out;
        }

        form.show {
            opacity: 1;
            max-height: 500px;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .buttons-container {
    display: flex;
    justify-content: center; /* Center the Edit Profile button horizontally */
    margin: 20px auto; /* Adjust the margin to control spacing around the button */
    width: 100%; /* Ensure it takes up full width */
}

.edit-button {
    background-color: #28a745;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
    margin: 0 auto; /* Center the button */
}

.edit-button:hover {
    background-color: #218838;
}

.pencil-icon {
    display: none; /* Hide the pencil icon by default */
}


        

        #profilePreview {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
            margin: 20px auto;
        }
    </style>
    <title>Edit Profile Page</title>
</head>

<body>
    
    <main class="main" id="top">
        <div class="container">
            <div class="profile-card">
                <div class="profile-pic-container">
                    <img id="profilePreview" src="<?php echo file_exists($profile_pic) ? $profile_pic . '?' . time() : 'assets/image/john_pic.jpg'; ?>" alt="Profile Picture" class="profile-pic">

                    <label for="profilePicInput" class="pencil-icon">🖉</label>
                    <input type="file" name="profile_pic" id="profilePicInput" accept="image/*">
                </div>

                <h2><?php echo htmlspecialchars($username); ?></h2>
                <p>Email: <?php echo htmlspecialchars($email); ?></p>
                <p>Contact: <?php echo htmlspecialchars($contact); ?></p>

                <!-- Home and Edit Profile buttons -->
<div class="buttons-container">
    <button class="edit-button" id="editProfileBtn">Edit Profile</button>
</div>


                

                <!-- Edit form (hidden by default) -->
                <form method="POST" action="" enctype="multipart/form-data" id="editProfileForm">
                    <input placeholder="Email" type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                    <input placeholder="Contact" id="contactInput" maxlength="12" name="contact" value="<?php echo htmlspecialchars($contact); ?>" pattern="\d*" title="Please enter numbers only" required>

                    <input type="file" name="profile_pic" id="profilePicInputForm" accept="image/*">
                    <input type="submit" name="update_profile" value="Update Profile">
                </form>
            </div>

            <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-profile shadow border" aria-labelledby="navbarDropdownUser">
                <div class="card position-relative border-0">
                  <div class="card-body p-0">
                    <div class="text-center pt-4 pb-3">
                      <div class="avatar avatar-xl ">
                        <img class="rounded-circle " src="<?php echo $admin_pic ; ?>" alt="" />
                      </div>
                      <h6 class="mt-2 text-body-emphasis"><?php echo $admin_name; ?></h6>
                    </div>
                    <div class="mb-3 mx-3"><input class="form-control form-control-sm" id="statusUpdateInput" type="text" placeholder="Update your status" /></div>
                  </div>
                  <div class="overflow-auto scrollbar" style="height: 7.8rem;">
                    <ul class="nav d-flex flex-column mb-2 pb-1">
                      <li class="nav-item"><a class="nav-link px-3 d-block" href="index.php?profile"> <span class="me-2 text-body align-bottom" data-feather="user"></span><span> Profile</span></a></li>
                      <li class="nav-item"><a class="nav-link px-3 d-block" href="index.php?security&privacy"> <span class="me-2 text-body align-bottom" data-feather="user"></span><span> privacy&security</span></a></li>
                      <li class="nav-item"><a class="nav-link px-3 d-block" href="#!"><span class="me-2 text-body align-bottom" data-feather="pie-chart"></span>Dashboard</a></li>
                      
                      
                      <li class="nav-item"><a class="nav-link px-3 d-block" href="index.php?helpcenter"> <span class="me-2 text-body align-bottom" data-feather="help-circle"></span>Help Center</a></li>
                      
                    </ul>
                  </div>
    
                    <hr />
                    <div class="px-3"> <a class="btn btn-phoenix-secondary d-flex flex-center w-100" href="logout.php"> <span class="me-2" data-feather="log-out"> </span>Sign out</a></div>
                    <div class="my-2 text-center fw-bold fs-10 text-body-quaternary"><a class="text-body-quaternary me-1" href="#!">Privacy policy</a>&bull;<a class="text-body-quaternary mx-1" href="#!">Terms</a>&bull;<a class="text-body-quaternary ms-1" href="#!">Cookies</a></div>
                  </div>
                </div>
        </div>
    </main>

    <script>
        // Select elements
        const editProfileBtn = document.getElementById('editProfileBtn');
const editProfileForm = document.getElementById('editProfileForm');
const profilePicInput = document.getElementById('profilePicInput');
const profilePicInputForm = document.getElementById('profilePicInputForm');
const profilePreview = document.getElementById('profilePreview');
const pencilIcon = document.querySelector('.pencil-icon'); // Select the pencil icon
const contactInput = document.getElementById('contactInput');

// Prevent any non-numeric input in the contact field
contactInput.addEventListener('input', (e) => {
    e.target.value = e.target.value.replace(/\D/, ''); // Replace any non-digit character with an empty string
});

// Toggle form and pencil icon visibility on button click
editProfileBtn.addEventListener('click', () => {
    editProfileForm.classList.toggle('show');
    pencilIcon.style.display = pencilIcon.style.display === 'none' || pencilIcon.style.display === '' ? 'block' : 'none'; // Show/hide the pencil icon
});

// Update profile preview when a new image is selected
profilePicInputForm.addEventListener('change', () => {
    const file = profilePicInputForm.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            profilePreview.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});

// Trigger file input when pencil icon is clicked
profilePicInput.addEventListener('click', (e) => {
    e.preventDefault(); // Prevents default behavior of the input
    profilePicInputForm.click();
});

        // Prevent the dialog from opening again on form click
        profilePicInputForm.addEventListener('focus', (e) => {
            e.preventDefault();
            profilePicInputForm.blur(); // This will prevent the file dialog from reopening
        });

    </script>
</body>
</html>
