<?php 

	session_start();

	require "../ms.php";

	$l = $_POST['login'];
	$p = $_POST['password'];

	$ms = new MS();

	$ms->connect();


	//-------------


	$res = $ms->login_in($l, $p);

	echo $res;


	#---------------

	$ms->close();

	
 ?>