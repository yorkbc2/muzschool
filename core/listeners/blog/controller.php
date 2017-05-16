<?php 

	require "../../ms.blog.php";

	$posts = $blog->get_posts();

	echo json_encode($posts, true);

?>