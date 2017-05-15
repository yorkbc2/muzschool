<?php 

	$content = $_POST['content'];
	$name = $_POST['name'];
	$link = strtolower($_POST['link']);
	$is_category = $_POST['isCategory'];
	$category = strtolower($_POST['category']);

	$query = "";

	if($is_category == "false" OR $is_category == false) {
		$query = "INSERT INTO `pagelist` (id, name, link, category) VALUES (NULL, '$name', '$link', NULL)";
	}
	else {
		$query = "INSERT INTO `pagelist` (id, name, link, category) VALUES (NULL, '$name', '$link', '$category')";
	}


	require "../../../ms.pages.php";

	$result_ = $ms_pages->insert_page($query, $name, $link);

	$result__ = $ms_pages->create_page($content, $link, $name);

	echo json_encode($result_);



?>