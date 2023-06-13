const q12 = `SELECT p.pokedex_number AS 'N°', p.name AS 'Nom du pokemon', a.name AS 'Nom du talent'
FROM pokemon p
JOIN pokemon_type pt ON p.pokemon_id = pt.pokemon_id
JOIN type t ON pt.type_id = t.type_id
JOIN pokemon_ability pa ON p.pokemon_id = pa.pokemon_id
JOIN ability a ON pa.ability_id = a.ability_id
WHERE t.name = 'Acier'
AND pa.is_hidden = 1
ORDER BY p.pokedex_number ASC`;

module.exports = q12;
