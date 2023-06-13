const q16 = `SELECT a.name  AS 'Talent', 
	count(pa.pokemon_id) AS 'Nombre possédant le talent',
	(SELECT t.name FROM type t JOIN pokemon_type pt ON t.type_id=pt.type_id JOIN pokemon_ability pa2 ON pt.pokemon_id=pa2.pokemon_id WHERE pa2.ability_id=pa.ability_id GROUP BY t.type_id ORDER BY COUNT(pa2.pokemon_id) DESC LIMIT 1) AS 'Type possédant le plus le talent',
	ROUND(count(pa.pokemon_id) * 100.0 / (SELECT count(*) FROM pokemon) ,2) || '%' AS 'Pourcentage possession',
	ifnull(ROUND((SELECT count(pokemon_id) FROM pokemon_ability WHERE is_hidden = 1  AND pokemon_ability.ability_id = pa.ability_id GROUP BY ability_id) *1.0 / count(*)*100,2),0) || '%' AS 'Pourcentage possession cachée',
	ROUND(count(pa.pokemon_id) * 1.0 /(SELECT max(meilleur) FROM (SELECT count(pokemon_id) AS meilleur FROM pokemon_ability GROUP BY ability_id )) * 100,2) || '%' AS 'Pourcentage par rapport au talent le plus possédé' 
FROM ability a
JOIN pokemon_ability pa ON a.ability_id = pa.ability_id
GROUP BY a.ability_id
ORDER BY a.name ASC`;

module.exports = q16;
