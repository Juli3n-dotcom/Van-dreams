<?php
if (session_status() === PHP_SESSION_NONE){
    session_start();
  }
  $Membre = getMembre($pdo, $_GET['id_membre'] ?? null);


  $user = $Membre['id_membre'];
  $allNewconver = $pdo->query("SELECT *
                              FROM conversation
                              WHERE destinataire ='$user'
                              ORDER BY date_enregistrement DESC");
  
  $newmsg = $pdo->query("SELECT count(*) AS nb 
                          FROM conversation 
                          WHERE (destinataire = '$user') 
                          AND (est_lu_destinataire = 1)");
  $data =  $newmsg->fetch();
  $NewMessage = $data['nb'];

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
    <meta name="description" content="vandreams.fr : le site de petites annonces DE TRIPPERS à TRIPPERS. Consultez des milliers d'annonces van aménagé">
    <meta property="og:url"           content="https://http://vandreams.fr/" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Van Dreams" />
    <meta property="og:description"   content="vandreams.fr : le site de petites annonces DE TRIPPERS à TRIPPERS. Consultez des milliers d'annonces van aménagé" />
    <meta property="og:image"         content="assets/img/logo_1.png" />
    <meta name="description" content="vandreams.fr : le site de petites annonces DE TRIPPEURS à TRIPPEURS. Consultez des milliers d'annonces de van aménagé  >>>">
    <title><?=$page_title?> | Van Dreams </title>
    <link rel="icon" href="assets/img/logo3.png">
    <!--Ion Icons-->
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Aldrich&display=swap" rel="stylesheet">
    <!--Our own stylesheet-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <base href="/Vandreams/">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Js-->
    <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
    
</head>
<body>
<header class="header_index">
    <div class=container_header_index>
        <nav>
            <div class="nav-brand">
        <a href="welcome">
            <img src="assets/img/logo3.png" alt="">
        </a>
    </div>

    <div class="menu-icons_index open" >
        <i class="icon ion-md-menu"></i>
    </div>

    <ul class="nav-list">
        <div class="menu-icons close">
            <i class="icon ion-md-close"></i>
        </div>
        <li class="nav-item">
            <a href="welcome" class="nav-link link1">Accueil</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link link2">Les annonces</a>
        </li>
        <li class="nav-item">
            <a href="post" class="nav-link link3">Déposer une annonces</a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link dropdown-toggle link4" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i>
            </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <?php if(getMembre() === null):?>
            <a href="login" class="dropdown-item">Inscription</a>    
            <a href="login" class="dropdown-item">Connexion</a>
        <?php else :?>          
            <a class="dropdown-item"  href="user/mypost">Mon annonces</a>
            <a class="dropdown-item"  href="user/favori">Mes favoris</a>
            <a class="dropdown-item" href="user/messagerie_user.php">Messagerie <span class="notif_msg"><?= $NewMessage > 0 ? $NewMessage : '0';?></span></a>
            <a class="dropdown-item"  href="user/myaccount">Mon Profil</a>
                <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="logout">Déconnexion</a>
        </div>
        </li>
        <?php endif;?>
        <?php if(role(ROLE_ADMIN)):?>
        <li class="nav-item">
            <a href="admin/index_admin.php" class="nav-link link5">Back-office</a>
        </li>
        <?php endif;?>
    </ul>
</nav>
</div>
</header>

<main>