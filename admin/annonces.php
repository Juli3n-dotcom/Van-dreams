<?php
require_once __DIR__ . '/../assets/config/bootstrap_admin.php';

$page_title ='Gestion des annonces';
include __DIR__.'/assets/includes/header_admin.php';
?>

<div class="title_page">
    <h1><i class="fas fa-archive"></i> Gestion des annonces</h1>
</div>
<?php include __DIR__.'/../assets/includes/flash.php';?>

<div class="py-5"> <!-- Membre -->
    <div class="container-fluid">
      <div class="row hidden-md-up">
          
        <?php
        $counter =$pdo->query('SELECT COUNT(*) as nb FROM annonces');
        $data_annonces = $counter->fetch();
        $totalAnnonces =$data_annonces['nb'];
        ?>
        <div class="col-md-3">
          <div class="card text-white text-center bg-success"> 
            <div class="card-header">Annonces total</div>
                <div class="card-body">
                    <p class="card-text"><?= $totalAnnonces; ?></p>
                </div>
          </div>
        </div>
        <?php
        $annoncesSignale=$pdo->query('SELECT COUNT(*)AS nb FROM annonces WHERE est_signal = 1');
        $data = $annoncesSignale ->fetch();
        $signal = $data['nb'];
        ?>
        <div class="col-md-3">
          <div class="card text-white text-center bg-warning"> 
            <div class="card-header">Annonces signalée</div>
                <div class="card-body">
                    <p class="card-text"><?= $signal; ?></p>
                </div>
          </div>
        </div>

      </div> <!-- end row -->
    </div> <!-- end container-->
  </div>

<?php
include __DIR__.'/assets/includes/footer_admin.php';
?>