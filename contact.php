<?php
require_once __DIR__ . '/assets/config/bootstrap.php';

if(isset($_POST['envoyer'])){

    if($_POST['email'] == NULL){
        ajouterFlash('danger','merci de renseigner votre email.');

    }elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
   ajouterFlash('danger','email non valide.');

   }elseif (empty($_POST['message'])) {
   ajouterFlash('danger','il manque votre message.');

   }else{

    $name = 'nMsg'.bin2hex(random_bytes(6));
       $req = $pdo->prepare(
           'INSERT INTO message_admin (email, name, subject, message, est_lu, date_enregistrement)
           VALUES (:email, :name, :subject, :message, :lu, :date);'
       );
       $req->bindParam(':email', $_POST['email']);
       $req->bindParam(':name',$name);
       $req->bindParam(':subject', $_POST['subject']);
       $req->bindParam(':message', $_POST['message']);
       $req->BindValue(':lu',0);
       $req->bindValue(':date',(new DateTime())->format('Y-m-d H:i:s'));
       $req->execute();

   }
   unset($_POST);
    ajouterFlash('success','merci pour votre message');
} 

$page_title ='Contacter-nous';
include __DIR__.'/assets/includes/header.php';
?>

<?php include __DIR__.'/assets/includes/flash.php';?>


<div class="hero_contact">
    <div class="form-box_contact">
        <h3>Contacter-nous</h3>
        <form action="" method="POST" class="input-group" id="login">
        <div class="logo"></div>
            <input type="email" class="input-field" name="email" placeholder="Votre adresse email" value="<?= htmlspecialchars($_POST['email']??'');?>">
            <input type="text" class="input-field" name="subject" placeholder="Le suject de votre message" value="<?= htmlspecialchars($_POST['subject']??'');?>">
            <textarea class="input-field" name="message" cols="40" rows="18" placeholder="Votre message" 
            value="<?= htmlspecialchars($_POST['message']??'');?>"></textarea> 
            <button type="submit" class="submit-btn_contact" name="envoyer">Envoyer</button>
        </form>     
    </div>
</div>

<?php
include __DIR__.'/assets/includes/footer.php';
?>