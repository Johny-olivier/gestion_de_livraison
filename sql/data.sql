
INSERT INTO parametre (gain_par_kg) VALUES
(5000); -- 5 000 Ar par kg

INSERT INTO entrepot (nom, adresse) VALUES
('Entrepôt Antananarivo', 'Ankorondrano'),
('Entrepôt Toamasina', 'Port de Toamasina'),
('Entrepôt Mahajanga', 'Zone industrielle Mahajanga');

INSERT INTO zone_livraison (nom) VALUES
('Centre-ville'),
('Banlieue'),
('Zone rurale'),
('Zone portuaire'),
('Zone industrielle');

INSERT INTO vehicule (immatriculation, cout_par_livraison) VALUES
('TAA-1234', 15000),
('TAB-5678', 18000),
('TAC-9012', 20000),
('TAD-3456', 25000),
('TAE-7890', 30000);

INSERT INTO chauffeur (nom, salaire_par_livraison) VALUES
('Rakoto Jean', 20000),
('Rabe Paul', 22000),
('Randria Marc', 25000),
('Andry Hery', 18000),
('Solofo Alain', 30000);

INSERT INTO colis (poids_kg) VALUES
(2.5), (5), (7.2), (10), (12),
(15), (20), (25), (30), (35),
(40), (45), (50), (8), (6);

INSERT INTO livraison 
(colis_id, chauffeur_id, vehicule_id, zone_id, entrepot_id, statut, date_livraison)
VALUES
-- Janvier 2024
(1, 1, 1, 1, 1, 'livré', '2024-01-05'),
(2, 2, 2, 2, 1, 'livré', '2024-01-10'),
(3, 3, 3, 3, 1, 'livré', '2024-01-15'),
(4, 4, 4, 4, 1, 'annulé', '2024-01-18'),
(5, 5, 5, 5, 1, 'livré', '2024-01-20'),

-- Février 2024
(6, 1, 2, 1, 2, 'livré', '2024-02-02'),
(7, 2, 3, 2, 2, 'livré', '2024-02-08'),
(8, 3, 4, 3, 2, 'en attente', '2024-02-12'),
(9, 4, 5, 4, 2, 'livré', '2024-02-17'),
(10, 5, 1, 5, 2, 'livré', '2024-02-25'),

-- Mars 2024
(11, 1, 2, 1, 3, 'livré', '2024-03-05'),
(12, 2, 3, 2, 3, 'livré', '2024-03-10'),
(13, 3, 4, 3, 3, 'livré', '2024-03-15'),
(14, 4, 5, 4, 3, 'en attente', '2024-03-18'),
(15, 5, 1, 5, 3, 'annulé', '2024-03-20'),

-- 2023
(5, 1, 1, 1, 1, 'livré', '2023-06-10'),
(6, 2, 2, 2, 1, 'livré', '2023-08-15'),
(7, 3, 3, 3, 2, 'livré', '2023-11-20'),

-- 2025
(8, 4, 4, 4, 2, 'livré', '2025-01-05'),
(9, 5, 5, 5, 3, 'livré', '2025-02-12'),
(10, 1, 2, 1, 3, 'en attente', '2025-03-01');

SELECT * FROM vue_benefice_par_mois;
SELECT SUM(benefice) FROM vue_benefice_livraison;
SELECT * FROM vue_chiffre_affaire;
SELECT * FROM vue_cout_revient;

SELECT * FROM vue_livraisons_actives;
SELECT * FROM vue_chauffeurs_actifs;
SELECT * FROM vue_vehicules_en_route;
SELECT * FROM vue_taux_satisfaction;
