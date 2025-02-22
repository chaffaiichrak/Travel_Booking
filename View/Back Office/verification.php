<?php
require_once __DIR__ . '/../../Model/TravelOffer.php';
require_once __DIR__ . '/../../Controller/TravelOfferController.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération des données du formulaire
    $title = $_POST["title"];
    $destination = $_POST["destination"];
    $date_depart = new DateTime($_POST["departure_date"]);
    $date_retour = new DateTime($_POST["return_date"]);
    $prix = (float) $_POST["price"];
    $disponible = isset($_POST["disponible"]) ? 1 : 0; // Vérifie si la case est cochée
    $categorie = $_POST["category"];

    // Création de l'objet offre
    $offre1 = new OfferDeVoyage( $title, $destination, $date_depart, $date_retour, $prix, $disponible, $categorie);

    // Affichage avec var_dump
    echo "<h2>Affichage avec var_dump:</h2>";
    echo "<pre>";
    var_dump($offre1);
    echo "</pre>";

    // Utilisation du contrôleur pour afficher l'offre
    $controller = new TravelOfferController();
    echo "<h2>Affichage avec showTravelOffer:</h2>";
    $controller->showTravelOffer($offre1);
} else {
    echo "Accès interdit.";
}
?>
