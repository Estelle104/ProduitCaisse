CREATE TABLE clients(
    id INT PRIMARY KEY,
    nom VARCHAR(25),
    email VARCHAR(50),
    telephone VARCHAR(15),
    mdp VARCHAR(25)
);


CREATE TABLE produits(
    id INT PRIMARY KEY,
    designation VARCHAR(25),
    quantite_restant DOUBLE,
    prix_unitaire DOUBLE
);


CREATE TABLE caisse (
    id INT PRIMARY KEY,
    numero_caisse VARCHAR(10)
);

CREATE TABLE achat (
    id INT PRIMARY KEY,
    id_caisse INT ,
    somme_total DOUBLE,
    id_client INT
);

CREATE TABLE achat_produit(
    id INT PRIMARY KEY,
    id_achat INT,
    id_produit INT,
    quantite DOUBLE,
    somme_produit DOUBLE
);
