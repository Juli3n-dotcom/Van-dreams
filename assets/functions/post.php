<?php

 // récupération des catégories
 function getCategory(PDO $pdo):array
 {
   $req=$pdo->query(
     'SELECT *
     FROM category
   ');
  $cat = $req->fetchAll(PDO::FETCH_ASSOC);
 return $cat;
 }


 // récupération des sous catégories
function getSubCategory(PDO $pdo):array
{
  $req=$pdo->query(
    'SELECT *
    FROM sub_category
  ');
 $subcat = $req->fetchAll(PDO::FETCH_ASSOC);
return $subcat;
}

// récupération des pays
function getCountry(PDO $pdo):array
{
  $req=$pdo->query(
    'SELECT *
    FROM country
  ');
 $country = $req->fetchAll(PDO::FETCH_ASSOC);
return $country;
}

// récupération des régions
function getRegion(PDO $pdo):array
{
$req=$pdo->query(
'SELECT *
FROM region
');
$region = $req->fetchAll(PDO::FETCH_ASSOC);
return $region;
}