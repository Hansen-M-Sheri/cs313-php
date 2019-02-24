-- DB for Nvelopes

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


//VERIFY EMAIL EXISTS IN DB
$stmt = $db->prepare('SELECT email FROM public.user WHERE email=:email');
				$stmt->bindValue(':email', $email);
				$stmt->execute();
				$rowsArray = $stmt->fetchALL(PDO::FETCH_ASSOC);
				
<--insert user into database-->
$sql = 'INSERT INTO public.user (fName, lName, email, password, secretquestion1answer, secretquestion2answer) VALUES (:fName, :lName, :email, :hashedPwd, :secret1, :secret2)';
					$stmt = $db->prepare($sql);

					//pass values to statement
					$stmt->bindValue(':fName', $fName);
					$stmt->bindValue(':lName', $lName);
					$stmt->bindValue(':email', $email);
					$stmt->bindValue(':hashedPwd', $hashedPwd);
					$stmt->bindValue(':secret1', $secret1);
					$stmt->bindValue(':secret2', $secret2);
					
					$stmt->execute();

					$id =  $db->lastInsertID('user_id_seq');
					
<--insert user into database-->
$sql = 'INSERT INTO public.transaction (envelopeid, userid, date, details, amount) VALUES (:envelopeID, :userID, :date, :details, :amount)';
					$stmt = $db->prepare($sql);

					//pass values to statement
					$stmt->bindValue(':fName', 1);
					$stmt->bindValue(':userID', 1);
					$stmt->bindValue(':date', '1/1/19');
					$stmt->bindValue(':details', 'Maverick');
					$stmt->bindValue(':amount', '50.00');
					
					
					$stmt->execute();

					$id =  $db->lastInsertID('transaction_id_seq');
					
					
					
<!-- if sessionId is set, get all envelopes from userID (stored in session)-->
SELECT
 envelopeid,
 SUM (amount) AS total
FROM
 public.transaction
 WHERE
 userid = 1
GROUP BY
 envelopeid;


--  SUM the envelope total 
 SELECT envelopeid, envelope.name, SUM (amount) AS total FROM public.transaction INNER JOIN public.envelope 
 ON transaction.envelopeid = envelope.id WHERE userid=1 GROUP BY transaction.envelopeid;
 
 SELECT envelopeid, name, SUM (amount) AS total FROM public.transaction CROSS JOIN public.envelope WHERE userid=1 GROUP BY envelopeid;
 
 SELECT
 name,
 SUM (amount) AS total
FROM
 public.transaction
 INNER JOIN public.envelope
 ON transaction.envelopeid = envelope.id
 WHERE
 userid = 1
GROUP BY
 name;
-- GET envelope for 1 user and 1 envelope (transactions table)
SELECT
	SUM (amount) AS total
	FROM
		public.transaction
	WHERE
		envelopeid = :envelopeID
	AND
		 userid = :userID;
				  
 SELECT
 envelope.id,
 color,
 name,
 SUM (amount) AS total
FROM
 public.transaction
 INNER JOIN public.envelope
 ON transaction.envelopeid = envelope.id
 WHERE
 userid = 1
GROUP BY
 name, envelope.id;
 
 SELECT 
  name, 
  date,
  details,
  amount
 FROM 
 public.transaction
 
 SELECT id FROM envelope WHERE name='Gas';
 INSERT INTO transactions(envelopeid, userid, date, details, amount) VALUES (:envelopeID, :userID, :date, :details, :amount);
 
--  update/edit envelope settings
UPDATE public.envelope SET description='groceries' WHERE id=2;