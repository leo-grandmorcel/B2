const q2 = `SELECT name AS 'Pokemon', height || ' m' AS Taille, weight || ' kg' AS Poids
FROM pokemon
WHERE height = (SELECT height FROM pokemon WHERE pokemon_id = 542)
ORDER BY weight ASC`;

module.exports = q2;
