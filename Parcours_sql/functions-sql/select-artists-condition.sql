SELECT Name
FROM artists
JOIN albums ON artists.ArtistId = albums.ArtistId
GROUP BY Name
HAVING count(Name) >= 4
ORDER BY Name DESC