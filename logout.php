<?php
setcookie('token','',time()-3600);
require_once __DIR__ . '/assets/config/bootstrap.php';
unset($_SESSION['membre']);
ajouterFlash('success','Vous avez bien été déconnecté');
header('Location: index.php');

