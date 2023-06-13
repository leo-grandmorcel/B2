const q4 = `SELECT a.ability_id AS 'Id', a.name AS 'Talent', a.description AS 'Description'
FROM ability a
WHERE a.name LIKE '% %' OR a.name LIKE'%-%'
ORDER BY length(a.description)`;

module.exports = q4;
