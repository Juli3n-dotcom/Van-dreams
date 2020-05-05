<?php
if (session_status() === PHP_SESSION_NONE){
    session_start();
  }
  require_once __DIR__ . '/../config/bootstrap.php';
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-164356474-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-164356474-1');
</script>

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Js-->
    <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
</head>
<body>
<header class="header">
    <div class=container_header>
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
            <a href="index.php" class="nav-link">Accueil</a>
        </li>
        <li class="nav-item">
            <a href="post.php" class="nav-link">Les annonces</a>
        </li>
        <li class="nav-item">
            <a href="post.php" class="nav-link">Déposer une annonces</a>
        </li>
        <li class="nav-item">
            <a href="admin/index_admin.php" class="nav-link">Back-office</a>
        </li>
        <li class="nav-item">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i>
            </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <?php if(getMembre() === null):?>
            <a href="login.php#register" class="dropdown-item">Inscription</a>    
            <a href="login.php" class="dropdown-item">Connexion</a>
        <?php else :?>          
          <a class="dropdown-item"  href="user/profil.php">Mon Profil</a>
          <a class="dropdown-item" href="#">Messagerie </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php">Déconnexion</a>
        </div>
        </li>
        <?php endif;?>
    </ul>
</nav>
</div>
</header>

<main>