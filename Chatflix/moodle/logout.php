<?php

	session_start();

	include("partials/connect.php");

	session_destroy();

	echo "<script>window.open('index.php','_self')</script>";

?>