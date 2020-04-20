<?php
require_once __DIR__ . '/../assets/config/bootstrap_admin.php';
$page_title ='Back-office';
include __DIR__.'/assets/includes/header_admin.php';
?>

<div class="title_page">
    <h1><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
</div>


<div class="container-fluid mt-3">
    <div class="row">
        <div class="col">
            <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                <div class="card-header">Nombre de visteurs en ligne</div>
                <div class="card-body">
                <p class="card-text text-center"><?php echo $user_nbr; ?></p>
            </div>
        </div>
    </div>
</div>

<?php
include __DIR__.'/assets/includes/footer_admin.php';
?>