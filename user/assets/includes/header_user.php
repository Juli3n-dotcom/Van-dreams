<?php
$Membre = getMembre($pdo, $_GET['id_membre'] ?? null);

if ($Membre === null){
    ajouterFlash('success','Vous avez été déconnecté');
    session_write_close();
    header('location:welcome');
}
    


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
    <meta property="og:image"         content="/Vandreams/assets/img/logo3.png" />
    <meta name="description" content="vandreams.fr : le site de petites annonces DE TRIPPEURS à TRIPPEURS. Consultez des milliers d'annonces de van aménagé  >>>">
    <title><?=$page_title?> | Van Dreams </title>
    <link rel="icon" href="/Vandreams/assets/img/logo3.png">
    <!--Ion Icons-->
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Aldrich&display=swap" rel="stylesheet">
    <!--Our own stylesheet-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- <base href="/Vandreams/"> -->
    <link rel="stylesheet" href="/Vandreams/user/assets/css/style.css">
    <link rel="stylesheet" href="/Vandreams/assets/css/style.css">
    <!-- Js-->
    <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
    
</head>
<header class="header header_user">
    <div class=container_header>
        <nav>
            <div class="nav-brand">
        <a href="../welcome">
            <img src="/Vandreams/assets/img/logo3.png" alt="">
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
            <a href="mesannonces" class="nav-link_user">Mes annonces</a>
        </li>
        <li class="nav-item_user">
            <a href="favoris" class="nav-link_user">Mes Favoris</a>
        </li>
        <li class="nav-item_user">
            <a href="inbox" class="nav-link_user">Messagerie <span class="notif_msg_user"><?= $NewMessage > 0 ? $NewMessage : '0';?></span></a>
        </li>
        <li class="nav-item_user">
            <a href="myaccount" class="nav-link_user">Mes informations</a>
        </li>
        <li class="nav-item_user">
            <a href="/Vandreams/logout" class="nav-link_user">Déconnexion</a>
        </li>
    </ul>
</nav>
</div>
</header>

<main>