<?php
require_once __DIR__ . '/assets/config/bootstrap.php';
$page_title ='Accueil';
include __DIR__.'/assets/includes/header.php';
?>

<?php include __DIR__.'/assets/includes/flash.php';?>

<section class="hero">
        
            
        <p class="coords">N 49° 16' 35.173" / W 0° 42' 11.30"</p>

<div class="ellipse-container">
    <h2 class="greeting">Van Dreams</h2>
    <div class="ellipse ellipse__outer--thin">
        <div class="ellipse ellipse__orbit"></div>
    </div>
    <div class="ellipse ellipse__outer--thick"></div>
           
        
    </section>

<?php
include __DIR__.'/assets/includes/footer.php';
?>