CREATE TABLE IF NOT EXISTS joueur
(
    id_joueur INT AUTO_INCREMENT PRIMARY KEY,
    nom CHAR(25) NOT NULL,
    prenom CHAR(25) NOT NULL,
    date_naissance DATE NOT NULL,
    pied CHAR(1) NOT NULL,
    poid FLOAT CHECK (poid > 0) NOT NULL,
    taille FLOAT CHECK (taille > 0) NOT NULL,
    equip INT NOT NULL,
    photoPath char(50)
);


CREATE TABLE `tournoies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `nbr_equipes` int NOT NULL,
  `logo_path` varchar(200) DEFAULT NULL,
  `nbr_round` int DEFAULT '1',
  PRIMARY KEY (`id`)
);