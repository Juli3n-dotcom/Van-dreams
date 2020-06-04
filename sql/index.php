<?php
require_once __DIR__ . '/assets/config/bootstrap.php';
require_once __DIR__ . '/assets/functions/post.php';
require_once __DIR__ . '/assets/functions/annonces.php';
require_once __DIR__ . '/assets/functions/membre_function.php';

$Membre = getMembre($pdo, $_GET['id_membre'] ?? null);

if(isset($_POST['noUser'])){
setcookie('favindex', true, time()+3600);
ajouterFlash('danger','merci de vous connecter pour liker cette annonce.');
  header('location:login');
}

//like
if(isset($_POST['addFavori'])){
    
      $req = $pdo->prepare(
        'INSERT INTO favoris (membre_id, annonce_id, est_favori)
        VALUES (:membre_id, :annonce_id, :est_favori)'
    );
  
    $req->bindParam(':membre_id',$_POST['iduser']);
    $req->bindParam(':annonce_id',$_POST['idannonce']);
    $req->bindValue(':est_favori',1);
    $req->execute();
  
      ajouterFlash('success','Annonce sauvegardée');
    }
  
  
  //sup favori
  if(isset($_POST['removeFavori'])){
    $req = $pdo->prepare(
      'DELETE FROM favoris
      WHERE :id = id_favori'
    );
    $req->bindParam(':id',$_POST["idSupr"],PDO::PARAM_INT);
    $req->execute();
  
    ajouterFlash('success','Annonce retirée de vos favoris');
  }

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

<section class="container">
    <div class="title-heading">
        <h3>Nouveautés</h3>
            <h1>Découvrez les derniéres annonces</h1>
                <p>Venez trouver votre bonheur parmis des petits nouveaux du site</p>
    </div>
    <div class="row">
        <div class="glide">
            <div class="glide__track" data-glide-el="track">
                <ul class="glide__slides">
                    <?php foreach(getAnnonces($pdo) as $annonce):?>
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
                <li class="glide__slide">
                    <div class="col-md-6 col-lg-4 card_carousel">
                    <div class="annonce-box">
                        <div class="annonce-img">
                            <img src="/data/<?= $photo['photo1']?>" alt="photo_annonce">
                        </div>
                        <div class="price">
                            <p><?= $annonce['prix']?>€</p> 
                        </div>
                        <div class="like">
                        <?php
                    if($Membre === null){
                        echo '<form action="" method="POST">
                                <button type="submit" class="favoris" name="noUser"><i class="far fa-heart"></i></button>
                            </form>';  
                    }else{
                        $favori = getfavori($pdo, $Membre['id_membre'], $annonce['id_annonce']);
    
                        if($favori == false){
                            echo '<form action="" method="POST">
                                    <input type="hidden" name="iduser" value="'.$Membre["id_membre"].'">
                                    <input type="hidden" name="idannonce" value="'.$annonce["id_annonce"].'">
                                    <button type="submit" class="favoris" name="addFavori"><i class="far fa-heart"></i></button>
                                </form>';   
                        }else{
                            echo '<form action="" method="POST">
                                    <input type="hidden" name="idSupr" value="'.$favori.'">
                                    <button type="submit" class="favoris" name="removeFavori"><i class="fas fa-heart"></i></button>
                                </form>';
                        }
                    }
                ?>
                        </div>
                        <div class="annonce-details">
                            <h4><?= ($annonce['titre_annonce'])?></h4>
                            <div class="description_annonce">
                                <p><?= substr($annonce['description_annonce'],0,255).'...'?></p>
                            </div>
                            <p><i class="fas fa-user"></i> Publié par : <?= $membre['prenom']?></p>
                            <p><i class="fas fa-th-large"></i> : <?= $category['titre_cat']?> / <?= $subcat['titre_subcat']?></p>
                            <p><i class="fas fa-map-marker-alt"></i> : <?= $country['name_country']?> / <?= $region['name_region']?></p>
                        </div>
                        <div class="annoncelink">
                            <a href="annonce/<?=$annonce['id_annonce'];?>" class="annonce_btn">Voir l'annonce</a>
                        </div>
                    </div>
                </li>
            <?php endforeach;?>            
        </ul>
    </div>
  <div class="glide__arrows" data-glide-el="controls">
    <button class="glide__arrow glide__arrow--left" data-glide-dir="<"><i class="fas fa-chevron-left"></i></button>
    <button class="glide__arrow glide__arrow--right" data-glide-dir=">"><i class="fas fa-chevron-right"></i></button>
  </div>
</div>
</div>
</section>

<section class="part2">
        <div class="container">
            <div class="block2">
                <div class="block-text-box">
                    <h3>
                        Et si vous aussi vous vendiez votre van? sur VanDreams?
                    </h3>
                </div>
                <div class="block-depot">
                   <a href="post" class="index_link">Déposer une annonce</a>
                </div>
            </div>
        </div>
</section>

<section class="container part3">
    <div class="title-heading">
        <h3>Les aménagés</h3>
            <h1>Envie de partir directement?</h1>
                <p>Venez découvrir parmis une selection de véhicules déjà aménagés</p>
    </div>
    <div class="row">
        <div class="glide">
            <div class="glide__track" data-glide-el="track">
                <ul class="glide__slides">
                    <?php foreach(getAnnoncesSubCat($pdo) as $annonce):?>
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
                <li class="glide__slide">
                    <div class="col-md-6 col-lg-4 card_carousel">
                    <div class="annonce-box">
                        <div class="annonce-img">
                            <img src="/Vandreams/data/<?= $photo['photo1']?>" alt="photo_annonce">
                        </div>
                        <div class="price">
                            <p><?= $annonce['prix']?>€</p> 
                        </div>
                        <div class="like">
                        <?php
                    if($Membre === null){
                        echo '<form action="" method="POST">
                                <button type="submit" class="favoris" name="noUser"><i class="far fa-heart"></i></button>
                            </form>';  
                    }else{
                        $favori = getfavori($pdo, $Membre['id_membre'], $annonce['id_annonce']);
    
                        if($favori == false){
                            echo '<form action="" method="POST">
                                    <input type="hidden" name="iduser" value="'.$Membre["id_membre"].'">
                                    <input type="hidden" name="idannonce" value="'.$annonce["id_annonce"].'">
                                    <button type="submit" class="favoris" name="addFavori"><i class="far fa-heart"></i></button>
                                </form>';   
                        }else{
                            echo '<form action="" method="POST">
                                    <input type="hidden" name="idSupr" value="'.$favori.'">
                                    <button type="submit" class="favoris" name="removeFavori"><i class="fas fa-heart"></i></button>
                                </form>';
                        }
                    }
                ?>
                        </div>
                        <div class="annonce-details">
                            <h4><?= ($annonce['titre_annonce'])?></h4>
                            <div class="description_annonce">
                                <p><?= substr($annonce['description_annonce'],0,255).'...'?></p>
                            </div>
                            <p><i class="fas fa-user"></i> Publié par : <?= $membre['prenom']?></p>
                            <p><i class="fas fa-th-large"></i> : <?= $category['titre_cat']?> / <?= $subcat['titre_subcat']?></p>
                            <p><i class="fas fa-map-marker-alt"></i> : <?= $country['name_country']?> / <?= $region['name_region']?></p>
                        </div>
                        <div class="annoncelink">
                            <a href="annonce/<?=$annonce['id_annonce'];?>" class="annonce_btn">Voir l'annonce</a>
                        </div>
                    </div>
                </li>
            <?php endforeach;?>            
        </ul>
    </div>
  <div class="glide__arrows" data-glide-el="controls">
    <button class="glide__arrow glide__arrow--left" data-glide-dir="<"><i class="fas fa-chevron-left"></i></button>
    <button class="glide__arrow glide__arrow--right" data-glide-dir=">"><i class="fas fa-chevron-right"></i></button>
  </div>
</div>
</div>
</section>

<script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>
<script type="text/javascript" src="assets/js/index.js"></script>
<?php
include __DIR__.'/assets/includes/cookie.php';
include __DIR__.'/assets/includes/footer.php';
?>