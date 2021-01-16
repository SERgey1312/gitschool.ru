<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Онлайн-школа программирования</title>
	<link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri() . '/assets/img/favicon/favicon-32x32.png' ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri() . '/assets/img/favicon/favicon-16x16.png' ?>">
	<link rel="manifest" href="<?php echo get_template_directory_uri() . '/assets/img/favicon/site.webmanifest' ?>">
	<link rel="mask-icon" href="<?php echo get_template_directory_uri() . '/assets/img/favicon/safari-pinned-tab.svg' ?>" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">

	<?php wp_head(); ?>
</head>

<body>
<div class="wrapper">
	<header class="header animate__animated animate__fadeInDown wow">
		<!---->
		<a href="/" class="header-logo">
			<img src="<?php echo get_template_directory_uri() . '/assets/img/logo.svg' ?>" alt="logo">
		</a>
		<!---->

		<nav class="header-menu">
			<ul class="header-menu_list">
				<li><a href="<?php echo get_site_url(); ?>">На главную</a></li>
			</ul>
		</nav>
		<!---->
		<div class="header-burger">
			<span></span>
			<span></span>
		</div>
		<!---->
	</header>
	<main>
		<div style="display: flex; align-items: center; text-align: center; justify-content: center; height: 40em; flex-direction: column;">
			<p style="font-size: 50px">404</p>
			<p style="font-size: 35px; margin-top: 20px">Page not found!</p>

		</div>
	</main>
</div>

<?php
wp_footer(); ?>
</body>
</html>
