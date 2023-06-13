SELECT full_name AS '3rd best seller'
FROM (
	SELECT e.LastName || ' ' || e.FirstName AS full_name,
	rank() OVER ( ORDER BY sum(i.Total) DESC) AS seller_rank
	FROM employees e
	JOIN customers c ON e.EmployeeId = c.SupportRepId
	JOIN invoices i ON i.CustomerId = c.CustomerId
	GROUP BY e.EmployeeId)
WHERE seller_rank = 3