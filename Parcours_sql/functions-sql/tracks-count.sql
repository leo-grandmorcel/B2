SELECT g.Name, COUNT(t.GenreId) AS NumberOfTracks
FROM genres g
JOIN tracks t ON t.GenreId = g.GenreId
GROUP BY g.Name