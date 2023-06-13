SELECT upper(LastName) AS LastNameUpper, FirstName 
FROM customers
WHERE length(LastName) > 5 
AND length(FirstName) > 5
ORDER BY LastName 