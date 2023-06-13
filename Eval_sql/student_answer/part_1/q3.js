const q3 = `SELECT m.name AS 'Nom', m.category AS 'Catégorie', m.power AS 'Puissance', m.pp AS 'Point de pouvoir', m.accuracy AS 'Précision', m.description AS 'Description'
FROM move m
JOIN type t ON t.type_id = m.type_id
WHERE t.name = 'Roche'
ORDER BY category`;

module.exports = q3;
