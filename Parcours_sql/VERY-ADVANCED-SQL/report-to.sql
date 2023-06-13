SELECT e.EmployeeId, e.FirstName || ' ' || e.LastName AS EmployeeName, m.FirstName || ' ' || m.LastName AS ReportsTo
FROM employees e
LEFT JOIN employees m ON e.ReportsTo = m.EmployeeId