<?php
class OfferDeVoyage {

    private int $id;
    private string $titre;
    private string $destination;
    private DateTime $date_depart;
    private DateTime $date_retour;
    private float $prix;
    private bool $disponible;
    private string $categorie;

    // Constructeur paramétré
    public function __construct(
        //int $id,
        string $titre,
        string $destination,
        DateTime $date_depart,
        DateTime $date_retour,
        float $prix,
        bool $disponible,
        string $categorie
    ) {
        //$this->id = $id;
        $this->titre = $titre;
        $this->destination = $destination;
        $this->date_depart = $date_depart;
        $this->date_retour = $date_retour;
        $this->prix = $prix;
        $this->disponible = $disponible;
        $this->categorie = $categorie;
    }

    // Méthode show() pour afficher les informations sous forme de tableau HTML
    public function show(): void {
        echo "<table border='1'>
                <tr>
                   
                    <th>Title</th>
                    <th>Destination</th>
                    <th>Departure Date</th>
                    <th>Return Date</th>
                    <th>Price</th>
                    <th>Disponible</th>
                    <th>Category</th>
                </tr>
                <tr>
                    
                    <td>{$this->titre}</td>
                    <td>{$this->destination}</td>
                    <td>{$this->date_depart->format('Y-m-d')}</td>
                    <td>{$this->date_retour->format('Y-m-d')}</td>
                    <td>{$this->prix}</td>
                    <td>" . ($this->disponible ? '1' : '0') . "</td>
                    <td>{$this->categorie}</td>
                </tr>
              </table>";
    }
// Getters
public function getTitle() {
    return $this->title;
}

public function getDestination() {
    return $this->destination;
}

public function getDepartureDate() {
    return $this->departure_date;
}

public function getReturnDate() {
    return $this->return_date;
}

public function getPrice() {
    return $this->price;
}

public function isDisponible() {
    return $this->disponible;
}

public function getCategory() {
    return $this->category;
}

// Setters
public function setTitle($title) {
    $this->title = $title;
}

public function setDestination($destination) {
    $this->destination = $destination;
}

public function setDepartureDate($departure_date) {
    $this->departure_date = $departure_date;
}

public function setReturnDate($return_date) {
    $this->return_date = $return_date;
}

public function setPrice($price) {
    $this->price = $price;
}

public function setDisponible($disponible) {
    $this->disponible = $disponible;
}

public function setCategory($category) {
    $this->category = $category;
}
}

?>
