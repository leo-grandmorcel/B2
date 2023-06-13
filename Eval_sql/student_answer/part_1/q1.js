const q1 = `SELECT pokedex_number AS 'N°', name AS 'Pokemon',description AS 'Description'
FROM pokemon
WHERE length(description) <= 75
ORDER BY pokedex_number`;

module.exports = q1;
