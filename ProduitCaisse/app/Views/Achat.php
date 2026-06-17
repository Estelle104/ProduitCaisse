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
            <span class="navbar-brand mb-0 h1">🛒 Supermarché SI-IHM</span>
            <span class="badge bg-success fs-5">Caisse active : N° <?= session()->get('id_caisse') ?? 'Non définie' ?></span>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <div class="card shadow-sm p-4 mb-4">
                    <h4 class="mb-3">Saisie des achats</h4>
                    
                    <form action="<?= base_url('achat/ajouter') ?>" method="POST" class="row g-3 align-items-end">
                        <div class="col-md-6">
                            <label for="produit" class="form-label fw-bold">Produit</label>
                            <select class="form-select" id="produit" name="id_produit" required>
                                <option value="" selected disabled>Choisir un produit...</option>
                                <option value="1">Biscuit (1000 MGA)</option>
                                <option value="2">Pain (400 MGA)</option>
                            </select>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="quantite" class="form-label fw-bold">Quantité</label>
                            <input type="number" class="form-control" id="quantite" name="quantite" min="1" value="1" required>
                        </div>
                        
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary w-100">Valider</button>
                        </div>
                    </form>
                </div>

                <div class="card shadow-sm p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="m-0">Panier du Client</h4>
                        <a href="<?= base_url('achat/cloturer') ?>" class="btn btn-danger btn-sm"><<< Clôturer achat >>></a>
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
                                <tr>
                                    <td>Biscuit</td>
                                    <td class="text-end">1000</td>
                                    <td class="text-center">12</td>
                                    <td class="text-end fw-bold">12000</td>
                                </tr>
                                <tr>
                                    <td>Pain</td>
                                    <td class="text-end">400</td>
                                    <td class="text-center">2</td>
                                    <td class="text-end fw-bold">800</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="table-dark">
                                    <td colspan="3" class="text-end fw-bold">Total</td>
                                    <td class="text-end fw-bold fs-5">12800</td>
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