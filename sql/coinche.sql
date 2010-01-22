
drop table partie;
drop table donne;
drop table joueur;

CREATE TABLE donne (
	pkid    INT NOT NULL AUTO_INCREMENT,
	fkpartieid SMALLINT NOT NULL ,
	score1  NUMERIC(4,0) NOT NULL,
	score2  NUMERIC(4,0) NOT NULL,
	vtype  VARCHAR(2),
	coinche NUMERIC(1,0) DEFAULT 0,
	scoinche NUMERIC(1,0) DEFAULT 0,
	donneur SMALLINT NOT NULL,
	annonceur SMALLINT NOT NULL,
	UNIQUE PK_DONNE_ID (pkid)
);

CREATE TABLE partie (
	pkid    INT NOT NULL AUTO_INCREMENT,
	dstart  DATETIME,
	dstop   DATETIME,
	j11     SMALLINT NOT NULL,
	j12     SMALLINT NOT NULL,
	j21     SMALLINT NOT NULL,
	j22     SMALLINT NOT NULL,
	UNIQUE PK_PARTIE_ID (pkid)
);

CREATE TABLE joueur (
	pkid INT NOT NULL AUTO_INCREMENT,
	nom VARCHAR(20),
	UNIQUE PK_JOUEUR_ID (pkid)
);

INSERT INTO joueur VALUES (1,'Fredo');
INSERT INTO joueur VALUES (2,'Marco');
INSERT INTO joueur VALUES (3,'Nico');
INSERT INTO joueur VALUES (4,'Olivier');