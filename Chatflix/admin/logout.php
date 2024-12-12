<?php

	session_start();

	include("partials/connect.php");

	// Destroy the session on the server
	session_unset();
	session_destroy();


	// Redirect to login page
	echo "<script>
		alert('You have successfully logged out.');
		window.open('login.php', '_self'); // Redirect to login page
	</script>";
?>