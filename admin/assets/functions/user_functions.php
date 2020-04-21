<?php 
// récupération des membres
function getUser(PDO $pdo):array
{
  $req=$pdo->query(
    'SELECT *
    FROM membre
  ');
 $Membre = $req->fetchAll(PDO::FETCH_ASSOC);
return $Membre;
}

