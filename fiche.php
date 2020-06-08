<?php
require_once __DIR__ . '/assets/config/bootstrap.php';
require_once __DIR__ . '/assets/functions/annonces.php';
require_once __DIR__ . '/assets/functions/register.php';
require_once __DIR__ . '/assets/functions/membre_function.php';

$Annonce =  getAnnonceByID($pdo, $_GET['id'] ?? null);
$Membre = getMembre($pdo, $_GET['id_membre'] ?? null);

if ($Annonce === null && !role(ROLE_ADMIN)){

    ajouterFlash('warning', 'Annonce inconnu.');
    session_write_close();
    header('location:../oups');
}

if(isset($_POST['noUser'])){
  $id = $Annonce['id_annonce'];
  setcookie('fiche', $id, time()+3600, '/', null,false, true);
  sleep(1);
    header('location:../login');
  }

// traitement login
if(isset($_POST['login'])){
   
  $req = $pdo->prepare(
    'SELECT * 
    FROM membre
    WHERE
     email = :email'
  );
  $req->bindParam(':email',htmlspecialchars($_POST['identifiant']));
  $req->execute();
  $membre = $req->fetch(PDO::FETCH_ASSOC);

  if (!$membre) {
    ajouterFlash('danger','Membre inconnu.');

    
  }elseif (!password_verify($_POST['password_login'], $membre['password'])){
      ajouterFlash('danger','Mot de passe erroné!');

  }else{

    if(isset($_POST['rememberme'])){
      setcookie('token',$membre['token'],time()+365*24*3600, null, null, false, true);
  }

    unset($membre['password']);
    $_SESSION['membre']=$membre;
    ajouterFlash('success','Bonjour '.getMembre()['prenom']);
    session_write_close();
  }
}



// inscription
if (isset($_POST['register'])){

  if(getMembreBy($pdo, 'email', $_POST['email'])!==null) {
      ajouterFlash('danger','Email déja utilisé !');

  }elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
 ajouterFlash('danger','Email non valide.');

  }elseif (!preg_match('~^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$~',$_POST['password'])) {
      ajouterFlash('danger','Votre mot de passe doit contenir :minimum 8 caractéres, 1 maj, 1min, 1chiffre  et 1 caractére spécial.');
    
   
  }elseif ($_POST['password'] !== $_POST['confirm'] ){
      ajouterFlash('danger','Merci de confirmer votre mot de passe.');
      
  }elseif (!preg_match('~^[a-zA-Z-]+$~',$_POST['name'])) {
      ajouterFlash('danger','Nom manquant');
  
  }elseif (!preg_match('~^[a-zA-Z-]+$~',$_POST['first_name'])) {
      ajouterFlash('danger','Prénom manquant');

  }elseif (empty($_POST['cgu'])){
        ajouterFlash('danger','Merci d\'accepter les CGU');
      
  }else{

      $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $ip = getIp();
      $name = $_POST['name'].$_POST['first_name'];

      $req = $pdo->prepare(
          'INSERT INTO membre (email, name, password, nom, prenom, statut, cgu, date_enregistrement, confirmation, token, ip)
          VALUES (:email, :name, :password, :nom,:prenom, :statut, :cgu, :date, :confirmation, :token, :ip)'
      );

      $req->bindParam(':email',$_POST['email']);
      $req->bindParam(':name',$name);
      $req->bindParam(':password',$hash);
      $req->bindParam(':nom',$_POST['name']);
      $req->bindParam(':prenom',$_POST['first_name']);
      $req->bindValue(':statut',0);
      $req->bindValue(':cgu',1);
      $req->bindValue(':date',(new DateTime())->format('Y-m-d H:i:s'));
      $req->bindValue(':confirmation',0);
      $req->bindParam(':token',bin2hex(random_bytes(16)));
      $req->bindParam(':ip',$ip);
      $req->execute();

      unset($_POST);
      ajouterFlash('success','Welcome!');
      session_write_close();

  }
}



//Message
if(isset($_POST['envoyer'])){
  

  if(empty($_POST['message'])||strlen($_POST['message'])>255){
   ajouterFlash('danger','Votre message est vide.');
    }else{
      
        $req = $pdo->prepare(
            'INSERT INTO conversation (expediteur, destinataire, annonce_id, subject, est_lu_expediteur, est_lu_destinataire, date_enregistrement)
            VALUES (:expediteur, :destinataire, :annonce_id, :subject, :lu_expediteur, :lu_destinataire, :date)'
        );
        $req->bindParam(':expediteur', getMembre()['id_membre'], PDO::PARAM_INT);
        $req->bindParam(':destinataire', $Annonce['membre_id']);
        $req->bindParam(':annonce_id', $Annonce['id_annonce']);
        $req->bindParam(':subject', $_POST['subject']);
        $req->bindValue(':lu_expediteur',0);
        $req->bindValue(':lu_destinataire',1);
        $req->bindValue(':date',(new DateTime())->format('Y-m-d H:i:s'));
        $req->execute();

        $id_conversation = $pdo-> lastInsertId();

        $req2 = $pdo->prepare(
          'INSERT INTO message (expediteur, destinataire, conversation_id,  message, date_enregistrement)
          VALUES (:expediteur, :destinataire, :conversation_id, :message,  :date)'
      );
      $req2->bindParam(':expediteur', getMembre()['id_membre'], PDO::PARAM_INT);
      $req2->bindParam(':destinataire', $Annonce['membre_id']);
      $req2->bindParam(':conversation_id', $id_conversation);
      $req2->bindParam(':message', $_POST['message']);
      $req2->bindValue(':date',(new DateTime())->format('Y-m-d H:i:s'));
      $req2->execute();
    }
    unset($_POST);
    ajouterFlash('success','Votre message a bien été envoyé');
}


$page_title ='Annonce N°VD-00'.$Annonce['id_annonce'];
include __DIR__.'/assets/includes/header_fiche.php';
?>

<?php include __DIR__.'/assets/includes/flash.php';?>

<section id="showcase">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-6">
            <div class="showcase-left">
        <?php
        $id_membre = $Annonce['membre_id'];
        $id_photo = $Annonce['photo_id'];
        $id_country = $Annonce['country_id'];
        $id_region = $Annonce['region_id'];
        $id_category = $Annonce['category_id'];
        $id_subcat = $Annonce['subcat_id'];

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
             <a href="#portfolio-item-0">
              <img src="/data/<?= $photo['photo1']?>" alt="photo_annonce">
            </a>
            </div>
          </div>
          <div class="col-md-6 col-sm-6">
            <div class="showcase-right">
              <h1><?= $Annonce['titre_annonce']?></h1>
              
              <p class="customer text-muted">Publié par : <?= $membre['prenom']?></p>
              <p class="customer text-muted">Catégorie : <?= $category['titre_cat']?> / <?= $subcat['titre_subcat']?></p>
            </div>
            <br>
            <p class="btn-default btn-lg showcase-price"><?= $Annonce['prix']?>  €</p>
            <div id="resultat">
            <?php
                    if($Membre === null){
                        echo '<form action="" method="POST">
                                <button type="submit" class="noUser" name="noUser"><i class="far fa-heart"></i></button>
                            </form>';  
                    }else{
                        $favori = getfavori($pdo, $Membre['id_membre'], $Annonce['id_annonce']);
    
                        if($favori == false){
                            echo '<form action="" method="POST">
                                    <input type="hidden" name="iduser" id="iduser" value="'.$Membre["id_membre"].'">
                                    <input type="hidden" name="idannonce" id="idannonce" value="'.$Annonce["id_annonce"].'">
                                    <button type="submit" class="favoris" id="addFavori" name="addFavori"><i class="far fa-heart"></i></button>
                                </form>';   
                        }else{
                            echo '<form action="" method="POST">
                                    <input type="hidden" id="idSupr" name="idSupr" value="'.$favori.'">
                                    <button type="submit" class="removefavori" id="removeFavori" name="removeFavori"><i class="fas fa-heart"></i></button>
                                </form>';
                        }
                    }
                ?>
                </div> <!-- fin resultat-->
          </div>
        </div>
      </div>
    </section>

    <section id="testimonial">
      <div class="container">
        <p><?= nl2br($Annonce['description_annonce'])?></p>
      </div>
    </section>

    <section id="info1">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-6">
            <div class="info-left">
              <div class="container">
                <div class="row">
                  <div class="col-md-6 col-sm-6">
                    <a href="#portfolio-item-1">
                     <img src="/data/<?= $photo['photo2']?>" alt="photo_annonce">
                    </a>
                  </div>
                  <div class="col-md-6 col-sm-6">
                  <a href="#portfolio-item-2">
                     <img src="/data/<?= $photo['photo3']?>" alt="photo_annonce">
                     </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-6">
            <div class="info-right">
              <h2>Critéres : </h2>
              <p ><strong>Marque :</strong> <?= $Annonce['marque']?></p>
              <p ><strong>Modele :</strong> <?= $Annonce['modele']?></p>
              <p ><strong>Kilomètres :</strong> <?= $Annonce['km']?></p>
              <p ><strong>Annee modele :</strong> <?= $Annonce['annee_modele']?></p>
              <p ><strong>Nombres de places :</strong> <?= $Annonce['places']?></p>
              <p ><strong>VASP :</strong> <?= $Annonce['vasp'] == 1 ? 'OUI' :' NON ' ;?></p>
              <br>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <section id="info2">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-6">
            <div class="info-left">
              <h2>Localisation : </h2>
              <p ><strong>Pays :</strong> <?= $country['name_country']?></p>
              <p ><strong>Région :</strong> <?= $region['name_region']?></p>
              <p ><strong>Ville :</strong> <?= $Annonce['ville']?></p>
              <p ><strong>Code Postal :</strong> <?= $Annonce['cp']?></p>
            </div>
          </div>
          <div class="col-md-6 col-sm-6">
            <div class="info-right">
              <h2>Coordonnées : </h2>
             <?php if($Annonce['est_publie'] == 1):?>
                <p>La personne qui publie ne souhaite pas afficher ses coordonnées,</p>
                <p>Merci d'utilser le formulaire de contact</p>
             <?php else:?>
              <p ><strong>Téléphone :</strong> <?= $Annonce['telephone']?></p>
             <?php endif;?>
            </div>
          </div>
        </div>
      </div>
    </section>

    
    <div class="contact_form_fiche">
      <?php if(getMembre() !== null):?>
        <div id="contact">
          <div class="container">
            <div class="row">
              <div class="form-box_fiche">
                <form action="" method="post">
                  <div class="input-group_fiche">
                    <h3 class="title_part">Votre message pour <?= $membre['prenom']?></h3>
                      <input type="text" class="input-field" name="subject" placeholder="Le suject de votre message" value="<?= htmlspecialchars($_POST['subject']??'');?>">
                      <textarea class="input-field" name="message" cols="40" rows="12" placeholder="Votre message" 
                      value=""><?= htmlspecialchars($_POST['message']??'');?></textarea>
                      <button type="submit" class="submit-btn_depot" name="envoyer">Envoyer</button>
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    <?php else:?>
      <div class="hero_fiche">
        <h4>Merci de vous connecter pour contacter <?= $membre['prenom']?></h4>
    <div class="form-box">
        <div class="button-box">
            <div id="btn"></div>
            <button type="button" class="toggle-btn"  id="login_btn">Connexion</button>
            <button type="button" class="toggle-btn"  id="register_btn">Inscription</button>
        </div>
        <form action="" method="POST" class="input-group" id="login">
        <div class="logo"></div>
            <input type="email" class="input-field" name="identifiant" placeholder="Votre adresse email">
            <input type="password" class="input-field" name="password_login" placeholder="Votre mot de passe">
            <input type="checkbox" class="check-box"><span>Se souvenir de moi</span>
            <button type="submit" class="submit-btn" name="login">Connexion</button>
            <a href="resetpassword">Mot de passe oublié </a>
        </form>
        <form action="" method="POST" class="input-group" id="register">
            <input type="text" name="name" class="input-field" placeholder="Votre Nom" value="<?= $_POST['name'] ?? '' ?>">
            <input type="text" name="first_name" class="input-field" placeholder="Votre Prénom" value="<?= $_POST['first_name'] ?? '' ?>">
            <input type="email" name="email" class="input-field" placeholder="Email" value="<?= $_POST['email'] ?? '' ?>">
            <input type="password" name="password" class="input-field" placeholder="Mot de passe">
            <input type="password" name="confirm" class="input-field" placeholder="Confirmer MDP">
            <input type="checkbox" class="check-box" name="cgu"><span class="valideCGUfiche">J'accepte <a href="cgu">les conditions générales d'utilisation</a></span>
            <button type="submit" class="submit-btn" name="register">Valider</button>
        </form>
    </div>
</div>
    <?php endif;?>
    </div>  
    

<div class="portfolio-lightboxes">

<div class="portfolio-lightbox" id="portfolio-item-0">
  <div class="portfolio-lightbox__content">
    <a href="#" class="close_lightbox"></a>
    <a href="#portfolio-item-1" class="next"></a>
    <a href="#portfolio-item-2" class="prev"></a>
    <img  src="/data/<?= $photo['photo1']?>">
  </div>
</div>

<div class="portfolio-lightbox" id="portfolio-item-1">
  <div class="portfolio-lightbox__content">
    <a href="#" class="close_lightbox"></a>
    <a href="#portfolio-item-2" class="next"></a>
    <a href="#portfolio-item-1" class="prev"></a>
    <img  src="/data/<?= $photo['photo2']?>">
  </div>
</div>

<div class="portfolio-lightbox" id="portfolio-item-2">
  <div class="portfolio-lightbox__content">
    <a href="#" class="close_lightbox"></a>
    <a href="#portfolio-item-0" class="next"></a>
    <a href="#portfolio-item-1" class="prev"></a>
    <img  src="/data/<?= $photo['photo3']?>">
  </div>
</div>

</div>

<script>
  //Notification like si pas connecté
$(document).ready(function(){
   $('.noUser').click(function(){
      $('body').append('<div id="toats" class="notif alert-danger" onload="killToats()"></div>');    
         $('#toats').append('<div class="toats_headers"></div>');
            $('.toats_headers').append(' <a class="toats_die"></a>');
               $('.toats_die').append('<i class="icon ion-md-close"></i>');
               $('.toats_header').append('<h5><i class="fas fa-exclamation-circle"></i> Notification :</h5>');
            $('#toats').append('<div class="toats_core"></div> ')
               $('.toats_core').append('<p>merci de vous connecter pour liker cette annonce.</p>')
   });

});
</script>
<?php if(getMembre() == null) :?>
  <script type="text/javascript" src="/assets/js/login.js"></script>
<?php endif;?>
<?php
include __DIR__.'/assets/includes/cookie.php';
include __DIR__.'/assets/includes/footer_fiche.php';
?>