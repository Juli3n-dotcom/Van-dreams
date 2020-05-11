<?php
$Membre = getMembre($pdo, $_GET['id_membre'] ?? null);
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
    <meta name="description" content="vandreams.fr : le site de petites annonces DE TRIPPERS à TRIPPERS. Consultez des milliers d'annonces van aménagé">
    <meta property="og:url"           content="https://http://vandreams.fr/" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Van Dreams" />
    <meta property="og:description"   content="vandreams.fr : le site de petites annonces DE TRIPPERS à TRIPPERS. Consultez des milliers d'annonces van aménagé" />
    <meta property="og:image"         content="assets/img/logo_1.png" />
    <meta name="description" content="vandreams.fr : le site de petites annonces DE TRIPPEURS à TRIPPEURS. Consultez des milliers d'annonces de van aménagé  >>>">
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
    <base href="/Van%20dreams/">
    <link rel="stylesheet" href="/Van%20dreams/assets/css/style.css">
    <link rel="stylesheet" href="/Van%20dreams/user/assets/css/style.css">
    <!-- Js-->
    <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
    
</head>
<header class="header header_user">
    <div class=container_header>
        <nav>
            <div class="nav-brand">
        <a href="welcome">
            <img src="assets/img/logo_1.png" alt="">
        </a>
    </div>

    <div class="menu-icons_user open" >
        <i class="icon ion-md-menu"></i>
    </div>

    <ul class="nav-list_user">
        <div class="menu-icons_user close">
            <i class="icon ion-md-close"></i>
        </div>
        <div>
            
            <div class="img_profil"></div>
            <div class="profil_name">
                <h3><?= $Membre['prenom']?></h3>
            </div>
        </div>
        <li class="nav-item_user">
            <a href="#" class="nav-link_user">Mes annonces</a>
        </li>
        <li class="nav-item_user">
            <a href="#" class="nav-link_user">Mes Favoris</a>
        </li>
        <li class="nav-item_user">
            <a href="#" class="nav-link_user">Messagerie <span class="notif_msg">0</span></a>
        </li>
        <li class="nav-item_user">
            <a href="#" class="nav-link_user">Mes informations</a>
        </li>
        <li class="nav-item_user">
            <a href="/Van%20dreams/logout" class="nav-link_user">Déconnexion</a>
        </li>
    </ul>
</nav>
</div>
</header>

<main>