SELECT FirstName,LastName FROM customers WHERE Country = 'USA' AND SupportRepId = (SELECT EmployeeId FROM employees WHERE LastName = 'Peacock' AND FirstName = 'Jane');