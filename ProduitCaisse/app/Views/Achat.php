<?php
$Produits = $listeProduits ?? [];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Achats</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container-fluid d-flex justify-content-between">
            <span class="navbar-brand mb-0 h1"> Supermarché SI-IHM</span>
            <span class="badge bg-success fs-5">Caisse active : N° <?= session()->get('id_caisse') ?? 'Non définie' ?></span>
            <span class="navbar-text">
                <a href="<?= base_url('logout') ?>" class="btn btn-outline-light btn-sm">Déconnexion</a>
            </span>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-sm p-4 mb-4">
                    <h4 class="mb-3">Saisie des achats</h4>

                    <form action="<?= base_url('client/achat/ajouter') ?>" method="POST" class="row g-3 align-items-end">
                        <div class="col-md-6">
                            <label for="produit" class="form-label fw-bold">Produit</label>
                            <select class="form-select" id="produit" name="id_produit" required>
                                <option value="" selected disabled>Choisir un produit...</option>
                                <?php foreach ($Produits as $produit): ?>
                                    <option value="<?= $produit['id'] ?>"><?= $produit['designation'] ?> (<?= $produit['prix_unitaire'] ?> MGA)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="quantite" class="form-label fw-bold">Quantité</label>
                            <input type="number" class="form-control" id="quantite" name="quantite" min="1" value="1" required>
                        </div>

                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary w-100" onclick="envoyerFormulaire(event)">Ajouter produit</button>
                        </div>
                    </form>
                </div>

                <div class="card shadow-sm p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="m-0">Produits du Client</h4>
                        <a href="<?= base_url('client/achat/cloturer') ?>" class="btn btn-danger btn-sm" onclick="cloturerAchat(event)">
                            <<< Clôturer achat>>>
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-secondary">
                                <tr>
                                    <th>Produit</th>
                                    <th class="text-end">Prix Unit</th>
                                    <th class="text-center">Qté</th>
                                    <th class="text-end">Montant</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($panier)): ?>
                                    <?php foreach ($panier as $ligne): ?>
                                        <tr>
                                            <td><?= esc($ligne['designation']) ?></td>
                                            <td class="text-end"><?= number_format($ligne['prix_unitaire'], 0, ',', ' ') ?></td>
                                            <td class="text-center"><?= $ligne['quantite'] ?></td>
                                            <td class="text-end fw-bold"><?= $ligne['somme_produit'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Le panier est vide pour ce client.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr class="table-dark">
                                    <td colspan="3" class="text-end fw-bold">Total</td>
                                    <td class="text-end fw-bold fs-5">0 MGA</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>

<script>
    // Se déclenche automatiquement au chargement du document
    document.addEventListener("DOMContentLoaded", function() {
        updateTotal();
    });

    function updateTotal() {
        let total = 0;
        document.querySelectorAll('tbody tr').forEach(row => {
            if (row.cells.length >= 4) {
                // Extraction propre des chiffres uniquement
                const text = row.cells[3].textContent.replace(/[^0-9]/g, "");
                const montant = parseFloat(text) || 0;
                total += montant;
            }
        });
        document.querySelector('tfoot tr td:last-child').textContent = total.toLocaleString() + ' MGA';
    }

    function validationAchat() {
        const quantiteInput = document.getElementById('quantite').value;
        const quantite = parseInt(quantiteInput);
        const produitSelect = document.getElementById('produit').value;

        if (!produitSelect) {
            alert('Veuillez sélectionner un produit.');
            return false;
        }
        if (isNaN(quantite) || quantite <= 0) {
            alert('La quantité doit être supérieure à zéro.');
            return false;
        }
        return true;
    }

    function confirmerCloture() {
        return confirm('Êtes-vous sûr de vouloir clôturer cet achat ?');
    }

    function envoyerFormulaire(event) {
        if (!validationAchat()) {
            event.preventDefault(); // Bloque la soumission du formulaire si invalide
        }
    }

    function cloturerAchat(event) {
        if (!confirmerCloture()) {
            event.preventDefault(); // Bloque la redirection vers l'URL si "Annuler"
        }
    }
</script>