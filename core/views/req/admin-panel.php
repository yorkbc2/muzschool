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
	<div id="tabs">
		<div class="container-fluit">
			<div class="row">
				<div class='col-md-4 admin-nav'>
					<ul>
						<li><a href="#welcome">Вступ</a></li>
						<li><a href="#page">Додати сторінку</a></li>
					</ul>
				</div>
				<div class='col-md-8 admin-content'>
					<div id="welcome">
						<?php require "admin_comps/welcome.php" ?>
					</div>
					<div id="page">
						Додати сторінку
					</div>
				</div>
			</div>
		</div>
	
	</div>


</div>

<script>
	$("#tabs").tabs()
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

	#tabs {
		width: 100%;
		padding: 0;
		margin: 0;
	}

	#tabs ul {
		margin: 0;
		padding: 0;
		width: 100%;
	}
	#tabs .admin-nav ul li.ui-state-default {
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

	#tabs .admin-nav ul li a {
		color: #fff;
		outline: none;
	}

	#tabs .admin-nav ul li.ui-state-active {
		background: linear-gradient(#36cf70, green);
	}


	.admin-content a{
		color: royalblue;
	}

	.admin-content ul li a{
		color: royalblue;
	}
</style>