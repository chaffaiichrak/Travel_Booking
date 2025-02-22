<?php
// BackOffice/showTravelOffer.php
require_once __DIR__ . '/../../Model/TravelOffer.php';

// Créer une offre de voyage avec DateTime
$Departure Date = new DateTime('2024-10-15');
$date_retour = new DateTime('2024-10-22');

$offre1 = new OfferDeVoyage(
    
    "Discover Paris",
    "ParisFrance",
    $date_depart,
    $date_retour,
    1200.00,
    true,
    "Cultural"
);

// Affichage avec var_dump (optionnel)
var_dump($offre1);

// Affichage avec la méthode show()
$offre1->show();
?>

