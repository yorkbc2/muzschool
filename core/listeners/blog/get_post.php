<?php 

	require "../../ms.blog.php";

	$post = $blog->get_post($_POST['id']);

	echo json_encode($post, true);

 ?>