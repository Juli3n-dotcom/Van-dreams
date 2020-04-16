<?php

if(isset($_POST['login'])){
   
    $req = $pdo->prepare(
      'SELECT * 
      FROM membre
      WHERE
      pseudo = :pseudo
      OR email = :email'
    );
    $req->bindParam(':pseudo',$_POST['identifiant']);
    $req->bindParam(':email',$_POST['identifiant']);
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
      header('Location: index.php');
    }
  }
  
  
  //Déconnexion
  if(isset($_GET['logout'])){
    unset($_SESSION['membre']);
    ajouterFlash('success','Vous avez bien été déconnecté');
  }

$page_title ='connexion';
include __DIR__.'/assets/includes/header.php';
?>


<div class="login-div">
    <div class="logo"></div>
        <div class="title">Van Dreams</div>
        <div class="sub-title">Connexion</div>
            <div class="fields">
                <div class="username">
                    <input type="username" name="identifiant" class="user-input" placeholder="Pseudo ou email" />
                </div>
                <div class="password">
                    <input type="password" name="password" class="pass-input" placeholder="password" />
                </div>
            </div>
        <button class="signin-button" name="login">Login</button>
        <div class="link">
            <a href="#">Mot de passe oublié</a> 
            <a href="register.php">Inscription</a>
        </div>
    </div>




<?php
include __DIR__.'/assets/includes/footer.php';
?>