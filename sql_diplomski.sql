CREATE DATABASE gh;
USE gh;
CREATE TABLE act(
	id int AUTO_INCREMENT NOT NULL PRIMARY KEY,
	act1 int DEFAULT 0,
	act2 int DEFAULT 0,
	act3 int DEFAULT 0,
	act4 int DEFAULT 0,
	behelterNiveau int DEFAULT 0,
	behelterMax int DEFAULT 0,
	behelterMin int DEFAULT 0,
	tempNiveau int DEFAULT 0,
	tempMax int DEFAULT 0,
	tempMin int DEFAULT 0
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO act(act1, act2, act3, act4, behelterNiveau,behelterMax, behelterMin, tempNiveau,tempMax, tempMin)
VALUES (0, 0, 0, 0, 50,70, 30, 50, 60, 40);

SELECT * FROM act;

UPDATE act SET act1 = 1 WHERE id = 1;