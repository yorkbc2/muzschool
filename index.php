<?php
	
	session_start();
	@ob_start();

	require "core/ms.pages.php";



?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php $ms->title(); ?></title>

	<script src='public/bower_components/jquery/dist/jquery.min.js'></script>
	<script src='public/bower_components/bootstrap/dist/js/bootstrap.min.js'></script>

	<link rel="stylesheet" href="public/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/bower_components/font-awesome/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="public/bower_components/jquery-ui/themes/base/jquery-ui.min.css">

	<link rel="stylesheet" href="public/css/style.css">

	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

	<script src='public/bower_components/vue/dist/vue.min.js'></script>

	<script src='public/bower_components/vue-resource/dist/vue-resource.min.js'></script>
	
	<link rel="stylesheet" href="public/bower_components/froala-wysiwyg-editor/css/froala_editor.min.css">
	<link rel="stylesheet" href="public/bower_components/froala-wysiwyg-editor/css/froala_style.min.css">

</head>
<body>

	<script src="public/MS.js"></script>
	<script src="public/bower_components/jquery-ui/jquery-ui.min.js"></script>
	<script src="public/bower_components/froala-wysiwyg-editor/js/froala_editor.min.js"></script>
	<script src="public/bower_components/froala-wysiwyg-editor/js/plugins/align.min.js"></script>

 
	<section id="main">
		<nav class="__nav">
			<ul class="__ul">
				<?php $ms_pages->echo_pages($ms_pages->get_pages(), $ms->ms_basepath); ?>
			</ul>
		</nav>
		<?php $router->create(); ?>
	</section>




	
	

	<?php $ms->close(); ?>




	
</body>
</html>