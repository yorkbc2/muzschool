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

	<script src='<?php $ms->echo_host();?>/public/bower_components/jquery/dist/jquery.min.js'></script>
	<script src='public/bower_components/bootstrap/dist/js/bootstrap.min.js'></script>

	<link rel="stylesheet" href="<?php $ms->echo_host();?>/public/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php $ms->echo_host();?>/public/bower_components/font-awesome/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="<?php $ms->echo_host();?>/public/bower_components/jquery-ui/themes/base/jquery-ui.min.css">

	<link rel="stylesheet" href="<?php $ms->echo_host();?>/public/css/style.css">

	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

	<script src='<?php $ms->echo_host();?>/public/bower_components/vue/dist/vue.min.js'></script>

	<script src='<?php $ms->echo_host();?>/public/bower_components/vue-resource/dist/vue-resource.min.js'></script>
	
	<link rel="stylesheet" href="<?php $ms->echo_host();?>/public/bower_components/froala-wysiwyg-editor/css/froala_editor.min.css">
	<link rel="stylesheet" href="<?php $ms->echo_host();?>/public/bower_components/froala-wysiwyg-editor/css/froala_style.min.css">

	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">

</head>
<body>

	<script src="<?php $ms->echo_host();?>/public/MS.js"></script>
	<script src="<?php $ms->echo_host();?>/public/bower_components/jquery-ui/jquery-ui.min.js"></script>
	<script src="<?php $ms->echo_host();?>/public/bower_components/froala-wysiwyg-editor/js/froala_editor.pkgd.min.js"></script>

 
	<div class="__wrapper">
		<section id="main">
			<div id="_required_template">
				<div class="container-fluit">
					<div class="row">
						<div class="col-md-4">
							<div class='__quotes'>
								<q><?php $ms->quotes(); ?></q>
							</div>
						</div>
						<div class="col-md-8">
							<header class="__header" id="__header">
								<h1><img src="public/images/music_key.png" alt="Music School Key"><?php $ms->title(); ?></h1>
							</header>
						</div>
					</div>
				</div>
				<nav class="__nav" id="_nav">
					<ul class="__ul">
						<li><a href="<?php $ms->get_basepath() ?>/">Головна</a></li>
						<?php $ms_pages->echo_pages($ms_pages->get_pages(), $ms->ms_basepath); ?>
						<?php if($ms->admin_check()) {
							?>
						<li>
							<a  href='<?php $ms->get_basepath(); ?>/admin-panel'>адмін-панель</a>
						</li>
							<?php
						}
							?>
					</ul>
				</nav>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<?php $router->create(); ?>
					</div>
					<div class="col-md-4"></div>
				</div>
			</div>
		</section>
	</div>




	
	

	<?php $ms->close(); ?>




	
</body>
</html>