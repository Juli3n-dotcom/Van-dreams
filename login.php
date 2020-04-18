<?php
require_once __DIR__ . '/assets/config/bootstrap.php';

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
  
      
    }elseif (!password_verify($_POST['password'], $membre['password'])){
        ajouterFlash('danger','Mot de passe erroné!');
  
    }else{
  
      unset($membre['password']);
      $_SESSION['membre']=$membre;
      session_write_close();
      ajouterFlash('success','Bonjour'.getMembre()['pseudo']);
      header('Location: user/profil.php');
    }
  }
  
$page_title ='connexion';
include __DIR__.'/assets/includes/header.php';
?>

<?php include __DIR__.'/assets/includes/flash.php';?>

<form action="login.php" method="POST">
  <div class="login-div">
    <div class="logo"></div>
        <div class="title">Connexion</div>
        <!-- <div class="sub-title">Connexion</div> -->
            <div class="fields">
                <div class="username">
                    <input type="email" name="identifiant" class="user-input" placeholder="Email" value="<?= $_POST['identifiant'] ?? '' ?>">
                </div>
                <div class="password">
                    <input type="password" name="password" class="pass-input" placeholder="Mot de passe" />
                </div>
            </div>
        <button type="submit" class="signin-button" name="login">Login</button>
        <div class="link">
            <a href="#">Mot de passe oublié</a> 
            <a href="register.php">Inscription</a>
      </div>
    </div>
  </form>
    

<?php
include __DIR__.'/assets/includes/footer.php';
?>