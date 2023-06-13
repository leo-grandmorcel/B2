SELECT i.InvoiceId, i.Total, 
	CASE
		   WHEN i.Total < 5 THEN 'Price lower than 5$'
		   WHEN i.Total < 10 THEN 'Price lower than 10$'
		   ELSE 'Price greater than 10$'
	END
AS 'CASE'
FROM invoices i
LIMIT 100