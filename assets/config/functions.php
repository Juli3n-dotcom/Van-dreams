<?php

function ajouterFlash(string $type, string $messages) : void
  {
      $_SESSION['flash'][] = [
       'type' => $type,
       'message' => $messages,
];
  }

function recupererFlash ():array{

$messages = $_SESSION['flash'] ??[];

unset($_SESSION['flash']);

    return $messages;
  }

// vérification si utilisateur est connecté
  function getMembre() :?array
  {
   return $_SESSION['membre'] ?? null;
  }

//vérification du ROLE de l'utilisateur
   function role(int $role): bool
   {
    
      if (getMembre() === null){
        
        return false;
      } 
    
        return getMembre()['statut'] == $role;
           
   }
  

   function getMembreBy(PDO $pdo, string $colonne, $valeur): ?array
     {
       $req =$pdo->prepare(sprintf(
       'SELECT *
       FROM membre
       WHERE %s = :valeur',
       $colonne
       ));
    
     $req->bindParam(':valeur', $valeur);
     $req->execute();

     $utilisateur =$req->fetch(PDO::FETCH_ASSOC);
     return $utilisateur ?: null;
      }