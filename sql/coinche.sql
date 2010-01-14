

CREATE TABLE donne (
	pkid		INT NOT NULL AUTO_INCREMENT,
	fkpartieid	SMALLINT NOT NULL ,
	score1		NUMERIC(4,0) NOT NULL,
	score2		NUMERIC(4,0) NOT NULL,
	vtype		VARCHAR(2),
	coinche		NUMERIC(1,0) DEFAULT 0,
	scoinche	NUMERIC(1,0) DEFAULT 0,
	UNIQUE PK_ID (pkid)
);