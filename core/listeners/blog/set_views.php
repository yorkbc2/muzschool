<?php 

	require "../../ms.blog.php";

	$post = $blog->inc_view($_POST['id']);

	echo true;
 ?>