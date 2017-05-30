<?php
	
	session_start();
	@ob_start();

	require "core/ms.blog.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php $ms->title(); ?></title>

	<meta name="description" content="Музична школи м.Бердичева запрошує всіх на навчання. Навчіться грі на музичних інструментах">

	<meta name='keywords' content="музична,школа,музична школа,музика,бердичів,учні,бердичівська,бердичівська музична школа,бердичівська музична,бердичівська школа,музичні інструменти">

	<script src='<?php $ms->echo_host();?>/public/bower_components/jquery/dist/jquery.min.js'></script>
	<script src='public/bower_components/bootstrap/dist/js/bootstrap.min.js'></script>

	<link rel="stylesheet" href="<?php $ms->echo_host();?>/public/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php $ms->echo_host();?>/public/bower_components/font-awesome/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="<?php $ms->echo_host();?>/public/bower_components/jquery-ui/themes/base/jquery-ui.min.css">

	<link href="https://fonts.googleapis.com/css?family=Roboto|Comfortaa" rel="stylesheet">

	<script src='<?php $ms->echo_host();?>/public/bower_components/vue/dist/vue.min.js'></script>

	<script src='<?php $ms->echo_host();?>/public/bower_components/vue-resource/dist/vue-resource.min.js'></script>
	
	<link rel="stylesheet" href="<?php $ms->echo_host();?>/public/bower_components/froala-wysiwyg-editor/css/froala_editor.min.css">
	<link rel="stylesheet" href="<?php $ms->echo_host();?>/public/bower_components/froala-wysiwyg-editor/css/froala_style.min.css">

	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/vuejs-paginator/2.0.1/vuejs-paginator.min.js"></script>

	<link rel="stylesheet" href="<?php $ms->echo_host();?>/public/css/style.css">
	<link rel="stylesheet" href="<?php $ms->echo_host()?>/public/css/parts.css">

	<link rel="icon" type="image/png" href="<?php $ms->echo_host() ?>/image.png" />

</head>
<body>

	<script src="<?php $ms->echo_host();?>/public/MS.js"></script>
	<script src="<?php $ms->echo_host();?>/public/bower_components/jquery-ui/jquery-ui.min.js"></script>
	<script src="<?php $ms->echo_host();?>/public/bower_components/froala-wysiwyg-editor/js/froala_editor.pkgd.min.js"></script>

	<script src="<?php $ms->echo_host();?>/public/ckeditor/ckeditor.js"></script>

	<div class="MainContainer">
		<div class="__wrapper">
			<section id="main">
				<div id="_required_template">
					<div class="_welcome_bg" style="background-position: center ;background-image: url('<?php $ms->echo_host() ?>/public/images/header_bg.jpg')">
						<div class="_welcome_filter">
							<div class="container-fluit">
								<div class="row">
									</div>
									<div class="col-md-12">
										<header class="__header" id="__header">
											<h1><img src="<?php $ms->echo_host();?>/public/images/music_key.png" alt="Music School Key"><?php $ms->title(); ?></h1>
											<div class="req_quote">
												Музика не має вітчизни,
												<br>
												вітчизна її - весь всесвіт.
												<span class="_author">
													- Ф. Шопен <a href="https://www.google.com.ua/url?sa=t&rct=j&q=&esrc=s&source=web&cd=1&cad=rja&uact=8&ved=0ahUKEwjFrcepoPrTAhUJiywKHTE0BOIQFgglMAA&url=https%3A%2F%2Fuk.wikipedia.org%2Fwiki%2F%25D0%25A4%25D1%2580%25D0%25B8%25D0%25B4%25D0%25B5%25D1%2580%25D0%25B8%25D0%25BA_%25D0%25A8%25D0%25BE%25D0%25BF%25D0%25B5%25D0%25BD&usg=AFQjCNGQ97sHdYfZmweDZhO7qIc8BJ4WUg&sig2=SPIrj5Nkpm0P1M4AbPYYHA" target="_blank">
														<img src="<?php $ms->echo_host() ?>/public/images/author.jpg" alt="">
													</a>
												</span>
											</div>
											<h2>
												<?php $ms->description() ?>
											</h2>
										</header>
									</div>
								</div>
							</div>
						</div>
					</div>
					<nav class="__nav" id="_nav">
						<ul class="__ul">
							<li><a href="<?php $ms->get_basepath() ?>/">Головна</a></li>
							<li><a href="<?php $ms->get_basepath() ?>/blog">Наш блог</a></li>
							<?php 

								$pages = $ms_pages->get_pages();
								$cats = $ms_pages->get_categories();

								$li_pages = array();
								$null_pages = array();

								for($i = 0 ; $i < sizeof($cats) ; $i++) {

									$li_array = array(
										"name" => "",
										"pages" => array()
									);

									for($j = 0; $j < sizeof($pages) ; $j++) {

										if($cats[$i]['link'] == $pages[$j]['category']) {

											array_push($li_array['pages'], $pages[$j]);

										}

									}

									$li_array['name'] = $cats[$i]['name'];

									array_push($li_pages, $li_array);

								}

								for($i = 0 ; $i < sizeof($li_pages) ; $i++) {

									if(sizeof($li_pages[$i]['pages']) > 0) {

										$ul_start = "<li class='_drop_li'>".$li_pages[$i]['name']."<ul class='_drop_menu'>";
										$lis = "";
										for ($j=0; $j < sizeof($li_pages[$i]['pages']) ; $j++) { 
												
											$lis .= "<li>
												<a href='".$ms->ms_basepath."/".$li_pages[$i]['pages'][$j]['link']."'>
													".$li_pages[$i]['pages'][$j]['name']."
												</a>
											</li>";


										}

										$ul_end = $ul_start.$lis."</ul>";

										echo $ul_end;

									}
									else {
										continue;
									}

								}

								for ($i=0; $i < sizeof($pages); $i++) { 
									if($pages[$i]['category'] == "" || sizeof($pages[$i]['category']) < 1) {
										array_push($null_pages, $pages[$i]);
									}
								}

								for ($i=0; $i < sizeof($null_pages); $i++) { 
									echo "<li><a href='".$ms->ms_basepath."/".$null_pages[$i]['link']."'>
										".$null_pages[$i]['name']."
									</a></li>";
								}

							?>
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
						<div class="col-md-9">
							<?php $router->create(); ?>
						</div>
						<div class="col-md-3 _aside_col">
							<div class="_aside_header">
								Музична школа
							</div>
							<div class="_time">
								<span id="current-time"></span>
								<span id="current-date"></span>
							</div>
							<div class="_aside_quotes">
								<h4>Цитата дня</h4>
								<q><?php $ms->quotes() ?></q>
							</div>
							<div class="__populars">
							<h2>Найпопулярніші новини!</h2>
								<ol>
									<?php $blog->echo_popular($ms->ms_basepath); ?>
								</ol>
							</div>
						</div>
					</div>
				</div>
			</section>
			<footer class='_footer'  style="background-position: center ;background-image: url('<?php $ms->echo_host() ?>/public/images/header_bg.jpg')">
				<div class="_filter">
					Всі права захищені. Бердичівська Музична Школа. 
					<p>
						<span id="cy"></span>
					</p>
				</div>
			</footer>
		</div>
	</div>
	



	<script>
		$(document).ready(() => {

			function tick() {
				let d = {
					h: new Date().getHours(),
					m: new Date().getMinutes(),
					s: new Date().getSeconds()
				}

				let pint = el => parseInt(el);

				d.h = pint(d.h) >= 10 ? d.h : "0" + d.h;
				d.m = pint(d.m) >= 10 ? d.m : "0" + d.m;
				d.s = pint(d.s) >= 10 ? d.s : "0" + d.s;

				return `${d.h}:${d.m}:${d.s}`;
			}
			function getDate() {
				let d = {
					d: new Date().getDate(),
					m: new Date().getMonth(),
					y: new Date().getFullYear()
				}

				let pint = el => parseInt(el);

				d.d = pint(d.d) >= 10 ? d.d : "0" + d.d;
				d.m = pint(d.m) >= 10 ? d.m : "0" + d.m;

				return `${d.d}/${d.m}/${d.y}`;
			}

			$("#current-time").html(tick())
			$("#current-date").html(getDate())

			setInterval(function () {
				$("#current-time").html(tick())
				$("#current-date").html(getDate())
			}, 1000)

			$("#cy").html(new Date().getFullYear())



		})
	</script>
	
	

	<?php $ms->close(); ?>




	
</body>
</html>