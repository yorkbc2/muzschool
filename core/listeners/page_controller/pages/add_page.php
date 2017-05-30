<?php 

	$content = $_POST['content'];
	$name = $_POST['name'];
	$link = strtolower($_POST['link']);
	$is_category = $_POST['isCategory'];
	$category = $_POST['categoryName'];

	$query = "";

	if($is_category == true OR $is_category == 'true' OR $is_category == TRUE) {
		$query = "INSERT INTO `pagelist` (id, name, link, category) VALUES (NULL, '$name', '$link', '$category')";
	}
	else {
		$query = "INSERT INTO `pagelist` (id, name, link, category) VALUES (NULL, '$name', '$link', NULL)";
	}


	require "../../../ms.pages.php";

	$result_ = $ms_pages->insert_page($query, $name, $link);

	$result__ = $ms_pages->create_page($content, $link, $name);

	echo $is_category;



?>