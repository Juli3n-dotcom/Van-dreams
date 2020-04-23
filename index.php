<?php
require_once __DIR__ . '/assets/config/bootstrap.php';
require_once __DIR__ . '/assets/functions/register.php';

$success = null;
$error = null;

if (isset($_POST['register'])){

  if(getEmailsBy($pdo, 'email', $_POST['email'])!==null) {
    $error = "Vous etes déjà inscrit";

  }elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
   $error = "Votre email n'est pas valide";
        
    }else{

        $ip = getIp();
        
        $req = $pdo->prepare(
            'INSERT INTO liste_newsletter (email, user_ip, date_enregistrement)
            VALUES (:email, :user_ip, :date)'
        );

        $req->bindParam(':email',$_POST['email']);
        $req->bindParam(':user_ip',$ip);
        $req->bindValue(':date',(new DateTime())->format('Y-m-d H:i:s'));
        $req->execute();

        unset($_POST);
        $success = 'Inscription validée, a bientot';
    }
}

$page_title ='Accueil';
include __DIR__.'/assets/includes/header.php';
?>

<?php include __DIR__.'/assets/includes/flash.php';?>


    <div class="page">
      <div class="countdown-col col">
        <div class="time middle">
          <span>
            <div id="d">12</div>
            Jours
          </span>
          <span>
            <div id="h">06</div>
            Heures
          </span>
          <span>
            <div id="m">35</div>
            Minutes
          </span>
          <span>
            <div id="s">54</div>
            Secondes
          </span>
        </div>
      </div>
      <div class="newsletter-col col">
     
      <div class="validator">
          <?php if($success): ?>
            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<lottie-player src="https://assets5.lottiefiles.com/packages/lf20_ld8FMO.json"  background="transparent"  speed=".8"  style="width: 200px; height: 200px;"    autoplay></lottie-player>
            <p><?= $success;?></p>
          <?php endif;?>
          <?php if($error): ?>
            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<lottie-player src="https://assets5.lottiefiles.com/packages/lf20_j4Wts4.json"  background="transparent"  speed="1"  style="width: 100px; height: 100px;"  loop  autoplay></lottie-player>
            <p><?= $error;?></p>
          <?php endif;?>
          </div>

        <div class="newsletter middle">
          
          <h2>Nous arrivons bientôt</h2>
          <h4>Abonnez-vous pour recevoir une notification lors de l'ouverture du site</h4>
          <form action="index.php" method="POST">
            <input type="text" name="email" placeholder="Enter votre email">
            <input class="newsletter-btn" type="submit" name="register" value="S'inscrire">
          </form>
        </div>
      </div>
    </div>

<?php
include __DIR__.'/assets/includes/footer.php';
?>