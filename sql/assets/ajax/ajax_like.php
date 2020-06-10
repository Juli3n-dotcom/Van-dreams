<?php 
require_once __DIR__ . '/../config/bootstrap.php';

$annonce = $_POST['idannonce'];
$user = $_POST['iduser'];

$req = $pdo->exec(
    "INSERT INTO favoris(membre_id, annonce_id, est_favori)
    VALUES ('$user', '$annonce', 1)
    ");


ajouterFlash('success','Annonce sauvegardée');

$favori = $pdo->lastInsertId();

$resultat = '';
$resultat .= '<div class="like">';
$resultat .= '<form method="POST">';
    $resultat .= ' <input type="hidden" name="idSupr" value="'.$favori.'">';
    $resultat .= ' <button type="submit" class="removefavori" id="removeFavori" name="removeFavori"><i class="fas fa-heart"></i></button>';
$resultat .= '</form>';
$resultat .= '</div>';

$tableau['resultat'] = $resultat;

echo json_encode($tableau);