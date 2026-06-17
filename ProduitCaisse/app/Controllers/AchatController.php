<?php

namespace App\Controllers;

use App\Models\Achat;
use App\Models\AchatProduit;
use App\Models\Produit;

class AchatController extends BaseController
{
    public function ajouter()
    {

    dd("Le formulaire est bien arrivé dans PHP !");
        $achatModel = new Achat();
        $achatProduitModel = new AchatProduit();
        $produitModel = new Produit();

        $idCaisse = session()->get('id_caisse');
        $idClient = session()->get('client_id'); 

        // $idCaisse = 1;
        // $idClient = 1;

        $idProduit = $this->request->getPost('id_produit');
        $quantite = $this->request->getPost('quantite');

        $produit = $produitModel->find($idProduit);
        if (!$produit) {
            return redirect()->back()->with('error', 'Produit introuvable.');
        }

        if ($quantite > $produit['quantite_restant']) {
            return redirect()->back()->with('error', 'Quantité en stock insuffisante.');
        }

        $prixUnitaire = $produit['prix_unitaire'];
        $sommeProduit = $prixUnitaire * $quantite;

        $idAchatEnCours = session()->get('id_achat_en_cours');

        if (!$idAchatEnCours) {
            // S'il n'y a pas d'achat en cours, on insère l'en-tête (le ticket)
            $dataAchat = [
                'id_caisse'   => $idCaisse,
                'somme_total' => 0, 
                'id_client'   => $idClient ?? null
            ];

            $achatModel->insert($dataAchat);

            $idAchatEnCours = $achatModel->insertID();

            session()->set('id_achat_en_cours', $idAchatEnCours);
        }

        $dataLigne = [
            'id_achat'      => $idAchatEnCours,
            'id_produit'    => $idProduit,
            'quantite'      => $quantite,
            'somme_produit' => $sommeProduit
        ];
        $achatProduitModel->insert($dataLigne);
        // En cas de doute, ceci affiche la dernière requête SQL exécutée et arrête le code
        // dd($achatProduitModel->getLastQuery()->getQuery());

        $achatActuel = $achatModel->find($idAchatEnCours);
        $nouveauTotal = $achatActuel['somme_total'] + $sommeProduit;
        $achatModel->update($idAchatEnCours, ['somme_total' => $nouveauTotal]);

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

            return redirect()->to('/client/achat')->with('success', 'Achat clôturé avec succès ! Prêt pour le client suivant.');
        }

        return redirect()->back()->with('error', 'Aucun achat en cours à clôturer.');
    }
}
