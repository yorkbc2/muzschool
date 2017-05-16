<?php 

	require "../../ms.blog.php";


	$cats = $blog->get_categories();

	echo json_encode($cats, true);


 ?>