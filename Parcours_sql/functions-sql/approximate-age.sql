SELECT FirstName, LastName, date(HireDate)- date(BirthDate) AS ApproximateAge
FROM employees
ORDER BY ApproximateAge ASC