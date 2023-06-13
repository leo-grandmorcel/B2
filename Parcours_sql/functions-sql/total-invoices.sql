SELECT FirstName || ' ' || upper(LastName ) AS FullName, sum(i.Total) AS AllInvoices
FROM customers c
JOIN invoices i ON c.CustomerId = i.CustomerId
GROUP BY FullName
HAVING AllInvoices > 38
ORDER BY FullName ASC