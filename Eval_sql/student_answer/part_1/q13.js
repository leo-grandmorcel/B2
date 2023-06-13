const q13 = `SELECT p.name AS 'Nom du pokemon', count(m.name) AS 'Nombre capacité avec le même type'
FROM pokemon p
JOIN pokemon_move pm ON p.pokemon_id = pm.pokemon_id
JOIN pokemon_type pt ON p.pokemon_id = pt.pokemon_id
JOIN move m ON pm.move_id = m.move_id
JOIN type t ON m.type_id = t.type_id
WHERE t.type_id = pt.type_id
GROUP BY p.pokedex_number
ORDER BY count(m.name) DESC, p.name ASC
LIMIT 10;`;

module.exports = q13;
