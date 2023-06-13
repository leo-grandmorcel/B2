SELECT t.Name
FROM tracks t
JOIN invoice_items items ON items.TrackId = t.TrackId
JOIN invoices inv ON inv.InvoiceId = items.InvoiceId
WHERE InvoiceDate = (
	SELECT InvoiceDate 
	FROM invoices
	ORDER BY InvoiceDate DESC
	LIMIT 1
)