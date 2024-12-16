CREATE DATABASE gestion_restaurant;
use gestion_restaurant;

CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(55),
    email VARCHAR(55),
    password VARCHAR(255),
    role VARCHAR(10)
);
CREATE TABLE menu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(55),
    prix DECIMAL(10,2),
    archive boolean

);
CREATE TABLE image (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    type VARCHAR(50) NOT NULL,
    data LONGBLOB NOT NULL
);
CREATE TABLE plat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(55),
    categorie VARCHAR(55),
    id_image INT,
    FOREIGN KEY (id_image) REFERENCES image(id)

);
CREATE TABLE reservation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_reservation DATE,
    heure_reservation timestamp,
    status ENUM("En Attente","Annulée","Confirmée"),
    id_menu INT,
    id_client INT,
    addresse_reservation VARCHAR(255),
    nbr_personnes INT,
    FOREIGN KEY(id_menu) REFERENCES menu(id),
    FOREIGN KEY(id_client) REFERENCES user(id)
);
Create TABLE menu_plat (
    id_menu INT,
    id_plat INT,
    FOREIGN KEY(id_menu) REFERENCES menu(id),
    FOREIGN KEY(id_plat) REFERENCES plat(id)

);

