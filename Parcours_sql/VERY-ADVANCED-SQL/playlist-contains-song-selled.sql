SELECT p.PlaylistId, p.Name,
  IFNULL(ROUND((COUNT(pt.TrackId)* 100*1.0 / (SELECT COUNT(*) FROM playlist_track WHERE PlaylistId = p.PlaylistId)),4),0) AS '% song selled twice'
FROM playlists p
LEFT JOIN playlist_track pt ON p.PlaylistId = pt.PlaylistId
AND IFNULL(pt.TrackId,2) IN (
    SELECT TrackId
    FROM invoice_items
    GROUP BY TrackId
    HAVING COUNT(TrackId) = 2)
GROUP BY p.PlaylistId