SELECT i.InvoiceId,ROUND(AVG(t.UnitPrice),2) AS 'Average Price', 
	sum(t.Milliseconds)/ 1000 AS 'Track Total Time', 
	ROUND(AVG(t.UnitPrice)/(sum(t.Milliseconds)/1000) , 5) || '€' AS 'Price by second'
FROM invoices i
JOIN invoice_items iv ON iv.InvoiceId = i.InvoiceId
JOIN tracks t ON t.TrackId = iv.TrackId
GROUP BY i.InvoiceId