-- CREATE DATABASE gestion_restaurant;
-- use gestion_restaurant;

-- CREATE TABLE user (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     nom VARCHAR(55),
--     email VARCHAR(55),
--     password VARCHAR(255),
--     role VARCHAR(10)
-- );
-- CREATE TABLE menu (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     titre VARCHAR(55),
--     prix DECIMAL(10,2),
--     archive boolean

-- );
-- CREATE TABLE image (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     name VARCHAR(255) NOT NULL,
--     type VARCHAR(50) NOT NULL,
--     data LONGBLOB NOT NULL
-- );
-- CREATE TABLE plat (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     titre VARCHAR(55),
--     categorie VARCHAR(55),
--     id_image INT,
--     FOREIGN KEY (id_image) REFERENCES image(id)

-- );
-- CREATE TABLE reservation (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     date_reservation DATE,
--     heure_reservation timestamp,
--     status ENUM("En Attente","Annulée","Confirmée"),
--     id_menu INT,
--     id_client INT,
--     addresse_reservation VARCHAR(255),
--     nbr_personnes INT,
--     FOREIGN KEY(id_menu) REFERENCES menu(id),
--     FOREIGN KEY(id_client) REFERENCES user(id)
-- );
-- Create TABLE menu_plat (
--     id_menu INT,
--     id_plat INT,
--     FOREIGN KEY(id_menu) REFERENCES menu(id),
--     FOREIGN KEY(id_plat) REFERENCES plat(id)

-- );

-- Création de la base de données
CREATE DATABASE gestion_restaurant;
USE gestion_restaurant;

-- Création des tables
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
    archive BOOLEAN
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
    heure_reservation TIMESTAMP,
    status ENUM('En Attente', 'Annulée', 'Confirmée'),
    id_menu INT,
    id_client INT,
    addresse_reservation VARCHAR(255),
    nbr_personnes INT,
    FOREIGN KEY (id_menu) REFERENCES menu(id),
    FOREIGN KEY (id_client) REFERENCES user(id)
);

CREATE TABLE menu_plat (
    id_menu INT,
    id_plat INT,
    FOREIGN KEY (id_menu) REFERENCES menu(id),
    FOREIGN KEY (id_plat) REFERENCES plat(id)
);

-- Insertion de données initiales
INSERT INTO user (nom, email, password, role) VALUES
('Hamza', 'hamza@gmail.com', 'password123', 'client'),
('Admin', 'admin@gmail.com', 'admin123', 'admin');

INSERT INTO menu (titre, prix, archive) VALUES
('Menu Spécial', 120.50, FALSE),
('Menu Végétarien', 90.00, FALSE);

INSERT INTO image (name, type, data) VALUES
('image1.jpg', 'image/jpeg', '...'), -- Ajouter le contenu binaire réel
('image2.jpg', 'image/jpeg', '...');

INSERT INTO plat (titre, categorie, id_image) VALUES
('Poulet Rôti', 'Viande', 1),
('Salade César', 'Entrée', 2);

INSERT INTO reservation (date_reservation, heure_reservation, status, id_menu, id_client, addresse_reservation, nbr_personnes) VALUES
('2024-12-25', '2024-12-25 19:00:00', 'En Attente', 1, 1, '123 Rue Exemple', 4);

INSERT INTO menu_plat (id_menu, id_plat) VALUES
(1, 1),
(1, 2);

-- Opérations CRUD pour les plats associés à un menu

-- 1. Insérer un plat dans un menu
INSERT INTO menu_plat (id_menu, id_plat) 
VALUES (2, 1); -- Associe le plat avec id=1 au menu avec id=2

-- 2. Modifier un plat dans un menu
DELETE FROM menu_plat 
WHERE id_menu = 1 AND id_plat = 1; -- Supprime l'ancien plat associé

INSERT INTO menu_plat (id_menu, id_plat) 
VALUES (1, 3); -- Associe un nouveau plat au menu

-- 3. Supprimer un plat d'un menu
DELETE FROM menu_plat 
WHERE id_menu = 1 AND id_plat = 2; -- Supprime l'association entre menu et plat

-- 4. Sélectionner les plats d'un menu spécifique
SELECT p.id, p.titre, p.categorie
FROM plat p
JOIN menu_plat mp ON p.id = mp.id_plat
WHERE mp.id_menu = 1;

-- 5. Sélectionner tous les plats associés à tous les menus
SELECT m.titre AS menu_titre, p.titre AS plat_titre, p.categorie
FROM menu m
JOIN menu_plat mp ON m.id = mp.id_menu
JOIN plat p ON mp.id_plat = p.id
ORDER BY m.titre, p.titre;

-- 6. Sélectionner les menus contenant un plat spécifique
SELECT m.id, m.titre, m.prix, m.archive
FROM menu m
JOIN menu_plat mp ON m.id = mp.id_menu
WHERE mp.id_plat = 2;

-- 7. Supprimer un menu et ses associations
DELETE FROM menu_plat WHERE id_menu = 1;
DELETE FROM menu WHERE id = 1;
