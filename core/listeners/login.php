<?php 

	session_start();

	require "../ms.php";

	$l = $_POST['login'];
	$p = $_POST['password'];

	$ms = new MS();

	$ms->connect();


	//-------------


	$sec = $ms->login_in($l, $p);

	echo $sec;


	#---------------

	$ms->close();

	
 ?>