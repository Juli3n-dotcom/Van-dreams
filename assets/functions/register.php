<?php
//récupération de l'IP
function getIp(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
      $ip = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    }
    return $ip;
  }


  function getEmailsBy(PDO $pdo, string $colonne, $valeur): ?array
     {
       $req =$pdo->prepare(sprintf(
       'SELECT *
       FROM liste_newsletter
       WHERE %s = :valeur',
       $colonne
       ));
    
     $req->bindParam(':valeur', $valeur);
     $req->execute();

     $utilisateur =$req->fetch(PDO::FETCH_ASSOC);
     return $utilisateur ?: null;
      }
