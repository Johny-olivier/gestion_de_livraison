DROP DATABASE IF EXISTS gestion_livraison;

CREATE DATABASE gestion_livraison 
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE gestion_livraison;

-- ================================
-- 1. TABLES
-- ================================

CREATE TABLE entrepot (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    adresse TEXT NOT NULL
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE zone_livraison (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE vehicule (
    id INT AUTO_INCREMENT PRIMARY KEY,
    immatriculation VARCHAR(50) NOT NULL,
    cout_par_livraison DECIMAL(10,2) NOT NULL
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE chauffeur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    salaire_par_livraison DECIMAL(10,2) NOT NULL
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE colis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    poids_kg DECIMAL(10,2) NOT NULL
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE parametre (
    id INT AUTO_INCREMENT PRIMARY KEY,
    gain_par_kg DECIMAL(10,2) NOT NULL
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE livraison (
    id INT AUTO_INCREMENT PRIMARY KEY,
    colis_id INT NOT NULL,
    chauffeur_id INT NOT NULL,
    vehicule_id INT NOT NULL,
    zone_id INT NOT NULL,
    entrepot_id INT NOT NULL,
    statut ENUM('en attente', 'livré', 'annulé') NOT NULL,
    date_livraison DATE NOT NULL,

    FOREIGN KEY (colis_id) REFERENCES colis(id),
    FOREIGN KEY (chauffeur_id) REFERENCES chauffeur(id),
    FOREIGN KEY (vehicule_id) REFERENCES vehicule(id),
    FOREIGN KEY (zone_id) REFERENCES zone_livraison(id),
    FOREIGN KEY (entrepot_id) REFERENCES entrepot(id)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- VUES

-- Détails complets d’une livraison
CREATE VIEW vue_livraison_detail AS
SELECT
    l.id AS livraison_id,
    l.date_livraison,
    l.statut,

    c.poids_kg,

    ch.nom AS chauffeur,
    ch.salaire_par_livraison,

    v.immatriculation,
    v.cout_par_livraison,

    z.nom AS zone,
    e.nom AS entrepot
FROM livraison l
JOIN colis c ON l.colis_id = c.id
JOIN chauffeur ch ON l.chauffeur_id = ch.id
JOIN vehicule v ON l.vehicule_id = v.id
JOIN zone_livraison z ON l.zone_id = z.id
JOIN entrepot e ON l.entrepot_id = e.id;

-- Chiffre d’affaires par livraison
CREATE VIEW vue_chiffre_affaire AS
SELECT
    l.id AS livraison_id,
    c.poids_kg * p.gain_par_kg AS chiffre_affaire
FROM livraison l
JOIN colis c ON l.colis_id = c.id
JOIN parametre p ON p.id = 1
WHERE l.statut = 'livré';

-- Coût de revient
CREATE VIEW vue_cout_revient AS
SELECT
    l.id AS livraison_id,
    (ch.salaire_par_livraison + v.cout_par_livraison) AS cout_de_revient
FROM livraison l
JOIN chauffeur ch ON l.chauffeur_id = ch.id
JOIN vehicule v ON l.vehicule_id = v.id
WHERE l.statut = 'livré';


-- Bénéfice par livraison
CREATE VIEW vue_benefice_livraison AS
SELECT
    l.id AS livraison_id,
    (c.poids_kg * p.gain_par_kg)
    - (ch.salaire_par_livraison + v.cout_par_livraison) AS benefice
FROM livraison l
JOIN colis c ON l.colis_id = c.id
JOIN chauffeur ch ON l.chauffeur_id = ch.id
JOIN vehicule v ON l.vehicule_id = v.id
JOIN parametre p ON p.id = 1
WHERE l.statut = 'livré';

-- Bénéfice par période (jour / mois / année)
CREATE VIEW vue_benefice_par_mois AS
SELECT
    YEAR(l.date_livraison) AS annee,
    MONTH(l.date_livraison) AS mois,
    SUM(
        (c.poids_kg * p.gain_par_kg)
        - (ch.salaire_par_livraison + v.cout_par_livraison)
    ) AS benefice_total
FROM livraison l
JOIN colis c ON l.colis_id = c.id
JOIN chauffeur ch ON l.chauffeur_id = ch.id
JOIN vehicule v ON l.vehicule_id = v.id
JOIN parametre p ON p.id = 1
WHERE l.statut = 'livré'
GROUP BY annee, mois;

--  Nombre de livraisons actives (statut = en attente ou en cours)
CREATE OR REPLACE VIEW vue_livraisons_actives AS
SELECT COUNT(*) AS total
FROM livraison
WHERE statut = 'en attente';

-- Nombre de chauffeurs actifs (présents dans au moins une livraison)
CREATE OR REPLACE VIEW vue_chauffeurs_actifs AS
SELECT COUNT(DISTINCT chauffeur_id) AS total
FROM livraison
WHERE statut != 'annulé';

-- Nombre de véhicules en route (statut en cours)
CREATE OR REPLACE VIEW vue_vehicules_en_route AS
SELECT COUNT(DISTINCT vehicule_id) AS total
FROM livraison
WHERE statut = 'en attente';

-- Taux de satisfaction (exemple : % livraisons livrées / total livraisons)
CREATE OR REPLACE VIEW vue_taux_satisfaction AS
SELECT 
    ROUND(
        100 * SUM(CASE WHEN statut = 'livré' THEN 1 ELSE 0 END) / COUNT(*),
        1
    ) AS taux
FROM livraison;
