DELETE
FROM tracks
WHERE AlbumId IN ( SELECT AlbumId FROM Albums WHERE Title = 'Facelift')