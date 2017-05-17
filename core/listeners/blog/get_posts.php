<?php 

	require "../../ms.blog.php";

	$posts = $blog->get_posts();

	$returned = array(
		"posts" => $posts,
		"length" => $blog->posts_l
	);

	echo json_encode($returned, true);

 ?>