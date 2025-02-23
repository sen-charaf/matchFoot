CREATE TABLE IF NOT EXISTS joueur
(
    id_joueur INT AUTO_INCREMENT PRIMARY KEY,
    nom CHAR(25) NOT NULL,
    prenom CHAR(25) NOT NULL,
    date_naissance DATE NOT NULL,
    pied CHAR(1) NOT NULL,
    poid FLOAT CHECK (poid > 0) NOT NULL,
    taille FLOAT CHECK (taille > 0) NOT NULL,
    equip INT NOT NULL
);