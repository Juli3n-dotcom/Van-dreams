<?php
require_once __DIR__ . '/../assets/config/bootstrap.php';


$Membre = getMembre($pdo, $_GET['id_membre'] ?? null);





$page_title ='Mes annonces';
include __DIR__.'/assets/includes/header_user.php';
?>

<?php include __DIR__.'/../assets/includes/flash.php';?>

<div class="myannonces">
    <h1>Mes Annonces</h1>
</div>

<?php
include __DIR__.'/assets/includes/footer_user.php';
?>