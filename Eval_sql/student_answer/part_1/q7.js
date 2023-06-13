const q7 = `SELECT p.pokedex_number AS 'N°', p.name AS 'Nom du pokemon',
	(SELECT name
	FROM type t
	JOIN pokemon_type pt ON t.type_id = pt.type_id
	WHERE slot = 1 
	AND pt.pokemon_id = p.pokemon_id) AS 'Type 1',
	ifnull((SELECT name
	FROM type t
	JOIN pokemon_type pt ON t.type_id = pt.type_id
	WHERE slot = 2
	AND pt.pokemon_id = p.pokemon_id),'N/A') AS 'Type 2'
FROM pokemon p
ORDER BY pokedex_number ASC`;

module.exports = q7;
