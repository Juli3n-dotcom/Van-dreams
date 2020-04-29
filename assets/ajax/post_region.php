<?php
require_once __DIR__ . '/../config/bootstrap.php';
require __DIR__ . '/../functions/post.php';

if(isset($_POST['id'])){
    $req = $pdo->prepare("SELECT * FROM region WHERE country_id=".$_POST['id']);
    $req -> execute();
    $regions = $req -> fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($regions);
}
// $id = json_encode($_POST['id_country']);
// echo $id;
// $resultat = $pdo->prepare(
//     "SELECT *
//     FROM region
//     WHERE country_id ='$id'"
// );
// // $resultat->bindValue(':id',$_POST['id']);
// $resultat->execute();

// $affichage_region ='<select name="region" class="custom-dropdown">';
// $affichage_region .='<option selected>Choisir...';
// $affichage_region .='</option>';
//     foreach($resultat as $key => $region){
//         $affichage_region .= '<option value="'.$region['id_region'].'">'.$region['name'].'</option>';
//     }
// $affichage_region .='</select>';

// $valeur_retour['resultat'] = $affichage_region;
// echo json_encode($valeur_retour);
// ?>

