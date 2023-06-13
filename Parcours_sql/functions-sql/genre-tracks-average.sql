SELECT g.Name, AVG(t.Milliseconds) AS AverageDuration
FROM genres g
JOIN tracks t ON t.GenreId = g.GenreId
GROUP BY g.name
ORDER BY AverageDuration DESC