-- inserting the new client record into the database

INSERT INTO clients ( 
    clientFirstname, 
    clientLastname, 
    clientEmail, 
    clientPassword, 
    comment 
) VALUES ( 
    'Tony', 
    'Stark', 
    'tony@starkent.com', 
    'Iam1ronM@n', 
    'I am the real Ironman' 
);

-- incrementing the client level by 3

UPDATE clients SET clientLevel = '3' WHERE clientId = 1;

-- Looking for what we have in the description field

SELECT invDescription FROM inventory
WHERE invMake = 'GM' AND invModel = 'Hummer';

-- updating the invDescription field to replace 'small interior' with 'spacious interior'

UPDATE inventory 
SET invDescription = replace(invDescription, 'small interior', 'spacious interior')
WHERE invMake = 'GM' AND invModel = 'Hummer';

-- making the inner join between the inventory and the carclassification tables

SELECT i.invModel, c.classificationName
FROM inventory i
INNER JOIN carclassification c
ON i.classificationId = c.classificationId
WHERE c.classificationName = 'SUV';

-- Deleteing the jeep wrangler from the inventory

DELETE FROM inventory
WHERE invMake = 'Jeep' AND invModel = 'Wrangler';

-- updating the path for the img file

UPDATE inventory
SET invThumbnail = CONCAT('/phpmotors', invThumbnail);

UPDATE inventory
SET invImage = CONCAT('/phpmotors', invImage);