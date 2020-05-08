<?php

require_once __DIR__ . '/assets/config/bootstrap.php';

if(isset($_GET['email'],$_GET['token'])AND !empty($_GET['email']) AND !empty($_GET['token'])){

    $email = htmlspecialchars(urldecode($_GET['email']));
    $token = htmlspecialchars($_GET['token']);
    $req = $pdo->prepare("SELECT * FROM membre WHERE email = ? AND confirmKey = ?");
    $req -> execute(array($pseudo, $token));

}

?>