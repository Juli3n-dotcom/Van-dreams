DROP DATABASE IF EXISTS van_dream;
CREATE DATABASE van_dream CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE van_dream;

CREATE TABLE membre
(
 id_membre INT(3) NOT NULL AUTO_INCREMENT,
 email VARCHAR(50) NOT NULL,
 password VARCHAR(60) NOT NULL,
 civilite BOOLEAN,
 nom VARCHAR(20) NOT NULL,
 prenom VARCHAR(20) NOT NULL,
 statut INT(3) NOT NULL,
 date_enregistrement DATETIME NOT NULL,
 confirmation TINYINT DEFAULT NULL,
 token VARCHAR(255) DEFAULT NULL,
 ip VARCHAR(255) NOT NULL,
 PRIMARY KEY(id_membre)
)ENGINE=INNODB;

CREATE TABLE photo
(
 id_photo INT(3) NOT NULL AUTO_INCREMENT,
 photo1 VARCHAR (255) NOT NULL,
 photo2 VARCHAR (255) NOT NULL,
 photo3 VARCHAR (255),
 photo4 VARCHAR (255),
 photo5 VARCHAR (255),
 PRIMARY KEY(id_photo)
)ENGINE=INNODB;

CREATE TABLE categorie
(
    id_categorie INT(3)NOT NULL AUTO_INCREMENT,
    titre VARCHAR(255),
    motscles TEXT(255),
    PRIMARY KEY (id_categorie)
)ENGINE=INNODB;

CREATE TABLE annonce
(
 id_annonce INT(3) NOT NULL AUTO_INCREMENT,
 titre_annonce VARCHAR(255) NOT NULL,
 membre_id INT(3) DEFAULT NULL,
 description_courte VARCHAR(255) NOT NULL,
 description_longue TEXT NOT NULL,
 prix DECIMAL(10,2),
 categorie_id INT(3) DEFAULT NULL,
 photo_id INT(3) DEFAULT NULL,
 pays VARCHAR(20)NOT NULL,
 region VARCHAR(50)NOT NULL,
CP INT(5) NOT NULL,
 ville VARCHAR(20) NOT NULL,
 telephone VARCHAR(20) NOT NULL,
 est_publie TINYINT NOT NULL,
 date_enregistrement DATETIME NOT NULL,
 PRIMARY KEY(id_annonce),
 CONSTRAINT fk_annonce_membre
      FOREIGN KEY  (membre_id)
      REFERENCES  membre(id_membre)
      ON DELETE CASCADE,
CONSTRAINT fk_annonce_photo
      FOREIGN KEY  (photo_id)
      REFERENCES  photo(id_photo)
      ON DELETE CASCADE,
CONSTRAINT fk_annonce_categorie
        FOREIGN KEY (categorie_id)
        REFERENCES categorie(id_categorie)
        ON DELETE CASCADE
)ENGINE=INNODB;

CREATE TABLE message
(
   id_message INT(3) NOT NULL AUTO_INCREMENT,
   membre_id1 INT(3) DEFAULT NULL,
   membre_id2 INT(3) DEFAULT NULL,
    message TEXT NOT NULL,
    date_enregistrement DATETIME NOT NULL,
   PRIMARY KEY (id_message),
   CONSTRAINT fk_message_membre_id1
      FOREIGN KEY (membre_id1)
      REFERENCES membre(id_membre)
      ON DELETE CASCADE,
   CONSTRAINT fk_message_membre_id2
      FOREIGN KEY (membre_id2)
      REFERENCES membre(id_membre)
      ON DELETE CASCADE
)ENGINE=INNODB;

CREATE TABLE message_admin
(
   id_message INT(3) NOT NULL AUTO_INCREMENT,
   membre_id1 INT(3) DEFAULT NULL,
   email VARCHAR(50) NOT NULL,
    message TEXT NOT NULL,
    date_enregistrement DATETIME NOT NULL,
   PRIMARY KEY (id_message)
)ENGINE=INNODB;