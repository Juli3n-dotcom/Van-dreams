<?php
require_once __DIR__ . '/assets/config/bootstrap.php';
require_once __DIR__ . '/assets/functions/post.php';
require_once __DIR__ . '/assets/functions/annonces.php';

//like
if(isset($_POST['addFavori'])){
    if(getMembre() === null){
      ajouterFlash('danger','merci de vous connecter pour mettre en favori.');
    }else{
      $req = $pdo->prepare(
        'INSERT INTO favoris (membre_id, annonce_id, est_favoris)
        VALUES (:membre_id, :annonce_id, :est_favoris)'
    );
  
    $req->bindParam(':membre_id',getMembre()['id_membre'], PDO::PARAM_INT);
    $req->bindParam(':annonce_id',$Annonce['id_annonce']);
    $req->bindValue(':est_favoris',1);
    $req->execute();
  
      ajouterFlash('success','Annonce sauvegardée');
    }
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



$page_title ='Les Annonces';
include __DIR__.'/assets/includes/header.php';
?>
<?php include __DIR__.'/assets/includes/flash.php';?>

<section class="allpost">

<div class="search">
    <form action="" method="get">
        <div class="container">
            <div class="row">
        <div class="col-md-6">
        <div class="search_part col">
            <select name="cat" id="cat" class="custom-dropdown">
                <option selected>Choisir un type de véhicule</option>
            <?php foreach(getCategory($pdo) as $cat) : ?>
                <option value="<?=$cat['id_category'];?>"><?=$cat['titre'];?></option>
            <?php endforeach; ?>
            </select>
        </div>

        <div class="search_part col">
            <select name="subcat" id="subcat" class="custom-dropdown">
                <option selected>choisir une catégorie</option>
            <?php foreach(getSubCategory($pdo) as $subcat) : ?>
                <option value="<?=$subcat['id_sub_cat'];?>"><?=$subcat['titre'];?></option>
            <?php endforeach; ?>
            </select>
        </div>
        </div>

        <div class="col-md-6">
        <div class="search_part col">
            <select name="pays" id="country" class="custom-dropdown">
                <option selected>Choisir un pays</option>
            <?php foreach(getCountry($pdo) as $country) : ?>
                <option value="<?=$country['id_country'];?>"><?=$country['name'];?></option>
            <?php endforeach; ?>
            </select>
        </div>

        <div class="search_part col">
            <select name="region" id="regions" class="custom-dropdown">
                <option selected>Choisir un pays en premier</option>
            </select>
        </div>
        </div>

            </div>
        </div>
       
        <div class="price_part">
            <input type="number" pattern="[0-9]*" name="prix_min" placeholder="prix min" class="input-field">
            <input type="number" pattern="[0-9]*" name="prix_max" placeholder="prix max" class="input-field">
        </div>
       <button type="submit" name="search" class="submit-btn_depot">Rechercher</button>
    </form>
</div>

<div class="allannonces">
    <div class="container">
        <div class="row">
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

        $user = getMembre()['id_membre'];
        $id = $annonce['id_annonce'];
        $data_loved = $pdo->query("SELECT * FROM favoris WHERE membre_id = '$user' AND annonce_id = '$id'");
        $favori = $data_loved->fetch(PDO::FETCH_ASSOC);
        ?>
        <div class="col-md-6 col-lg-4">
            <div class="annonce-box">
                <div class="annonce-img">
                    <img src="/Vandreams/user/data/img/<?= $photo['photo1']?>" alt="photo_annonce">
                </div> 
                <div class="price">
                    <p><?= $annonce['prix']?>€</p> 
                </div>
                <div class="like">
                <?php if($favori['est_favori'] == TRUE):?>
                    <form action="" method="POST">
                        <input type="hidden" name="idSupr" value="<?=$favori['id_favori']?>">
                        <button type="submit" class="favoris" name='removeFavori'><i class="fas fa-heart"></i></button>
                    </form>
                <?php else:?> 
                    <form action="" method="POST">
                        <input type="hidden" name="idannonce" value="<?= $annonce['id_annonce']?>">
                        <button type="submit" class="favoris" name='addFavori'><i class="far fa-heart"></i></button>
                     </form>
                <?php endif;?>
                </div>
                <div class="annonce-details">
                    <h4><?= ($annonce['titre_annonce'])?></h4>
                    <div class="description_annonce">
                        <p><?= substr($annonce['description_annonce'],0,255).'...'?></p>
                    </div>
                        <p><i class="fas fa-user"></i> Publié par : <?= $membre['prenom']?></p>
                        <p><i class="fas fa-th-large"></i> : <?= $category['titre']?> / <?= $subcat['titre']?></p>
                        <p><i class="fas fa-map-marker-alt"></i> : <?= $country['name']?> / <?= $region['name']?></p>
                </div>
                <div class="annoncelink">
                    <a href="annonce/<?=$annonce['id_annonce'];?>" class="annonce_btn">Voir l'annonce</a>
                </div>
            </div>
        </div>
        <?php endforeach;?>
        </div>
    </div>
</div>

</section>
<?php
include __DIR__.'/assets/includes/footer.php';
?>