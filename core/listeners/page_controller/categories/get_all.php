<?php 

	require "../../../ms.pages.php";

	$cats = $ms_pages->get_categories();

	echo json_encode($cats);

 ?>