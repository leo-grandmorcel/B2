SELECT Country, count(*) AS Total, 
(SELECT count(*) FROM employees WHERE c.Country = Country) AS 'Employees', 
(SELECT count(*) FROM customers WHERE c.Country = Country) AS 'Customers',
(SELECT count(*) FROM invoices WHERE c.Country = BillingCountry) AS 'Invoices'
FROM (
	SELECT Country from employees
	UNION ALL
	SELECT Country from customers
	UNION ALL
	SELECT BillingCountry from invoices) AS C
GROUP by Country