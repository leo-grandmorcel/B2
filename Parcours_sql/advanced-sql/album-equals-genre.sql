SELECT *
FROM albums
WHERE Title IN ( SELECT genres.Name FROM genres)