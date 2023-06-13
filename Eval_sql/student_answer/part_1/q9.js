const q9 = `SELECT t.name AS 'Type', m.name AS 'Capacité', m.power AS 'Puissance', m.accuracy AS 'Précision', m.description AS 'Description'
FROM type t
JOIN move m ON t.type_id = m.type_id
WHERE m.power > 100 AND m.accuracy >= 90 AND m.description NOT LIKE '% tour %'
ORDER BY m.power DESC`;

module.exports = q9;
