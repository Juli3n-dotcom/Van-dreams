<?php
require_once __DIR__ . '/assets/config/bootstrap.php';
unset($_SESSION['membre']);
ajouterFlash('success','Vous avez bien été déconnecté');
header('Location: index.php');

