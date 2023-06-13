const q8 = `SELECT t.name AS 'Nom du type', count(*) AS 'Nombre de pokemon', sum(pt.slot=1) AS 'Nombre de pokemon avec le type slot 1', sum(pt.slot=2) AS 'Nombre de pokemon avec le type slot 2'
FROM type t
JOIN pokemon_type pt ON t.type_id = pt.type_id
GROUP BY t.type_id
ORDER BY count(*) DESC, sum(pt.slot=1) DESC`;

module.exports = q8;
