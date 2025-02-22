<?php


class TravelOfferController {

    // Méthode pour afficher une offre de voyage
    public function showTravelOffer(OfferDeVoyage $offer) {
        $offer->show();
    }
}
?>
