<?php
require_once __DIR__ . '/../assets/config/bootstrap_admin.php';
$vues = nombre_vues();
$page_title ='Back-office';
include __DIR__.'/assets/includes/header_admin.php';
?>

<div class="title_page">
    <h1><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
</div>




<div class="py-5">
    <div class="container-fluid">
        <h4 class="title_container">Trafic</h4>
      <div class="row hidden-md-up">
          
        <div class="col-md-3">
          <div class="card text-white text-center bg-info"> 
            <div class="card-header">Visiteurs en ligne</div>
                <div class="card-body">
                    <p class="card-text"><?php echo $user_nbr; ?></p>
                </div>
          </div>
        </div>
        
        <div class="col-md-3">
          <div class="card text-white text-center bg-info"> 
            <div class="card-header">Nombre de visiteurs total</div>
                <div class="card-body">
                    <p class="card-text"><?php echo $vues; ?></p>
                </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card text-white text-center bg-info"> 
            <div class="card-header">Nombre de visiteurs ce mois-ci</div>
                <div class="card-body">
                    <p class="card-text"><?php echo $this_month; ?></p>
                </div>
          </div>
        </div>

      </div> <!-- end row -->
    </div> <!-- end container-->
  </div>

<?php
include __DIR__.'/assets/includes/footer_admin.php';
?>