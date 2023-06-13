SELECT Country, count(*) AS Total
FROM (
	SELECT Country from employees
	UNION ALL
	SELECT Country from customers
	UNION ALL
	SELECT BillingCountry from invoices)
GROUP by Country