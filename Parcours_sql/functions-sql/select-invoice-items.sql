SELECT invoices.InvoiceId, tracks.name AS InvoiceItem, invoice_items.UnitPrice
FROM invoices
JOIN invoice_items ON invoice_items.InvoiceId = invoices.InvoiceId
JOIN tracks ON tracks.TrackId = invoice_items.TrackId
WHERE invoices.InvoiceId = 10
ORDER BY InvoiceItem