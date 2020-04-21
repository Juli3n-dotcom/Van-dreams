<?php

require_once __DIR__ . '/assets/config/bootstrap.php';
require '/assets/functions/register.php';

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
        
    }else{

        $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $ip = getIp();
        $name = $_POST['name'].$_POST['first_name'];

        $req = $pdo->prepare(
            'INSERT INTO membre (email, name, password, civilite, nom, prenom, statut, date_enregistrement, confirmation, token, ip)
            VALUES (:email, :name, :password, :civilite, :nom,:prenom, :statut, :date, :confirmation, :token, :ip)'
        );

        $req->bindParam(':email',$_POST['email']);
        $req->bindParam(':name',$name);
        $req->bindParam(':password',$hash);
        $req->bindValue(':civilite',$_POST['civilite']);
        $req->bindParam(':nom',$_POST['name']);
        $req->bindParam(':prenom',$_POST['first_name']);
        $req->bindValue(':statut',1);
        $req->bindValue(':date',(new DateTime())->format('Y-m-d H:i:s'));
        $req->bindValue(':confirmation',0);
        $req->bindParam(':token',bin2hex(random_bytes(16)));
        $req->bindParam(':ip',$ip);
        $req->execute();

        unset($_POST);
        ajouterFlash('success','Welcome!');
        session_write_close();
        header('location:login.php');
    }
}

$page_title ='Inscription';
include __DIR__.'/assets/includes/header.php';
?>


<?php include __DIR__.'/assets/includes/flash.php';?>

<form action="register.php" method="POST">
  <div class="login-div">
    <div class="logo"></div>
        <div class="title">Inscription</div>
            <div class="fields">
                <div class="custom-dropdown custom-dropdown--white">
                    <select class="custom-dropdown__select custom-dropdown__select--white" name="civilite">
                        <option value="">Civilité</option>
                        <option value="<?= FEMME ?>">Mme</option>
                        <option value="<?= HOMME ?>">Mr</option>
                    </select>
                </div>
                <div class="username">
                    <input type="text" name="name" class="user-input" placeholder="Votre Nom" value="<?= $_POST['name'] ?? '' ?>">
                </div>
                <div class="username">
                    <input type="text" name="first_name" class="user-input" placeholder="Votre Prénom" value="<?= $_POST['first_name'] ?? '' ?>">
                </div>
                <div class="email">
                    <input type="email" name="email" class="user-input" placeholder="Email" value="<?= $_POST['email'] ?? '' ?>">
                </div>
                <div class="password">
                    <input type="password" name="password" class="pass-input" placeholder="Mot de passe">
                </div>
                <div class="password">
                    <input type="password" name="confirm" class="pass-input" placeholder="Confirmer MDP">
                </div>
            </div>
        <button type="submit" class="signin-button" name="register">Valider</button>
        
    </div>
  </form>



<?php
include __DIR__.'/assets/includes/footer.php';
?>