<?php
require_once __DIR__ . '/../config.php';

class TravelOfferController
{
    public function listOffers()
    {
        try {
            $pdo = config::getConnexion();
            $sql = "SELECT id, titre, destination, prix, date_depart, date_retour, disponible, categorie FROM TravelOffer";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $offers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $offers;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    // Méthode pour supprimer une offre par son ID
    public function deleteOffer($id)
    {
        $db = config::getConnexion();
        $sql = "DELETE FROM traveloffer WHERE id = :id";
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
            return true;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Méthode pour ajouter une nouvelle offre
    public function addOffer(OfferDeVoyage $travelOffer)
    {
        $db = config::getConnexion();
        $req = "INSERT INTO traveloffer(titre, destination, date_depart, date_retour, prix, disponible, categorie) 
                VALUES(:titre, :destination, :date_depart, :date_retour, :prix, :disponible, :categorie)";
        try {
            $query = $db->prepare($req);
            $query->execute([
                'titre' => $travelOffer->getTitle(),
                'destination' => $travelOffer->getDestination(),
                'date_depart' => $travelOffer->getDepartureDate()->format('Y-m-d'),
                'date_retour' => $travelOffer->getReturnDate()->format('Y-m-d'),
                'prix' => $travelOffer->getPrice(),
                'disponible' => $travelOffer->getDisponibility() ? 1 : 0,
                'categorie' => $travelOffer->getCategory()
            ]);
            return true;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function updateOffer($id, OfferDeVoyage $travelOffer) 
    {
        $db = config::getConnexion();
        $sql = "UPDATE traveloffer SET titre = :titre, destination = :destination, date_depart = :date_depart, date_retour = :date_retour, prix = :prix, disponible = :disponible, categorie = :categorie WHERE id = :id";
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $id,
                'titre' => $travelOffer->getTitle(),
                'destination' => $travelOffer->getDestination(),
                'date_depart' => $travelOffer->getDepartureDate()->format('Y-m-d'),
                'date_retour' => $travelOffer->getReturnDate()->format('Y-m-d'),
                'prix' => $travelOffer->getPrice(),
                'disponible' => $travelOffer->getDisponibility() ? 1 : 0,
                'categorie' => $travelOffer->getCategory()
            ]);
            return true;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}
