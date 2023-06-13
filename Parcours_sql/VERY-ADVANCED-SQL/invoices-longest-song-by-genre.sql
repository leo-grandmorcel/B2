SELECT i.InvoiceId
FROM invoices i
JOIN invoice_items iv ON iv.InvoiceId = i.InvoiceId
JOIN tracks t ON t.TrackId = iv.TrackId
WHERE t.TrackId IN (SELECT id_longest_song_by_genre
FROM (
	SELECT t.TrackId AS id_longest_song_by_genre, max(t.Milliseconds), g.Name
	FROM tracks t
	JOIN genres g ON t.GenreId = g.GenreId
	GROUP BY g.Name))
GROUP BY i.InvoiceId