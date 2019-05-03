CREATE TABLE `Utilisateurs`
(
  `idUser` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mail` varchar(255) UNIQUE,
  `tel` int DEFAULT NULL,
  `admin` boolean NOT NULL DEFAULT 0,
  `mdp` varchar(255) NOT NULL,
  `img` mediumblob NOT NULL, 
  `imgFond` mediumblob NOT NULL,
  `dateInscription` date DEFAULT NULL,
  `strValidation` varchar(255),
  `adresse` varchar(255) DEFAULT NULL,
  `codePostal` int DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `pays` varchar(255) DEFAULT NULL
);

CREATE TABLE `Produits`
(
  `idProduit` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) UNIQUE NOT NULL,
  `categorie` enum('livres', 'musique', 'vetements', 'sport') NOT NULL,
  `idVendeur` int NOT NULL,
  `description` varchar(255) DEFAULT "",
  `prix` float NOT NULL,
  `quantity` int NOT NULL,
  `img` mediumblob NOT NULL
);

CREATE TABLE `Achats`
(
  `idAchat` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `idAcheteur` int NOT NULL,
  `idProduit` int NOT NULL,
  `quantity` int NOT NULL DEFAULT 1,
  `dateAchat` datetime NOT NULL,
  `caraSelect` varchar(255) NOT NULL
);

CREATE TABLE `CartesBanaires`
(
  `idUser` int NOT NULL AUTO_INCREMENT,
  `numero` int NOT NULL,
  `codeSecurite` int NOT NULL,
  `dateExpiration` date NOT NULL,
  `type` varchar(255) NOT NULL,
  CONSTRAINT CartesBanairesPK PRIMARY KEY (`idUser`, `numero`)
);

CREATE TABLE `Carateristiques`
(
  `idCara` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) UNIQUE NOT NULL
);

CREATE TABLE `CaraProduits`
(
  `idCara` int NOT NULL,
  `idProduit` int NOT NULL,
  CONSTRAINT CaraProduitsPK PRIMARY KEY (`idCara`, `idProduit`)
);

CREATE TABLE `CaraChoix`
(
  `idChoix` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `idCara` int NOT NULL,
  `nom` varchar(255) NOT NULL
);

CREATE TABLE `ChoixDispoProduits`
(
  `idProduit` int NOT NULL,
  `idChoix` int NOT NULL,
  CONSTRAINT ChoixDispoProduitsPK PRIMARY KEY (`idProduit`, `idChoix`)
);

ALTER TABLE `Produits` ADD FOREIGN KEY (`idVendeur`) REFERENCES `Utilisateurs` (`idUser`);

ALTER TABLE `Achats` ADD FOREIGN KEY (`idAcheteur`) REFERENCES `Utilisateurs` (`idUser`);

ALTER TABLE `Achats` ADD FOREIGN KEY (`idProduit`) REFERENCES `Produits` (`idProduit`);

ALTER TABLE `CartesBanaires` ADD FOREIGN KEY (`idUser`) REFERENCES `Utilisateurs` (`idUser`);

ALTER TABLE `CaraProduits` ADD FOREIGN KEY (`idCara`) REFERENCES `Carateristiques` (`idCara`);

ALTER TABLE `CaraProduits` ADD FOREIGN KEY (`idProduit`) REFERENCES `Produits` (`idProduit`);

ALTER TABLE `CaraChoix` ADD FOREIGN KEY (`idCara`) REFERENCES `Carateristiques` (`idCara`);

ALTER TABLE `ChoixDispoProduits` ADD FOREIGN KEY (`idChoix`) REFERENCES `CaraChoix` (`idChoix`);

ALTER TABLE `ChoixDispoProduits` ADD FOREIGN KEY (`idProduit`) REFERENCES `Produits` (`idProduit`);

#valeurs par default


INSERT INTO Carateristiques (nom) VALUES
 ('taille'),
 ('couleur'),
 ('format'),
 ('edition'),
 ('genre'),
 ('sexe');

INSERT INTO CaraChoix (idCara, nom) VALUES
 (1, 'XS'), (1, 'S'), (1, 'M'), (1, 'L'), (1, 'XL'),
 (2, 'bleu'), (2, 'rouge'), (2, 'vert'), (2, 'noir'), (2, 'jaune'), (2, 'blanc'),
 (3, 'poche'), (3, 'brochet'),
 (4, 'gallimard'), (4, 'flammarion'), (4, 'milan'), (4, 'Hachette'),
 (5, 'jazz'), (5, 'rock'), (5, 'electro'), (5, 'rap'), (5, 'classique'), (5, 'funk'),
 (6, 'homme'), (6, 'femme'), (6, 'enfant');



