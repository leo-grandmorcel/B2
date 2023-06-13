SELECT artists.Name AS ArtistName, albums.Title AS AlbumName, tracks.Name AS TrackName, ROUND(ROUND(tracks.Bytes,2)/1000000,2) || ' MB' AS MegaBytes
FROM artists
JOIN albums ON albums.ArtistId=artists.ArtistId
JOIN tracks ON tracks.AlbumId = albums.AlbumId
WHERE albums.Title='American Idiot'