<?php
require_once __DIR__ . '/../config/bootstrap.php';
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="vandreams.fr : le site de petites annonces DE TRIPPERS à TRIPPERS. Consultez des milliers d'annonces van aménagé  >>>">
    <title><?=$page_title?> | Van Dreams </title>
    <link rel="icon" href="assets/img/logo_1.png">
    <!--Ion Icons-->
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Aldrich&display=swap" rel="stylesheet">
    <!--Our own stylesheet-->
    <link rel="stylesheet" href="assets/css/style.css">
    
</head>
<body>
<header>
    <div class=container>
        <nav>
            <div class="nav-brand">
        <a href="index.php">
            <img src="assets/img/logo_1.png" alt="">
        </a>
    </div>

    <div class="menu-icons open" >
        <i class="icon ion-md-menu"></i>
    </div>

    <ul class="nav-list">
        <div class="menu-icons close">
            <i class="icon ion-md-close"></i>
        </div>
        <li class="nav-item">
            <a href="Home" class="nav-link current">Home</a>
        </li>
        <li class="nav-item">
            <a href="Home" class="nav-link">Pricing</a>
        </li>
        <li class="nav-item">
            <a href="views.php" class="nav-link">vue</a>
        </li>
        <?php if(getMembre() === null):?>
        <li class="nav-item">
            <a href="register.php" class="nav-link">Inscription</a>
        </li>
        <li class="nav-item">
            <a href="login.php" class="nav-link">Login</a>
        </li>
        <?php else :?>
        <li class="nav-item">
            <a href="user/profil.php" class="nav-link">Profil</a>
        </li>
        <li class="nav-item">
            <a href="admin/index_admin.php" class="nav-link">Back-office</a>
        </li>
        <li class="nav-item">
            <a href="logout.php" class="nav-link">Déconnexion</a>
        </li>
        <?php endif;?>
    </ul>
</nav>
</div>
</header>

<main>