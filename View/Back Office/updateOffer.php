<?php
require_once '../../Controller/TravelOfferController.php'; // Inclure le contrôleu
require_once '../../Model/TravelOffer.php';

if (!isset($_GET['id'])) {
    die('ID de l\'offre de voyage manquant.');
}

$id = $_GET['id'];
$travelOfferController = new TravelOfferController();
$offers = $travelOfferController->listOffers();

$travelOfferData = null;
foreach ($offers as $offer) {
    if ($offer['id'] == $id) {
        $travelOfferData = $offer;
        break;
    }
}

if (!$travelOfferData) {
    die('Offre de voyage non trouvée.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updatedOffer = new OfferDeVoyage(
        $_POST['titre'],
        $_POST['destination'],
        $_POST['date_depart'],
        $_POST['date_retour'],
        $_POST['prix'],
        isset($_POST['disponible']) ? true : false,
        $_POST['categorie']
    );

    $travelOfferController->updateOffer($id, $updatedOffer);
    header("Location: ../View/Back Office/listoffer.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Update Travel Offer - Dashboard</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom CSS for table styling -->
    <style>
        /* Design amélioré du tableau */
        .table-custom {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .table-custom th, .table-custom td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table-custom th {
            background-color: #4e73df;
            color: white;
        }

        .table-custom tr:hover {
            background-color: #f1f1f1;
        }

        .table-custom .status-available {
            color: green;
            font-weight: bold;
        }

        .table-custom .status-unavailable {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text mx-3">Travel Booking</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                </nav>

                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Update Travel Offer</h1>
                    </div>

                    <div class="row">
                        <div class="col-xl-8 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <form id="updateTravelOfferForm" action="updateOffer.php?id=<?php echo $id; ?>" method="POST">
                                            <label for="titre">Titre:</label><br>
                                            <input class="form-control form-control-user" type="text" name="titre" value="<?php echo htmlspecialchars($travelOfferData['titre']); ?>" required><br>
                                            
                                            <label for="destination">Destination:</label><br>
                                            <input class="form-control form-control-user" type="text" name="destination" value="<?php echo htmlspecialchars($travelOfferData['destination']); ?>" required><br>

                                            <label for="date_depart">Date départ:</label><br>
                                            <input class="form-control form-control-user" type="date" name="date_depart" value="<?php echo htmlspecialchars($travelOfferData['date_depart']); ?>" required><br>

                                            <label for="date_retour">Date retour:</label><br>
                                            <input class="form-control form-control-user" type="date" name="date_retour" value="<?php echo htmlspecialchars($travelOfferData['date_retour']); ?>" required><br>

                                            <label for="prix">Prix:</label><br>
                                            <input class="form-control form-control-user" type="number" name="prix" value="<?php echo htmlspecialchars($travelOfferData['prix']); ?>" required><br>

                                            <div class="forms-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck" name="disponible" <?php echo $travelOfferData['disponible'] ? 'checked' : ''; ?>>
                                                    <label class="custom-control-label" for="customCheck">Disponibilité</label>
                                                </div>
                                            </div>
                                            
                                            <label for="categorie">Catégorie:</label><br>
                                            <select class="form-control form-control-user" id="categorie" name="categorie" required>
                                                <option value="adventure" <?php echo $travelOfferData['categorie'] == 'adventure' ? 'selected' : ''; ?>>Adventure</option>
                                                <option value="relaxation" <?php echo $travelOfferData['categorie'] == 'relaxation' ? 'selected' : ''; ?>>Relaxation</option>
                                                <option value="culture" <?php echo $travelOfferData['categorie'] == 'culture' ? 'selected' : ''; ?>>Culture</option>
                                            </select><br>
                                            
                                            <button type="submit" class="btn btn-primary btn-user btn-block">Update Offer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <h5 class="card-title">List of Offers</h5>
                                    <table class="table-custom">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Titre</th>
                                                <th>Destination</th>
                                                <th>Date départ</th>
                                                <th>Date retour</th>
                                                <th>Prix</th>
                                                <th>Disponibilité</th>
                                                <th>Catégorie</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($offers as $offer): ?>
                                                <tr>
                                                    <td><?php echo $offer['id']; ?></td>
                                                    <td><?php echo htmlspecialchars($offer['titre']); ?></td>
                                                    <td><?php echo htmlspecialchars($offer['destination']); ?></td>
                                                    <td><?php echo htmlspecialchars($offer['date_depart']); ?></td>
                                                    <td><?php echo htmlspecialchars($offer['date_retour']); ?></td>
                                                    <td><?php echo htmlspecialchars($offer['prix']); ?> €</td>
                                                    <td class="<?php echo $offer['disponible'] ? 'status-available' : 'status-unavailable'; ?>">
                                                        <?php echo $offer['disponible'] ? 'Disponible' : 'Indisponible'; ?>
                                                    </td>
                                                    <td><?php echo htmlspecialchars($offer['categorie']); ?></td>
                                                    <td>
                                                        <a href="updateOffer.php?id=<?php echo $offer['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                                                        <a href="deleteOffer.php?id=<?php echo $offer['id']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Travel Booking 2025</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
</body>
</html>
