<?php 

	require "../../../ms.pages.php";

	$name = $_POST['name'];
	$link = $_POST['link'];


	$info = array(
		"name" => $name,
		"link" => $link
	);

	$ms_pages->add_category($info);



?>