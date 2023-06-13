const q6 = `SELECT p.pokedex_number AS 'N°', p.name AS 'Pokemon', a.name AS 'Talent', a.description AS 'Description talent'
FROM pokemon p
JOIN pokemon_ability pa ON p.pokemon_id = pa.pokemon_id
JOIN ability a ON a.ability_id = pa.ability_id
GROUP BY a.ability_id
HAVING count(a.ability_id) = 1
ORDER BY p.pokedex_number ASC`;

module.exports = q6;
