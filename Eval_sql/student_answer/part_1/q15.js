const q15 = `SELECT t.name AS 'Type', 
	ifnull((SELECT (sum(hp)+sum(attack)+sum(defense)+sum(spe_attack)+sum(spe_defense)+sum(speed))/count(b.pokemon_id)
	FROM base_stat b
	JOIN pokemon_type pt ON b.pokemon_id = pt.pokemon_id
	JOIN pokemon p ON b.pokemon_id = p.pokemon_id
	WHERE t.type_id = pt.type_id
	AND p.pokedex_number BETWEEN 1 AND 151),0) AS 'Moyenne gen 1 total stat',
	ifnull((SELECT (sum(hp)+sum(attack)+sum(defense)+sum(spe_attack)+sum(spe_defense)+sum(speed))/count(b.pokemon_id)
	FROM base_stat b
	JOIN pokemon_type pt ON b.pokemon_id = pt.pokemon_id
	JOIN pokemon p ON b.pokemon_id = p.pokemon_id
	WHERE t.type_id = pt.type_id
	AND p.pokedex_number BETWEEN 252 AND 386),0) AS 'Moyenne gen 3 total stat',
	ifnull((SELECT (sum(hp)+sum(attack)+sum(defense)+sum(spe_attack)+sum(spe_defense)+sum(speed))/count(b.pokemon_id)
	FROM base_stat b
	JOIN pokemon_type pt ON b.pokemon_id = pt.pokemon_id
	JOIN pokemon p ON b.pokemon_id = p.pokemon_id
	WHERE t.type_id = pt.type_id
	AND p.pokedex_number BETWEEN 494 AND 649),0) AS 'Moyenne gen 5 total stat',
	ifnull((SELECT (sum(hp)+sum(attack)+sum(defense)+sum(spe_attack)+sum(spe_defense)+sum(speed))/count(b.pokemon_id)
	FROM base_stat b
	JOIN pokemon_type pt ON b.pokemon_id = pt.pokemon_id
	JOIN pokemon p ON b.pokemon_id = p.pokemon_id
	WHERE t.type_id = pt.type_id
	AND p.pokedex_number BETWEEN 722 AND 807),0) AS 'Moyenne gen 7 total stat'
FROM type t`;

module.exports = q15;
