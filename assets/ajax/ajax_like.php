<?php 
require_once __DIR__ . '/../config/bootstrap.php';

$annonce = $_POST['idannonce'];
$user = $_POST['iduser'];

$req = $pdo->exec(
    "INSERT INTO favoris(membre_id, annonce_id, est_favori)
    VALUES ('$user', '$annonce', 1)
    ");


// ajouterFlash('success','Annonce sauvegardée');

$favori = $pdo->lastInsertId();

// $resultat = '';
// $resultat .= '<div id="toats" class="notif alert-success" onload="killToats()">';
//     $resultat .= '<div class="toats_headers">';
//         $resultat .= '<a class="toats_die">';
//             $resultat .= ' <i class="icon ion-md-close"></i>';
//         $resultat .= '</a>';
//         $resultat .= '<h5><i class="fas fa-exclamation-circle"></i> Notification :</h5>';
//     $resultat .= '</div>';
// $resultat .= '<div class="toats_core">';
// $resultat .= '<p>Annonce sauvegardée</p>';
// $resultat .= '</div>';
// $resultat .= '</div>';

$resultat .= '<form method="POST">';
    $resultat .= ' <input type="hidden" name="idSupr" value="'.$favori.'">';
    $resultat .= ' <button type="submit" class="removefavori" id="removeFavori" name="removeFavori"><i class="fas fa-heart"></i></button>';
$resultat .= '</form>';

$tableau['resultat'] = $resultat;

echo json_encode($tableau);