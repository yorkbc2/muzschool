<?php 

	
	require "../../ms.blog.php";

	$req = $_POST['req'];

	if($req == "create_post") {
		$title = $_POST['title'];
		$content = $_POST['content'];

		$categ = $_POST['category'];
		$date = $_POST['date'];


		$result = $blog->add_post($title, $content, $categ, $date);

		echo $result;
	}
	else if ($req == 'create_category') {

		$name = $_POST['name'];

		$res = $blog->add_category($name);

		echo $res;

	}
	else if ($req == "remove_post") {
		$id = $_POST['id'];
		$res = $blog->remove_post($id);

		echo $res;
	}

 ?>