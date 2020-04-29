DROP DATABASE IF EXISTS van_dream;
CREATE DATABASE van_dream CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE van_dream;

CREATE TABLE membre
(
 id_membre INT(3) NOT NULL AUTO_INCREMENT,
 email VARCHAR(50) NOT NULL,
 name VARCHAR(255) NOT NULL,
 password VARCHAR(60) NOT NULL,
 cgu BOOLEAN,
 nom VARCHAR(20) NOT NULL,
 prenom VARCHAR(20) NOT NULL,
 statut INT(3) NOT NULL,
 date_enregistrement DATETIME NOT NULL,
 confirmation TINYINT DEFAULT NULL,
 token VARCHAR(255) DEFAULT NULL,
 ip VARCHAR(255),
 PRIMARY KEY(id_membre)
)ENGINE=INNODB;

CREATE TABLE photo
(
 id_photo INT(3) NOT NULL AUTO_INCREMENT,
 photo1 VARCHAR (255) NOT NULL,
 photo2 VARCHAR (255),
 photo3 VARCHAR (255),
 PRIMARY KEY(id_photo)
)ENGINE=INNODB;

CREATE TABLE category
(
    id_category INT(3)NOT NULL AUTO_INCREMENT,
    name VARCHAR(255),
    titre VARCHAR(255),
    motscles TEXT(255),
    PRIMARY KEY (id_category)
)ENGINE=INNODB;

CREATE TABLE sub_category
(
    id_sub_cat INT(3)NOT NULL AUTO_INCREMENT,
    name VARCHAR(255),
    titre VARCHAR(255),
    motscles TEXT(255),
    PRIMARY KEY (id_sub_cat)
)ENGINE=INNODB;

CREATE TABLE country
(
    id_country INT(3)NOT NULL AUTO_INCREMENT,
    name VARCHAR(255),
    PRIMARY KEY (id_country)
)ENGINE=INNODB;

CREATE TABLE region
(
    id_region INT(3)NOT NULL AUTO_INCREMENT,
    name VARCHAR(255),
    country_id INT(3) DEFAULT NULL,
    PRIMARY KEY (id_region),
    CONSTRAINT fk_country_region
      FOREIGN KEY  (country_id)
      REFERENCES  country(id_country)
      ON DELETE CASCADE
)ENGINE=INNODB;


CREATE TABLE annonces
(
 id_annonce INT(3) NOT NULL AUTO_INCREMENT,
 titre_annonce VARCHAR(255) NOT NULL,
 membre_id INT(3) DEFAULT NULL,
 description_annonce TEXT DEFAULT NULL,
 prix DECIMAL(10,2),
 km VARCHAR(20) DEFAULT NULL,
 places INT(2) DEFAULT NULL,
 marque VARCHAR(50) DEFAULT NULL,
 modele VARCHAR(50) DEFAULT NULL,
 annee_modele VARCHAR(50) DEFAULT NULL,
 category_id INT(3) DEFAULT NULL,
 subcat_id INT(3) DEFAULT NULL,
 photo_id INT(3) DEFAULT NULL,
 country_id INT(3)DEFAULT NULL,
 region_id INT(3)DEFAULT NULL,
 cp INT(5) DEFAULT NULL,
 ville VARCHAR(20) DEFAULT NULL,
 telephone VARCHAR(20) DEFAULT NULL,
 est_publie TINYINT DEFAULT NULL,
 est_signal TINYINT NOT NULL,
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
CONSTRAINT fk_annonce_category
        FOREIGN KEY (category_id)
        REFERENCES category(id_category)
        ON DELETE CASCADE,
CONSTRAINT fk_annonce_subcat
        FOREIGN KEY (subcat_id)
        REFERENCES sub_category(id_sub_cat)
        ON DELETE CASCADE,
CONSTRAINT fk_annonce_country
        FOREIGN KEY (country_id)
        REFERENCES country(id_country)
        ON DELETE CASCADE,
CONSTRAINT fk_annonce_region
        FOREIGN KEY (region_id)
        REFERENCES region(id_region)
        ON DELETE CASCADE
)ENGINE=INNODB;

CREATE TABLE `paiements` (
 `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `payment_id` varchar(255) NOT NULL,
 `payment_status` text NOT NULL,
 `payment_amount` text NOT NULL,
 `payment_currency` text NOT NULL,
 `payment_date` datetime NOT NULL,
 `payer_email` text NOT NULL
);

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

CREATE TABLE online
(
    id INT(3)NOT NULL AUTO_INCREMENT,
    time int(255),
    user_ip VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
)ENGINE=INNODB;

CREATE TABLE liste_newsletter
(
    id INT(3)NOT NULL AUTO_INCREMENT,
    email varchar(255),
    user_ip VARCHAR(255) NOT NULL,
    date_enregistrement DATETIME NOT NULL,
    PRIMARY KEY (id)
)ENGINE=INNODB;
