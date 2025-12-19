
-- Chiffre d'affaires
SELECT
    l.id,
    c.poids_kg * p.gain_par_kg AS chiffre_affaire
FROM livraison l
JOIN colis c ON l.colis_id = c.id
JOIN parametre p ON p.id = 1
WHERE l.statut = 'livré';

-- Bénéfice par livraison
SELECT
    l.id,
    (c.poids_kg * p.gain_par_kg)
    - (ch.salaire_par_livraison + v.cout_par_livraison) AS benefice
FROM livraison l
JOIN colis c ON l.colis_id = c.id
JOIN chauffeur ch ON l.chauffeur_id = ch.id
JOIN vehicule v ON l.vehicule_id = v.id
JOIN parametre p ON p.id = 1
WHERE l.statut = 'livré';

-- Bénéfice par mois
SELECT
    YEAR(date_livraison) AS annee,
    MONTH(date_livraison) AS mois,
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
GROUP BY annee, mois
ORDER BY annee, mois;