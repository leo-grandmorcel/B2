SELECT Name, Title AS AlbumTitle FROM artists
LEFT JOIN albums ON albums.ArtistId = artists.ArtistId
LIMIT 100;