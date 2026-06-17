<?php 
    $caisse = $caisses ?? [];
    $client_id = session()->get('client_id') ?? null;

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supermarché - Choisir Caisse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
            <h3 class="card-title text-center mb-4">Caisse d'un supermarché</h3>
            
            <form action="<?= base_url('client/caisse/choixCaisse') ?>" method="POST">
                
                <div class="mb-3">
                    <label for="caisse" class="form-label fw-bold">Choisir Caisse</label>
                    <select class="form-select form-select-lg" id="caisse" name="id_caisse" required>
                        <option value="" selected disabled>-- Sélectionner une caisse --</option>
                        <?php foreach ($caisse as $c): ?>
                            <option value="<?= $c['id'] ?>"><?= $c['numero_caisse'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary btn-lg w-100">Choisir Caisse</button>
            </form>

        </div>
    </div>

</body>
</html>