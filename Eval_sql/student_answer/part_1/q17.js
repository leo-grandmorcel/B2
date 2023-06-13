const q17 = `SELECT t.name AS 'Type',
	(SELECT count(m.move_id) 
	FROM move m
	WHERE t.type_id = m.type_id) AS 'Nombre capacités',
	(ROUND(100.0 * (SELECT count(m.move_id)
	FROM move m
	WHERE t.type_id = m.type_id
	AND m.accuracy = 100) / (SELECT count(m.move_id) 
	FROM move m
	WHERE t.type_id = m.type_id),2) || '%') AS 'Capacité précision 100%',
	(ROUND(100.0 * (SELECT count(m.move_id)
	FROM move m
	WHERE t.type_id = m.type_id
	AND m.category = 'Physique') / (SELECT count(m.move_id) 
	FROM move m
	WHERE t.type_id = m.type_id),2) || '%') AS 'Pourcentage capacité physique',
	(ROUND(100.0 * (SELECT count(m.move_id)
	FROM move m
	WHERE t.type_id = m.type_id
	AND m.category = 'Spéciale') / (SELECT count(m.move_id) 
	FROM move m
	WHERE t.type_id = m.type_id),2) || '%') AS 'Pourcentage capacité spéciale',
	(ROUND(100.0 * (SELECT count(m.move_id)
	FROM move m
	WHERE t.type_id = m.type_id
	AND m.category = 'Statut') / (SELECT count(m.move_id) 
	FROM move m
	WHERE t.type_id = m.type_id),2) || '%') AS 'Pourcentage capacité statut',
	(ROUND(100.0 * (SELECT count(m.move_id)
	FROM move m
	WHERE t.type_id = m.type_id
	AND m.power NOT NULL
	AND m.power <= 40) / (SELECT count(m.move_id) 
	FROM move m
	WHERE t.type_id = m.type_id),2) || '%') AS 'Pourcentage capacité faible',
		(ROUND(100.0 * (SELECT count(m.move_id)
	FROM move m
	WHERE t.type_id = m.type_id
	AND m.power NOT NULL
	AND m.power >= 100) / (SELECT count(m.move_id) 
	FROM move m
	WHERE t.type_id = m.type_id),2) || '%') AS 'Pourcentage capacité forte'
FROM type t`;

module.exports = q17;
