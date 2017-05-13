<?php
	
	session_start();
	@ob_start();

	require "core/ms.php";



?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php $ms->get_title(); ?></title>

	<script src='public/bower_components/jquery/dist/jquery.min.js'></script>
	<script src='public/bower_components/bootstrap/dist/js/bootstrap.min.js'></script>

	<link rel="stylesheet" href="public/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/bower_components/font-awesome/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="public/bower_components/jquery-ui/themes/base/jquery-ui.min.css">

	<link rel="stylesheet" href="public/css/style.css">

	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

	<script src='public/bower_components/vue/dist/vue.min.js'></script>

	<script src='public/bower_components/vue-resource/dist/vue-resource.min.js'></script>
</head>
<body>

	<script src="public/MS.js"></script>
	<script src="public/bower_components/jquery-ui/jquery-ui.min.js"></script>
	<script src="public/ckeditor/ckeditor.js"></script>
 
	<section id="main">
		<?php $router->create(); ?>
	</section>

	
	
	

	<?php $ms->close(); ?>




	
</body>
</html>