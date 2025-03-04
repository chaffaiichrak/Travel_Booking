<?php
require_once '../Controller/TravelOfferController.php'; // Inclure le contrôleur

$controller = new TravelOfferController(); // Assurez-vous que le nom de la variable est cohérent

// Vérification de la méthode de suppression
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $controller->deleteOffer($_POST['delete_id']); // Corrigé : utilisation de $controller au lieu de $Controller
    header("Location: listOffer.php"); // Redirection après suppression
    exit();
}

$offers = $controller->listOffers();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offres de Voyage</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        table { width: 80%; margin: auto; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 10px; text-align: center; }
        th { background-color: #f4f4f4; }
        .btn { display: block; margin: 20px auto; padding: 10px 15px; text-decoration: none; background-color: blue; color: white; border-radius: 5px; }
        .btn-delete { background-color: red; }
        .btn-update { background-color: orange; }
        .btn-add { background-color: green; }
    </style>
</head>
<body>

    <h2>Liste des Offres de Voyage</h2>

    <!-- Bouton Ajouter une offre -->
    <a href="../View/Back Office/addTravelOffer.php" class="btn btn-add">Ajouter une Offre</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Destination</th>
            <th>Prix (€)</th>
            <th>Date Départ</th>
            <th>Date Retour</th>
            <th>Disponible</th>
            <th>Catégorie</th>
            <th>Actions</th> <!-- Colonne d'actions -->
        </tr>
        
        <?php if (!empty($offers)): ?>
            <?php foreach ($offers as $offer): ?>
            <tr>
                <td><?= htmlspecialchars($offer['id']) ?></td>
                <td><?= htmlspecialchars($offer['titre']) ?></td>
                <td><?= htmlspecialchars($offer['destination']) ?></td>
                <td><?= htmlspecialchars($offer['prix']) ?> €</td>
                <td><?= htmlspecialchars($offer['date_depart']) ?></td>
                <td><?= htmlspecialchars($offer['date_retour']) ?></td>
                <td><?= htmlspecialchars($offer['disponible']) ?></td>
                <td><?= htmlspecialchars($offer['categorie']) ?></td>
                <td>
                    <!-- Bouton de modification -->
                    <a href="../View/Back Office/updateOffer.php?id=<?= $offer['id'] ?>" class="btn btn-update">Modifier</a>
                    
                    <!-- Formulaire de suppression -->
                    <form method="POST" action="">
                        <input type="hidden" name="delete_id" value="<?= $offer['id']; ?>">
                        <button type="submit" class="btn btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette offre ?');">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="9">Aucune offre disponible.</td></tr>
        <?php endif; ?>
    </table>

    <!-- Lien vers le BackOffice et le FrontOffice -->
    <a href="../backOffice/listOffers.php" class="btn">Accès Administrateur</a>
    <a href="../frontOffice/listOffers.php" class="btn">Voir en tant que visiteur</a>

</body>
</html>
