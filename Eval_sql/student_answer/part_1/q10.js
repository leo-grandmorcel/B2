const q10 = `SELECT t.name AS 'Type', 
	(SELECT name 
	FROM move
	WHERE power = (SELECT max(power) FROM move WHERE type_id = t.type_id)
	AND type_id=t.type_id) AS 'Meilleure capacité',
	(SELECT power
	FROM move
	WHERE power = (SELECT max(power) FROM move WHERE type_id = t.type_id)) AS 'Meilleure puissance',
	(SELECT name 
	FROM move
	WHERE power = (SELECT min(power) FROM move WHERE type_id = t.type_id)
	AND type_id=t.type_id) AS 'Pire capacité',
	(SELECT power
	FROM move
	WHERE power = (SELECT min(power) FROM move WHERE type_id = t.type_id)) AS 'Pire puissance'
FROM type t
`;

module.exports = q10;
