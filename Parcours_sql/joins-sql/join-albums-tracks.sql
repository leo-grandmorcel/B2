SELECT Title AS AlbumName, Name AS TrackName, Milliseconds
FROM albums
JOIN tracks WHERE albums.AlbumId = tracks.AlbumId
ORDER BY Milliseconds
LIMIT 50;