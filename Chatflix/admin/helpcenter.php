<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Contacts</title>
    <style>
        /* Unique class for body wrapper */
        .custom-body-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* 100% height of the viewport */
            margin: 0;
            background-color: #f0f2f5; /* Light background */
        }

        /* Animation: fade-in with upward movement */
        @keyframes fadeInUpUnique {
            0% {
                opacity: 0;
                transform: translateY(30px); /* Start below */
            }
            100% {
                opacity: 1;
                transform: translateY(0); /* End at original position */
            }
        }

        /* Unique box class */
        .custom-box-unique {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background-color: #fff;
            border: 2px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;  /* Max width for larger screens */
            width: 100%;       /* Make it responsive */
            opacity: 0;        /* Start hidden */
            animation: fadeInUpUnique 1s ease forwards; /* Animation for fade-in */
        }

        /* Unique heading */
        .custom-heading-unique {
            font-size: 1.8rem;
            margin-bottom: 15px;
            text-align: center;
        }

        /* Unique list styling */
        .custom-list-unique {
            list-style: none;
            padding: 0;
            margin: 0;  /* Remove default list margin */
            text-align: center;  /* Center-align the list */
        }

        .custom-list-unique li {
            margin: 10px 0;
        }

        .custom-list-unique li a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        .custom-list-unique li a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        /* Responsive styles for smaller screens */
        @media (max-width: 600px) {
            .custom-box-unique {
                padding: 15px;  /* Adjust padding for smaller screens */
                max-width: 90%;  /* Ensure the box is almost full width on small screens */
            }

            .custom-heading-unique {
                font-size: 1.5rem;  /* Adjust heading size for small screens */
            }

            .custom-list-unique li {
                margin: 5px 0;  /* Adjust spacing for smaller screens */
            }
        }
    </style>
</head>
<body>
    <!-- Wrapper to isolate custom styling -->
    <div class="custom-body-wrapper">
        <div class="custom-box-unique">
            <h2 class="custom-heading-unique">Contact Us</h2>
            <ul class="custom-list-unique">
                <li><a href="mailto:Vishrutipareshavl@loyalistcollege.com">Vishrutipareshavl@loyalistcollege.com</a></li>
                <li><a href="mailto:Avneetkaur19@loyalistcollege.com">Avneetkaur19@loyalistcollege.com</a></li>
                <li><a href="mailto:Lakshayanand@loyalistcollege.com">Lakshayanand@loyalistcollege.com</a></li>
                <li><a href="mailto:Shashankreddyrach@loyalistcollege.com">Shashankreddyrach@loyalistcollege.com</a></li>
                <li><a href="mailto:Vivek.sharma3@loyalistcollege.com">Vivek.sharma3@loyalistcollege.com</a></li>
                <li><a href="mailto:Venkatasainadella@loyalistcollege.com">Venkatasainadella@loyalistcollege.com</a></li>
                <li><a href="mailto:Dhruvkamleshkumar@loyalistcollege.com">Dhruvkamleshkumar@loyalistcollege.com</a></li>
                <li><a href="mailto:Samilsalimbhaimit@loyalistcollege.com">Samilsalimbhaimit@loyalistcollege.com</a></li>
            </ul>
        </div>
    </div>

    <!-- Keeping the script but using unique classes for the existing sidebar and navigation -->
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
    
</body>
</html>

<?php
 include 'partials/connect.php';
 include 'partials/topnav.php';
 include 'partials/sidebar.php';
 include 'partials/head.php';
 include 'partials/footer.php';
 include 'partials/additional.php';
?>
