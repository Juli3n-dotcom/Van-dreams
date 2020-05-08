<?php
require_once __DIR__ . '/assets/config/bootstrap.php';

require_once __DIR__ . '/assets/functions/annonces.php';
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


    <div class="container-fluid">
    <div class="row">
<?php foreach(getAnnonces($pdo) as $annonce):?>
    <div class="card col-md-4 mb-4 <?php if($annonce['est_signal']==1):?>bg-warning<?php endif;?>" style="width: 8rem;">
    <div class="card-header">Annonce #<?=$annonce['id_annonce']?></div>
    <?php
        $id_membre = $annonce['membre_id'];
        $id_photo = $annonce['photo_id'];
        $id_country = $annonce['country_id'];
        $id_region = $annonce['region_id'];
        $id_category = $annonce['category_id'];
        $id_subcat = $annonce['subcat_id'];

        $data = $pdo->query("SELECT * FROM photo WHERE id_photo = '$id_photo'");
        $photo = $data->fetch(PDO::FETCH_ASSOC);

        $data_membre = $pdo->query("SELECT * FROM membre WHERE id_membre = '$id_membre'");
        $membre = $data_membre->fetch(PDO::FETCH_ASSOC);

        $data_country = $pdo->query("SELECT * FROM country WHERE id_country = '$id_country'");
        $country = $data_country->fetch(PDO::FETCH_ASSOC);

        $data_region = $pdo->query("SELECT * FROM region WHERE id_region = '$id_region'");
        $region = $data_region->fetch(PDO::FETCH_ASSOC);

        $data_category = $pdo->query("SELECT * FROM category WHERE id_category = '$id_category'");
        $category = $data_category->fetch(PDO::FETCH_ASSOC);

        $data_sub = $pdo->query("SELECT * FROM sub_category WHERE id_sub_cat = '$id_subcat'");
        $subcat = $data_sub->fetch(PDO::FETCH_ASSOC);
    ?>
      <img src="../user/data/img/<?= $photo['photo1']?>" class="card-img-top" alt="image_annonce">
      <div class="card-body">
        <h4 class="card-title mb-3"><?=$annonce['titre_annonce']?></h4>
        <p class="card-text mb-3">Publiée par :  <?=$membre['prenom']?></p>
        <p class="card-text mb-3">Catégorie :  <?=$category['titre']?> /  <?=$subcat['titre']?></p>
        <p class="card-text mb-3">Localisation :  <?=$country['name']?> / <?=$region['name']?></p>
        <p class="card-text mb-3"><small class="text-muted">Publiée le: <?=$annonce['date_enregistrement']?></small></p>
        <a href="fiche.php?id=<?=$annonce['id_annonce'];?>" class="btn btn-primary">Voir l'annonce</a>
      </div>
      <div class="card-footer">
      <a href="annonces.php#id=<?=$annonce['id_annonce']?>" class="btn btn-danger"data-toggle="modal" data-target="#<?=$annonce['name']?>"><i class='fas fa-trash-alt'></i> Delete</a>

     <!-- Modal delete -->

     <div class="modal fade" id="<?=$annonce['name']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Supprimer annonce | #<?=$annonce['id_annonce']??'';?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="annonces.php?id=<?=$annonce['id_annonce'];?>" method="post">
                                            
                                                <p class="mb-2">Etes vous sur de vouloir supprimer l'annonce #<?=$annonce['id_annonce']?> ?</p>
                                            
                                                <div class='confirm_delete' id="confirm_delete">
                                                <input type="checkbox" class="delete_check mr-3" name="delete_check"/><label for="delete_check" class="delete_label">Je confirme la suppression</label>
                                                <input type="hidden" name="idSupr" value="<?=$annonce['id_annonce']?>">
                                                <input type="hidden" name="idSupr2" value="<?=$annonce['photo_id']?>">
                                                </div>
                                         </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-danger" name="delete_annonce" value="Supprimer" >
                                    </div>
                                        </form>  
                                    </div>
                                </div>
                        </div>
      </div>
    </div>
<?php endforeach;?>

    </div>
  </div>

  <script type="text/javascript" src="assets/js/index.js"></script>
<?php
include __DIR__.'/assets/includes/cookie.php';
include __DIR__.'/assets/includes/footer.php';
?>