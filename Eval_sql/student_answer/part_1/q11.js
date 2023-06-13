const q11 = `SELECT p.name AS 'Pokemon', count(p.pokemon_id) AS 'Nombre de capacités'
FROM pokemon p
JOIN pokemon_move pm ON p.pokemon_id = pm.pokemon_id
GROUP BY p.pokemon_id
ORDER BY count(p.pokemon_id) DESC
LIMIT 1`;

module.exports = q11;
