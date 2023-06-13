SELECT e.LastName, e.FirstName,

(SELECT count(*) FROM invoices) AS 'Total Sell',
 
(SELECT count(*) FROM invoices i
	INNER JOIN customers c ON c.CustomerId = i.CustomerId 
	WHERE c.SupportRepId = e.EmployeeId) AS 'Total Sell By Employee',
	
ifnull((SELECT BillingCountry FROM invoices i
	INNER JOIN customers c ON c.CustomerId = i.CustomerId
	WHERE c.SupportRepId = e.EmployeeId
	GROUP BY BillingCountry ORDER BY count(*) DESC LIMIT 1),'-') AS 'Country With Most Sales',
	
ifnull((SELECT g.Name FROM genres g
	INNER JOIN tracks t ON t.GenreId = g.GenreId
	INNER JOIN invoice_items inv ON inv.TrackId = t.TrackId
	INNER JOIN invoices i ON i.InvoiceId = inv.InvoiceId
	INNER JOIN customers c ON c.CustomerId = i.CustomerId
	WHERE c.SupportRepId = e.EmployeeId
	GROUP BY g.Name ORDER BY count(*) DESC LIMIT 1),'-') AS 'Most Genre Selled',

ifnull((SELECT md.Name FROM media_types md
	INNER JOIN tracks t ON t.MediaTypeId = md.MediaTypeId
	INNER JOIN invoice_items inv ON inv.TrackId = t.TrackId
	INNER JOIN invoices i ON i.InvoiceId = inv.InvoiceId
	INNER JOIN customers c ON c.CustomerId = i.CustomerId
	WHERE c.SupportRepId = e.EmployeeId
	GROUP BY md.MediaTypeId ORDER BY count(*) DESC LIMIT 1),'-') AS 'Most Media Type Selled',
	
CASE (SELECT ROUND(CAST(count(*) AS FLOAT) * 100 / (
		SELECT Sell
		FROM (
			SELECT count(*) AS Sell,
			rank() OVER ( ORDER BY sum(i.Total) DESC) AS seller_rank
			FROM invoices i
			JOIN customers c ON c.CustomerId = i.CustomerId
			JOIN employees e ON e.EmployeeId = c.SupportRepId
			GROUP BY e.EmployeeId)
			WHERE seller_rank = 1),2) 
		FROM invoices i
		INNER JOIN customers c ON c.CustomerId = i.CustomerId 
		WHERE c.SupportRepId = e.EmployeeId
	)
	WHEN 100.0 THEN '-'
	WHEN 0.0 THEN '-'
	ELSE (SELECT ROUND(CAST(count(*) AS FLOAT) * 100 / (
		SELECT Sell
		FROM (
			SELECT count(*) AS Sell,
			rank() OVER ( ORDER BY sum(i.Total) DESC) AS seller_rank
			FROM invoices i
			JOIN customers c ON c.CustomerId = i.CustomerId
			JOIN employees e ON e.EmployeeId = c.SupportRepId
			GROUP BY e.EmployeeId)
			WHERE seller_rank = 1),2) 
		FROM invoices i
		INNER JOIN customers c ON c.CustomerId = i.CustomerId 
		WHERE c.SupportRepId = e.EmployeeId)
	END
	AS 'Percentage sales compared best seller'

FROM employees e

GROUP BY e.EmployeeId