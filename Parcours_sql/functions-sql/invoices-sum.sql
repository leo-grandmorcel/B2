SELECT SUM(inv.Total) AS AllInvoicesTotalPrice FROM invoices inv
JOIN customers cust ON inv.CustomerId = cust.CustomerId
WHERE cust.FirstName = 'Tim'
AND cust.LastName = 'Goyer'