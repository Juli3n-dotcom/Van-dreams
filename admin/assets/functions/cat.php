<?php
// récupération des catégories
      function getCategorie(PDO $pdo):array
      {
        $req=$pdo->query(
          'SELECT *
          FROM category
        ');
       $cat = $req->fetchAll(PDO::FETCH_ASSOC);
      return $cat;
      }