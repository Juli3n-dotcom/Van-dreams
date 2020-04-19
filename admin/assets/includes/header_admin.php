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
    <link rel="stylesheet" href="assets/css/style_admin.css">
    
</head>
<body>
<header >
    <div class="container_header">
        <div class="nav-brand">
                <img src="../assets/img/control-panel.png" alt="">
                <a href="../index.php">Back-office</a>
        </div>
        <div class="admin_control">
            <div class="account" id="account">
                <img src="assets/img/avatar.jpg" alt="">
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="topmenu hide" id="topbar-menu">
                <a href=""><i class="ion-person"></i> Mes informations</a>
                <a href="../logout.php"><i class="ion-power"></i> Se deconnecter</a>
            </div>
        </div>
        
        
    
</div>
</header>

<div class="container-fluid">
    <div class="row">

    
<div class="nav col-md-2 d-none d-md-block  sidebar">
            <div class="menu">
                <a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </div>
            <div class="submenu" id="submenu">
                <a href="#"><i class="fas fa-user"></i> Utilisateurs <i class="fas fa-chevron-down right"></i></a>
                <div class="sub-content hide" id="sub-content">
                    <a href="#"> Ajouter un utilisateur</a>
                    <a href="#"> Statistiques</a>
                </div>
            </div>
            <div class="submenu" id="submenu">
                <a href="#"><i class="far fa-envelope"></i> Messages <i class="fas fa-chevron-down right"></i></a>
                <div class="sub-content hide" id="sub-content">
                    <a href="#"> Nouveau message</a>
                    <a href="#"> Messages reçus</a>
                    <a href="#"> Messages envoyés</a>
                </div>
            </div>
            <div class="submenu" id="submenu">
                <a href="#"><i class="fas fa-cubes"></i> Catégories <i class="fas fa-chevron-down right"></i></a>
                <div class="sub-content hide" id="sub-content">
                    <a href="category.php"> Les catégories</a>
                    <a href="category.php#add_cat"> Ajouter une catégorie</a>
                </div>
            </div>
            <div class="submenu" id="submenu">
                <a href="#"><i class="fas fa-globe"></i> Pays & Regions <i class="fas fa-chevron-down right"></i></a>
                <div class="sub-content hide" id="sub-content">
                    <a href="country.php#country"> Les Pays</a>
                    <a href="country.php#add_country"> Ajouter un pays</a>
                    <a href="country.php#region"> Les Regions</a>
                    <a href="country.php#add_region"> Ajouter une region</a>
                </div>
            </div>
        </div>
        

<main class="ccol-md-9 ml-sm-auto col-lg-10 px-4">