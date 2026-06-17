<?php

namespace App\Controllers;

use App\Models\Achat;
use App\Models\AchatProduit;
use App\Models\Produit;

class AchatController extends BaseController
{
    public function ajouter()
    {
        // 1. Initialisation des modèles
        $achatModel = new Achat();
        $achatProduitModel = new AchatProduit();
        $produitModel = new Produit();

        // 2. Récupération des données du formulaire et de la session
        $idCaisse = session()->get('id_caisse');
        // $idClient = session()->get('client_id'); // Optionnel, si ton login est actif
        $idProduit = $this->request->getPost('id_produit');
        $quantite = $this->request->getPost('quantite');

        // 3. Récupération du produit pour avoir le prix unitaire et vérifier le stock
        $produit = $produitModel->find($idProduit);
        if (!$produit) {
            return redirect()->back()->with('error', 'Produit introuvable.');
        }

        if ($quantite > $produit['quantite_restant']) {
            return redirect()->back()->with('error', 'Quantité en stock insuffisante.');
        }

        $prixUnitaire = $produit['prix_unitaire'];
        $sommeProduit = $prixUnitaire * $quantite;


            $dataAchat = [
                'id_caisse'   => $idCaisse,
                'somme_total' => 0, // Sera calculé dynamiquement ou incrémenté
                'id_client'   => $idClient ?? null
            ];
            
            $achatModel->insert($dataAchat);
            
            // On récupère le nouvel ID généré par SQLite
            $idAchatEnCours = $achatModel->insertID();
            

        // 5. On insère le produit dans la table de liaison achat_produit
        $dataLigne = [
            'id_achat'      => $idAchatEnCours,
            'id_produit'    => $idProduit,
            'quantite'      => $quantite,
            'somme_produit' => $sommeProduit
        ];
        $achatProduitModel->insert($dataLigne);

        // 6. Mise à jour de la somme_total dans la table achat
        $achatActuel = $achatModel->find($idAchatEnCours);
        $nouveauTotal = $achatActuel['somme_total'] + $sommeProduit;
        $achatModel->update($idAchatEnCours, ['somme_total' => $nouveauTotal]);

        // 7. Décrémentation du stock du produit
        $produitModel->update($idProduit, [
            'quantite_restant' => $produit['quantite_restant'] - $quantite
        ]);

        return redirect()->back()->with('success', 'Produit ajouté avec succès !');
    }

    public function cloturer()
    {
        // On vérifie s'il y avait bien un achat en cours
        if (session()->has('id_achat_en_cours')) {
            
            // On supprime l'ID de l'achat de la session
            session()->remove('id_achat_en_cours');
            
            return redirect()->to('/achat')->with('success', 'Achat clôturé avec succès ! Prêt pour le client suivant.');
        }

        return redirect()->back()->with('error', 'Aucun achat en cours à clôturer.');
    }
}