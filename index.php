<?php
require_once __DIR__ . '/assets/config/bootstrap.php';
$page_title ='Accueil';
include __DIR__.'/assets/includes/header_index.php';
?>

<?php include __DIR__.'/assets/includes/flash.php';?>

<section class="hero">
        
            
        <p class="coords">N 48° 42' 2.571" / E 2° 31' 1.023"</p>

<div class="ellipse-container">
    <h2 class="greeting">Van Dreams</h2>
    <div class="ellipse ellipse__outer--thin">
        <div class="ellipse ellipse__orbit"></div>
    </div>
    <div class="ellipse ellipse__outer--thick"></div>
           
        
    </section>

    
<script type="text/javascript" src="assets/js/index.js"></script>
<?php
include __DIR__.'/assets/includes/footer.php';
?>