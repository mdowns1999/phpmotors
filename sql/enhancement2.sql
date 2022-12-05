-- http://youtu.be/qDBK98ymH1s?hd=1
--Query 1
INSERT INTO clients (clientId, clientFirstName, clientLastName, clientEmail, clientPassword, clientLevel, comment) 
VALUES ("1","Tony","Stark","tony@starkent.com", "Iam1ronM@n", '1', "I am the real Ironman");

-- Query 2
UPDATE clients
SET clientLevel = 3
WHERE clientFirstName = "Tony" AND clientLastName = "Stark";


--Query 3
UPDATE inventory
SET invDescription = REPLACE(invDescription, "small", "spacious")
WHERE invId = 12;


--Query 4
SELECT invModel FROM inventory i
INNER JOIN carclassification c
ON c.classificationId = i.classificationId
WHERE c.classificationName = "SUV";


--Query 5
DELETE FROM inventory
WHERE invMake = "Jeep" AND invModel = "Wrangler";


--Query 6
UPDATE inventory
SET invImage = CONCAT("/phpmotors", invImage) , invThumbnail = CONCAT("/phpmotors", invThumbnail);