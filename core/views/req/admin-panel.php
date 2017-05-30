<div id="admin">
	<nav id="admin-nav">
		<ul>
			<li><a href="<?php $ms->get_basepath();?>/">Головна сторінка</a></li>
			<li><a href="<?php $ms->get_basepath(); ?>/logout">Вийти з Адмін-Панелі</a></li>
		</ul>
	</nav>
	<h2>
		Панель Адміністратора.
	</h2>
	<hr>
	<div id="main-tabs">
		<div class="container-fluit">
			<div class="row">
				<div class='col-md-4 admin-nav'>
					<ul>
						<li><a href="#welcome">Вступ</a></li>
						<li><a href="#page">Керування сторінками</a></li>
						<li><a href="#web-info">Керування інформацією</a></li>
						<li><a href="#blog">Керування блогом</a></li>
					</ul>
				</div>
				<div class='col-md-8 admin-content'>
					<div id="welcome">
						<?php require "admin_comps/welcome.php" ?>
					</div>
					<div id="page">
						<?php require "admin_comps/add_page.php" ?>
					</div>
					<div id="web-info">
						<?php require "admin_comps/web_info.php" ?>
					</div>
					<div id="blog">
						<?php require "admin_comps/blog.module.php" ?>
					</div>
				</div>
			</div>
		</div>
	
	</div>


</div>


<!-- Main Admin-Panel Script -->
<script>
	$(function () {
		let hs = "<?php $ms->echo_host() ?>"

		let ckOptions = {
			filebrowserBrowseUrl : hs + "/public/ckeditor/kcfinder/browse.php?opener=ckeditor&type=files",
			filebrowserImageBrowseUrl: hs + "/public/ckeditor/kcfinder/browse.php?opener=ckeditor&type=images",
			filebrowserFlashBrowseUrl: hs + "/public/ckeditor/kcfinder/browse.php?opener=ckeditor&type=flash",
			filebrowserUploadUrl: hs + "/public/ckeditor/kcfinder/browse.php?opener=ckeditor&type=files",
			filebrowserImageUploadUrl: hs + "/public/ckeditor/kcfinder/browse.php?opener=ckeditor&type=images",
			filebrowserFlashUploadUrl: hs + "/public/ckeditor/kcfinder/browse.php?opener=ckeditor&type=flash"

		}

		CKEDITOR.replace("fullDescription", ckOptions)
		CKEDITOR.replace("addNewPage", ckOptions)
		CKEDITOR.replace("addNewPost", ckOptions)

		$("#_required_template").hide()
		$("#main-tabs").tabs()
	})
</script>

<style>

	nav#admin-nav {
		position: relative;
		width: 100%;
		margin: 0 0 10px 0;
		padding: 5px;
		background-color: #36cf70;
	}

	nav#admin-nav ul {
		margin: 0;
		padding: 0;
	}

	nav#admin-nav ul li {
		padding: 10px 15px;
		margin: 0;
		display: inline-block;
		list-style: none;
	}

	nav#admin-nav ul li a {
		color: #fff;
		font-size: 1.2em;
	}

	#main-tabs {
		width: 100%;
		padding: 0;
		margin: 0;
	}

	#main-tabs ul {
		margin: 0;
		padding: 0;
		width: 100%;
	}
	#main-tabs .admin-nav ul li.ui-state-default {
		display: block;
		width: 100%;
		background-color: #36cf70;
		color: #fff;
		border: 1px solid #2a9151;
		border-radius: 0;
		padding: 2px 4px;
		font-size: 1.2em;
		font-family: "Roboto", sans-serif;
	}

	#main-tabs .admin-nav ul li a {
		color: #fff;
		outline: none;
	}

	#main-tabs .admin-nav ul li.ui-state-active {
		background: linear-gradient(#36cf70, green);
	}


	.admin-content a{
		color: royalblue;
	}

	.admin-content ul li a{
		color: royalblue;
	}

	.dx-modal {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-color: rgba(0,0,0,0.4);

		overflow-x: hidden;
		z-index: 134;
	}

	.dx-modal .dx-block {
		position: relative;
		margin: 5% auto;
		width: 720px;
		overflow: auto;
		padding: 25px;

		background-color: #fff;

		min-height: 200px;

		border: 1px solid #e7e7e7;
		border-radius: 5px;
		z-index: 137;
		text-align: left;
	}
	.dx-modal .dx-block input[type='radio'] {
		width: 12px;
		height: 12px;
	}

	.dx-modal .dx-close,
	.dx-modal .dx-block .dx-close {
		position: absolute;
		top: 24px;
		right: 24px;
		color : #000;

		font-size: 3em;
		border: 0;
		background-color: transparent;

		outline: none;
	}
	.dx-modal .dx-block .dx-close {
		top: 0;
		right: 0;
	}
</style>