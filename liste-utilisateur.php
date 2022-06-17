<?php

include("headers.php");
include("connexion.php");

$requete = $connexion->prepare("SELECT * FROM utilisateur");

$requete->execute();

$listeUtilisateur = $requete->fetchAll();

echo json_encode($listeUtilisateur);