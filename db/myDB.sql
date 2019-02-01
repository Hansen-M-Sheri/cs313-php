//DB for Nvelopes

CREATE TABLE public.user
(
	id SERIAL NOT NULL PRIMARY KEY,
	fName VARCHAR(100) NOT NULL,
	lName VARCHAR(100) NOT NULL,
	password VARCHAR(100) NOT NULL,
	email VARCHAR(350) NOT NULL UNIQUE,
	secretQuestion1Answer VARCHAR(80) NOT NULL,
	secretQuestion2Answer VARCHAR(80) NOT NULL
);

CREATE TABLE public.envelope
(
	id SERIAL NOT NULL PRIMARY KEY,
	name VARCHAR(80) NOT NULL,
	description VARCHAR(80),
	color VARCHAR(30),
	warningAmount DECIMAL(15,2)

);

CREATE TABLE public.transaction
(
	id SERIAL NOT NULL PRIMARY KEY,
	envelopeID INT NOT NULL REFERENCES public.envelope(id),
	userID INT NOT NULL REFERENCES public.user(id),
	date DATE NOT NULL,
	details TEXT,
	amount DECIMAL(15,2)
);