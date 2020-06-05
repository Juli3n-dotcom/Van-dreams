<?php
require_once __DIR__ . '/../config/bootstrap.php';

$favori = $_POST['idSupr'];

$req = $pdo->exec("DELETE FROM favoris WHERE id_favori = '$favori'");

ajouterFlash('success','Annonce retirée de vos favoris');

$resultat = '';
$resultat .= '<form action="" method="POST">';
    $resultat .= '<input type="hidden" name="iduser" id="iduser" value="'.$Membre["id_membre"].'">';
    $resultat .= '<input type="hidden" name="idannonce" id="idannonce" value="'.$Annonce["id_annonce"].'">';
    $resultat .= '<button type="submit" class="favoris" id="addFavori" name="addFavori"><i class="far fa-heart"></i></button>';
$resultat .= '</form>';

$tableau['resultat'] = $resultat;

echo json_encode($tableau);