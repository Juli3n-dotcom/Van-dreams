<?php
require_once __DIR__ . '/../../../assets/config/bootstrap_admin.php';
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$page_title?> | Van Dreams </title>
    <link rel="icon" href="../assets/img/control-panel.png">
    <!--Ion Icons-->
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Aldrich&display=swap" rel="stylesheet">
    <!--Our own stylesheet-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/css/style.css">
    
</head>
<body>
<header class="container_header">
    <div class="container">
        <nav>
            <div class="nav-brand">
                <img src="../assets/img/control-panel.png" alt="">
        <a href="../index.php">
            Back-office
        </a>
    </div>

    <div class="menu-icons open" >
        <i class="icon ion-md-menu"></i>
    </div>

    <ul class="nav-list">
        <div class="menu-icons close_btn">
            <i class="icon ion-md-close"></i>
        </div>
        <li class="nav-item">
            <a href="Home" class="nav-link current">Home</a>
        </li>
        <li class="nav-item">
            <a href="Home" class="nav-link">Membres</a>
        </li>
        <li class="nav-item">
            <a href="logout.php" class="nav-link">Annonces</a>
        </li>
        <li class="nav-item">
            <a href="category.php" class="nav-link">Catégories</a>
        </li>
        <li class="nav-item">
            <a href="../logout.php" class="nav-link">Déconnexion</a>
        </li>
        
    </ul>
</nav>
</div>
</header>

<main>