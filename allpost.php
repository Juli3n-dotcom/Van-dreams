<?php
require_once __DIR__ . '/assets/config/bootstrap.php';
require_once __DIR__ . '/assets/functions/post.php';
require_once __DIR__ . '/assets/functions/annonces.php';
require_once __DIR__ . '/assets/functions/membre_function.php';

$Membre = getMembre($pdo, $_GET['id_membre'] ?? null);

if(isset($_POST['noUser'])){
setcookie('allpost', true, time()+3600);
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



$page_title ='Les Annonces';
include __DIR__.'/assets/includes/header.php';
?>
<?php include __DIR__.'/assets/includes/flash.php';?>

<section class="allpost">

<div class="search">
    <form action="" method="post">
        <div class="container">
            <div class="row">
        <div class="col-md-6">
        <div class="search_part col">
            <select name="category" id="category" class="custom-dropdown">
                <option selected value="A">Choisir un type de véhicule</option>
            <?php foreach(getCategory($pdo) as $cat) : ?>
                <option value="<?=$cat['id_category'];?>"><?=$cat['titre_cat'];?></option>
            <?php endforeach; ?>
            </select>
        </div>

        <div class="search_part col">
            <select name="subcat" id="subcat" class="custom-dropdown">
                <option selected value="A">Choisir une catégorie</option>
            <?php foreach(getSubCategory($pdo) as $subcat) : ?>
                <option value="<?=$subcat['id_sub_cat'];?>"><?=$subcat['titre_subcat'];?></option>
            <?php endforeach; ?>
            </select>
        </div>
        </div>

        <div class="col-md-6">
        <div class="search_part col">
            <select name="country" id="country" class="custom-dropdown">
                <option selected value="A">Choisir un pays</option>
            <?php foreach(getCountry($pdo) as $country) : ?>
                <option value="<?=$country['id_country'];?>"><?=$country['name_country'];?></option>
            <?php endforeach; ?>
            </select>
        </div>

        <div class="search_part col">
            <select name="regions" id="regions" class="custom-dropdown">
                <option selected value="A">Choisir un pays en premier</option>
            </select>
        </div>
        </div>

            </div>
        </div>
       
    </form>
</div>

<div id="resultat">

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

        
        // $id = $annonce['id_annonce'];
        // $data_loved = $pdo->query("SELECT * FROM favoris WHERE membre_id = '$user' AND annonce_id = '$id'");
        // $favori = $data_loved->fetch(PDO::FETCH_ASSOC);
        ?>
        <div class="col-md-6 col-lg-4">
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
                                    <input type="hidden" name="iduser" value="'.$Membre['id_membre'].'">
                                    <input type="hidden" name="idannonce" value="'.$annonce['id_annonce'].'">
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
        </div>
        <?php endforeach;?>
        </div>
    </div>
</div>

</div> <!-- fin resultats-->

</section>
<?php
include __DIR__.'/assets/includes/footer.php';
?>


 