SELECT e.FirstName || ' ' || upper(e.LastName) AS FullName, COUNT(c.SupportRepId) AS NumberOfCustomers
FROM employees e
JOIN customers c ON e.EmployeeId = c.SupportRepId
WHERE e.Title = 'Sales Support Agent'
GROUP BY FullName
ORDER BY NumberOfCustomers ASC