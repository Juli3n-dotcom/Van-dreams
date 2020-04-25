<?php
require_once __DIR__ . '/assets/config/bootstrap.php';
require_once __DIR__ . '/assets/functions/register.php';

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
  
      unset($membre['password']);
      $_SESSION['membre']=$membre;
      ajouterFlash('success','Bonjour '.getMembre()['prenom']);
      session_write_close();
      header('Location: user/profil.php');
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
        $req->bindValue(':statut',1);
        $req->bindValue(':cgu',1);
        $req->bindValue(':date',(new DateTime())->format('Y-m-d H:i:s'));
        $req->bindValue(':confirmation',0);
        $req->bindParam(':token',bin2hex(random_bytes(16)));
        $req->bindParam(':ip',$ip);
        $req->execute();

        unset($_POST);
        ajouterFlash('success','Welcome!');
        session_write_close();
        header('location:login2.php#login');
    }
}
  
$page_title ='connexion';
include __DIR__.'/assets/includes/header.php';
?>

<?php include __DIR__.'/assets/includes/flash.php';?>

<div class="hero_login">
    <div class="form-box">
        <div class="button-box">
            <div id="btn"></div>
            <button type="button" class="toggle-btn"  id="login_btn">Connexion</button>
            <button type="button" class="toggle-btn"  id="register_btn">Inscription</button>
        </div>
        <form action="login.php" method="POST" class="input-group" id="login">
        <div class="logo"></div>
            <input type="email" class="input-field" name="identifiant" placeholder="Votre adresse email">
            <input type="password" class="input-field" name="password_login" placeholder="Votre mot de passe">
            <input type="checkbox" class="check-box"><span>Se souvenir de moi</span>
            <button type="submit" class="submit-btn" name="login">Connexion</button>
        </form>
        <form action="login.php" method="POST" class="input-group" id="register">
            <input type="text" name="name" class="input-field" placeholder="Votre Nom" value="<?= $_POST['name'] ?? '' ?>">
            <input type="text" name="first_name" class="input-field" placeholder="Votre Prénom" value="<?= $_POST['first_name'] ?? '' ?>">
            <input type="email" name="email" class="input-field" placeholder="Email" value="<?= $_POST['email'] ?? '' ?>">
            <input type="password" name="password" class="input-field" placeholder="Mot de passe">
            <input type="password" name="confirm" class="input-field" placeholder="Confirmer MDP">
            <input type="checkbox" class="check-box" name="cgu"><span>J'accepte <a href="cgu.php">les conditions générales d'utilisation</a></span>
            <button type="submit" class="submit-btn" name="register">Valider</button>
        </form>
    </div>
</div>

<script>
    
</script>

<?php
include __DIR__.'/assets/includes/footer.php';
?>