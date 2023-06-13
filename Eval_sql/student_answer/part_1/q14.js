const q14 = `SELECT t.name AS 'Type', 
	(SELECT p.name
	FROM pokemon p
	JOIN base_stat b ON p.pokemon_id = b.pokemon_id
	JOIN pokemon_type pt ON p.pokemon_id = pt.pokemon_id
	WHERE t.type_id = pt.type_id
	ORDER BY b.hp DESC, attack+defense+spe_attack+spe_defense+speed DESC, pokedex_number ASC
	LIMIT 1) AS 'HP',
	(SELECT p.name
	FROM pokemon p
	JOIN base_stat b ON p.pokemon_id = b.pokemon_id
	JOIN pokemon_type pt ON p.pokemon_id = pt.pokemon_id
	WHERE t.type_id = pt.type_id
	ORDER BY attack DESC, hp+defense+spe_attack+spe_defense+speed DESC, pokedex_number ASC
	LIMIT 1) AS 'Attaque',
	(SELECT p.name
	FROM pokemon p
	JOIN base_stat b ON p.pokemon_id = b.pokemon_id
	JOIN pokemon_type pt ON p.pokemon_id = pt.pokemon_id
	WHERE t.type_id = pt.type_id
	ORDER BY defense DESC, hp+attack+spe_attack+spe_defense+speed DESC, pokedex_number ASC
	LIMIT 1) AS 'Défense',
	(SELECT p.name
	FROM pokemon p
	JOIN base_stat b ON p.pokemon_id = b.pokemon_id
	JOIN pokemon_type pt ON p.pokemon_id = pt.pokemon_id
	WHERE t.type_id = pt.type_id
	ORDER BY spe_attack DESC, hp+attack+defense+spe_defense+speed DESC, pokedex_number ASC
	LIMIT 1) AS 'Spé. Attaque',
	(SELECT p.name
	FROM pokemon p
	JOIN base_stat b ON p.pokemon_id = b.pokemon_id
	JOIN pokemon_type pt ON p.pokemon_id = pt.pokemon_id
	WHERE t.type_id = pt.type_id
	ORDER BY spe_defense DESC, hp+attack+defense+spe_attack+speed DESC, pokedex_number ASC
	LIMIT 1) AS 'Spé. Défense',
	(SELECT p.name
	FROM pokemon p
	JOIN base_stat b ON p.pokemon_id = b.pokemon_id
	JOIN pokemon_type pt ON p.pokemon_id = pt.pokemon_id
	WHERE t.type_id = pt.type_id
	ORDER BY speed DESC, hp+attack+defense+spe_attack+spe_defense DESC, pokedex_number ASC
	LIMIT 1) AS 'Vitesse'
FROM type t


`;

module.exports = q14;
