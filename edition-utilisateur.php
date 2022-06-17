<?php

include('headers.php');
include('connexion.php');

$json = $_POST['utilisateur'];
$data = json_decode($json);

//TODO empecher la suppression de la photo,
// si l'utilisateur n'en a pas selectionnée.


$nomImage = null;

if (isset($_FILES) && isset($_FILES['image'])) {

    $pathParts = pathinfo($_FILES['image']['name']);

    $nomImage = 'avatar-' . uniqid() . '.' . $pathParts['extension'];

    move_uploaded_file(
        $_FILES['image']['tmp_name'],
        __DIR__ . "/uploads/" . $nomImage
    );
}

//si c'est une création d'utilisateur
if (!isset($data->id) || $data->id == null) {

    $requete = $connexion->prepare(
        "INSERT INTO utilisateur (prenom, nom, image, mot_de_passe)
        VALUES (:prenom, :nom, :image, :mot_de_passe)"
    );

    $requete->execute([
        ":prenom" => $data->prenom,
        ":nom" => $data->nom,
        ":image" => $nomImage,
        ":mot_de_passe" => $data->mot_de_passe
    ]);
} else {

    if ($nomImage) {

        $requete = $connexion->prepare(
            "UPDATE utilisateur 
         SET prenom = :prenom,
             nom = :nom,
             image = :image,
             mot_de_passe = :mot_de_passe
         WHERE id = :id"
        );

        $requete->execute([
            ":prenom" => $data->prenom,
            ":nom" => $data->nom,
            ":image" => $nomImage,
            ":mot_de_passe" => $data->mot_de_passe,
            ":id" => $data->id
        ]);
    } else {
        $requete = $connexion->prepare(
            "UPDATE utilisateur 
             SET prenom = :prenom,
             nom = :nom,
             mot_de_passe = :mot_de_passe
             WHERE id = :id"
        );

        $requete->execute([
            ":prenom" => $data->prenom,
            ":nom" => $data->nom,
            ":mot_de_passe" => $data->mot_de_passe,
            ":id" => $data->id
        ]);
    }
}

// echo json_encode($_FILES);
