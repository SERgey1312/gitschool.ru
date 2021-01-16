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
<!--wrapper-->
<div class="wrapper">
    <!--header-->
    <header class="header animate__animated animate__fadeInDown wow">
        <!---->
        <a href="/" class="header-logo">
            <img src="<?php echo get_template_directory_uri() . '/assets/img/logo.svg' ?>" alt="logo">
        </a>
        <!---->

        <nav class="header-menu">
            <ul class="header-menu_list">
                <li><a href="#about">Про обучение</a></li>
                <li><a href="#program">Программа</a></li>
                <li><a href="#mentor">Менторы</a></li>
                <li><a href="#price">Цена</a></li>
                <li><a href="#payment">Оплата</a></li>
                <li><a href="#faq">FAQ</a></li>
            </ul>
        </nav>
        <!---->
        <div class="header-burger">
            <span></span>
            <span></span>
        </div>
        <!---->
    </header>