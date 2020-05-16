<?php
require_once __DIR__ . '/../assets/config/bootstrap.php';
require __DIR__ . '/assets/functions/annonces_by_user.php';


$Membre = getMembre($pdo, $_GET['id_membre'] ?? null);



$page_title ='Mes annonces';
include __DIR__.'/assets/includes/header_user.php';
?>

<?php include __DIR__.'/../assets/includes/flash.php';?>

<div class="myannonces">
    <h1>Mes Annonces</h1>
    <div class="container">
        <div class="row">
            <?php foreach(getAnnoncesByUser($pdo,$Membre['id_membre']) as $annonce):?>
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

  
                    $date = implode('-',array_reverse  (explode('/',$annonce['date_enregistrement'])));
                ?>

                <div class="col-md-4">
                    <div class="annonce-box">
                        <div class="annonce-img">
                            <img src="data/img/<?= $photo['photo1']?>" alt="photo_annonce">
                        </div> 
                        <div class="price">
                           <p><?= $annonce['prix']?>€</p> 
                        </div>
                        <div class="annonce-details">
                            <h4><?= $annonce['titre_annonce']?></h4>
                            <p>Catégorie : <?= $category['titre']?> / <?= $subcat['titre']?></p>
                            <p>Localisation : <?= $country['name']?> / <?= $region['name']?></p>
                        </div>
                        <div class="annoncelink">
                        <a href="annonce/<?=$annonce['id_annonce'];?>" class="annonce_btn">Voir l'annonce</a>
                        </div>
                        <div class="annonce_bottom">
                            <a href="" class="annonce_btn updateAnnonce">Modifier</a>
                            <form method="post">
                                <input type="hidden" name="SupannonceID" value="<?= $annonce['id_annonce']?>">
                                <button type="submit" class="annonce_btn SupAnnonce" name="SupAnnonce">Supprimer</button>
                            </form>
                        </div>
                           
                    </div>
                </div>

             <?php endforeach;?>
        </div>
    </div>
    
</div>

<?php
include __DIR__.'/assets/includes/footer_user.php';
?>