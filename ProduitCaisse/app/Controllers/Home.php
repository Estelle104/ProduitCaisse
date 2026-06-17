<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Achat;
use App\Models\AchatProduit;
use App\Models\Produit;

class Home extends BaseController
{
    public function index(): string
    {
        return view('Caisse');
    }

    public function login(): string
    {
        return view('Login');
    }

    public function achat(): string

    {
        $listeProduits = (new Produit())->getAllProduits();
        $data['produits'] = $listeProduits;
        return view('Achat',[
            'listeProduits' => $listeProduits
        ]);
    }

    public function insererAchat()
    {
        $achatModel = new Achat();
        $achatProduitModel = new AchatProduit();
        $produitModel = new Produit();

        $idCaisse = session()->get('id_caisse');
        // $idClient = session()->get('client_id'); 
        $idClient = 1;

        $idProduit = $this->request->getPost('id_produit');
        $quantite = $this->request->getPost('quantite');

        $produit = $produitModel->find($idProduit);
        if (!$produit) {
            return redirect()->back()->with('error', 'Produit introuvable.');
        }

        if ($quantite > $produit['quantite_restant']) {
            return redirect()->back()->with('error', 'Quantité insuffisante en stock.');
        }

        $prixUnitaire = $produit['prix_unitaire'];
        $sommeProduit = $prixUnitaire * $quantite;

            $achatModel->insert([
                'id_caisse'   => $idCaisse,
                'somme_total' => 0, // Sera mis à jour ou calculé à la clôture
                'id_client'   => $idClient
            ]);

            $idAchat = $achatModel->insertID();


        $achatProduitModel->insert([
            'id_achat'      => $idAchat,
            'id_produit'    => $idProduit,
            'quantite'      => $quantite,
            'somme_produit' => $sommeProduit
        ]);

        $achatActuel = $achatModel->find($idAchat);
        $nouvelleSommeTotal = $achatActuel['somme_total'] + $sommeProduit;
        $achatModel->update($idAchat, ['somme_total' => $nouvelleSommeTotal]);

        $produitModel->update($idProduit, [
            'quantite_restant' => $produit['quantite_restant'] - $quantite
        ]);

        return redirect()->back()->with('success', 'Produit ajouté au panier.');
    }
}
