USE `epiz_34305586_solveit` ;

select * from Utente;


INSERT INTO `Settore` (`nomeSettore`) VALUES
('azienda');

INSERT INTO `Utente` ( `email`, `nome`, `username`, `idSettore`, `bio`) VALUES
('admin@blogtw.com', 'Admin Nimda', 'admin',1, 'Ingenere informatico senior'),
('sangio@blogtw.com', 'Gino Pino', 'sangio',1, 'Ingegnere informatico junior'),
('leo@blogtw.com', 'Cippa Lippa', 'leo',1, 'Full-stack developer'),
('tizz@blogtw.com', 'Chico Loco', 'tiz',1, 'Front-end soldier');

INSERT INTO `Utente` (`email`, `nome`, `cognome`, `dataNascita`, `telefono`, `username`, `bio`, `idSettore`) VALUES 
('john.doe@example.com', 'John', 'Doe', '1990-05-15', '1234567890', 'johndoe', 'Experienced software engineer with a passion for creating innovative solutions.',1),
('jane.smith@example.com', 'Jane', 'Smith', '1992-08-23', '0987654321', 'janesmith', 'Full-stack developer with expertise in front-end technologies and a knack for problem-solving.',1),
('michael.johnson@example.com', 'Michael', 'Johnson', '1988-11-07', '9876543210', 'michaeljohnson', 'Seasoned project manager with a track record of successfully delivering complex IT projects on time and within budget.',1),
('emily.wilson@example.com', 'Emily', 'Wilson', '1991-02-12', '0123456789', 'emilywilson', 'UI/UX designer with an eye for aesthetics and a passion for creating user-friendly interfaces.',1),
('david.brown@example.com', 'David', 'Brown', '1993-06-30', '6789012345', 'davidbrown', 'Skilled database administrator with expertise in optimizing database performance and ensuring data security.',1),
('olivia.jones@example.com', 'Olivia', 'Jones', '1995-09-18', '5432109876', 'oliviajones', 'Experienced systems analyst with a strong analytical mindset and a knack for identifying process improvements.',1),
('william.davis@example.com', 'William', 'Davis', '1989-12-03', '8901234567', 'williamdavis', 'Network engineer with expertise in designing and implementing secure and scalable network infrastructure.',1),
('sophia.miller@example.com', 'Sophia', 'Miller', '1994-03-20', '7654321098', 'sophiamiller', 'Skilled software tester with a keen attention to detail and a passion for ensuring quality in every software release.',1),
('alexander.wilson@example.com', 'Alexander', 'Wilson', '1996-06-08', '3210987654', 'alexanderwilson', 'IT support specialist with a customer-centric approach and a knack for troubleshooting complex technical issues.',1),
('abigail.anderson@example.com', 'Abigail', 'Anderson', '1998-09-26', '5678901234', 'abigailanderson', 'Experienced IT consultant with expertise in advising clients on technology strategy and driving digital transformation.',1),
('james.thomas@example.com', 'James', 'Thomas', '1997-12-13', '0987654321', 'jamesthomas', 'Web developer with a passion for creating visually appealing and responsive websites using the latest web technologies.',1),
('mia.johnson@example.com', 'Mia', 'Johnson', '1993-03-01', '2345678901', 'miajohnson', 'Experienced data scientist with expertise in analyzing large datasets and deriving actionable insights to drive business growth.',1),
('ethan.harris@example.com', 'Ethan', 'Harris', '1991-06-17', '7890123456', 'ethanharris', 'Cybersecurity expert with a deep understanding of threat landscapes and a passion for implementing robust security measures.',1),
('amelia.martin@example.com', 'Amelia', 'Martin', '1989-09-04', '4567890123', 'ameliamartin', 'Experienced software architect with a proven track record of designing scalable and maintainable software solutions.',1),
('benjamin.thompson@example.com', 'Benjamin', 'Thompson', '1992-12-21', '9012345678', 'benjaminthompson', 'DevOps engineer with expertise in automating the software development lifecycle and ensuring seamless deployments.',1),
('charlotte.lewis@example.com', 'Charlotte', 'Lewis', '1994-03-08', '5678901234', 'charlottelewis', 'Experienced IT trainer with a passion for empowering individuals and teams with the latest technology skills.',1),
('henry.hall@example.com', 'Henry', 'Hall', '1990-06-24', '2345678901', 'henryhall', 'Experienced IT manager with a proven track record of leading and motivating cross-functional teams to deliver outstanding results.',1),
('lily.walker@example.com', 'Lily', 'Walker', '1993-09-11', '7890123456', 'lilywalker', 'Experienced business analyst with expertise in gathering requirements and translating them into effective IT solutions.',1),
('daniel.lee@example.com', 'Daniel', 'Lee', '1991-12-28', '9012345678', 'daniellee', 'Experienced software engineer specializing in backend development and database management.',1),
('sophia.green@example.com', 'Sophia', 'Green', '1995-03-15', '3456789012', 'sophiagreen', 'UI/UX designer with a passion for creating visually stunning and intuitive user interfaces.',1);

INSERT INTO `Credenziali` ( `password`, `idUtente`) VALUES
('admin', '1'),
('sangio', '2'),
('leo', '3'),
('tiz', '4');

INSERT INTO `Amicizia` (`idSeguace`, `idSeguito`, `timestamp`)
VALUES
(1, 2, '2022-01-01 10:30:00'),
(1, 3, '2022-01-02 15:45:00'),
(1, 4, '2022-01-03 09:15:00'),
(1, 5, '2022-01-04 12:00:00'),
(1, 6, '2022-01-05 17:20:00'),
(2, 3, '2022-01-06 11:10:00'),
(2, 4, '2022-01-07 14:30:00'),
(2, 5, '2022-01-08 16:40:00'),
(2, 6, '2022-01-09 13:25:00'),
(3, 4, '2022-01-10 18:05:00'),
(3, 5, '2022-01-11 10:50:00'),
(3, 6, '2022-01-12 15:15:00'),
(4, 5, '2022-01-13 09:40:00'),
(4, 6, '2022-01-14 12:55:00'),
(5, 6, '2022-01-15 17:00:00'),
(1, 7, '2022-01-16 11:45:00'),
(1, 8, '2022-01-17 14:20:00'),
(1, 9, '2022-01-18 16:35:00'),
(1, 10, '2022-01-19 13:15:00'),
(2, 7, '2022-01-20 18:30:00'),
(2, 8, '2022-01-21 10:25:00'),
(2, 9, '2022-01-22 12:50:00'),
(2, 10, '2022-01-23 17:10:00'),
(3, 7, '2022-01-24 11:55:00'),
(3, 8, '2022-01-25 14:40:00'),
(3, 9, '2022-01-26 16:55:00'),
(3, 10, '2022-01-27 13:35:00'),
(4, 7, '2022-01-28 18:50:00'),
(4, 8, '2022-01-29 10:45:00'),
(4, 9, '2022-01-30 12:30:00'),
(4, 10, '2022-01-31 15:55:00'),
(5, 7, '2022-02-01 09:20:00'),
(5, 8, '2022-02-02 11:35:00'),
(5, 9, '2022-02-03 14:00:00'),
(5, 10, '2022-02-04 16:15:00'),
(6, 7, '2022-02-05 12:55:00'),
(6, 8, '2022-02-06 17:10:00'),
(6, 9, '2022-02-07 09:35:00'),
(6, 10, '2022-02-08 11:50:00'),
(7, 8, '2022-02-09 15:15:00'),
(7, 9, '2022-02-10 17:30:00'),
(7, 10, '2022-02-11 13:10:00'),
(8, 9, '2022-02-12 18:25:00'),
(8, 10, '2022-02-13 10:20:00'),
(9, 10, '2022-02-14 12:45:00');


INSERT INTO `Post` (`idSettore`, `titolo`, `testo`, `timestamp`) VALUES
(1, 'Il mio Post su SolveIt!', 'Se vi capita questo allora fate quest\'altro e via track track tutto funziona!','2023-07-01 21:19:03');


INSERT INTO `Pubblicazione` (`idUtente`, `idPost`) VALUES
(2, 1);


INSERT INTO `Tag` (`nome`) VALUES
('GUI'),
('Back-end'),
('Front-end'),
('Werehouse'),
('R&D'),
('Hardware'),
('Pallet'),
('Network'),
('Documentation'),
('C++'),
('Welds'),
('AI'),
('Compilation'),
('UI/UX Design'),
('Clang'),
('Project Management');


INSERT INTO `Etichettamento` (`idPost`, `idTag`) VALUES
(1, 2);

INSERT INTO `Commento` (`idPost`, `idUtente`, `testo`, `timestamp`) VALUES
(1, 1, 'bel Post, caspita un botto utile!', '2023-07-01 21:19:03'),
(1, 2, 'Lo sapevamo già', '2023-07-01 21:19:03');

INSERT INTO `Commento` (`idPost`, `idUtente`,`idCommentoPadre`, `testo`, `timestamp`) VALUES 
(1, 1, null, 'This post was very helpful in solving my issue.', '2023-08-29 10:15:00'),
(1, 2, null, 'The information provided here didn\'t really help.', '2023-08-29 11:30:00'),
(1, 3, null, 'I found this post to be quite useful.', '2023-08-29 12:45:00'),
(1, 4, null, 'Not what I was looking for. This post didn\'t help.', '2023-08-29 14:00:00'),
(1, 5, null, 'Thanks for sharing this. It resolved my problem.', '2023-08-29 15:15:00'),
(1, 6, null, 'I disagree, this post wasn\'t helpful at all.', '2023-08-29 16:30:00'),
(1, 7, null,'This post provided a great solution for my IT issue.', '2023-08-29 17:45:00'),
(1, 8, null, 'I didn\'t find any useful information here.', '2023-08-29 18:00:00'),
(1, 9, null, 'The suggestions in this post were spot on. It helped.', '2023-08-29 19:15:00'),
(1, 10, null, 'Not impressed. The post didn\'t offer anything useful.', '2023-08-29 20:30:00'),
(1, 11, null, 'I followed the steps mentioned, but it didn\'t work.', '2023-08-29 21:45:00'),
(1, 12, null, 'This post saved my day. Issue resolved.', '2023-08-29 22:00:00'),
(1, 13, null, 'I wasted my time reading this. It wasn\'t helpful.', '2023-08-29 23:15:00'),
(1, 14, null, 'Excellent post! Cleared up my IT problem.', '2023-08-30 10:30:00'),
(1, 15, null, 'I\'m still stuck with my issue. This post didn\'t help.', '2023-08-30 11:45:00'),
(1, 16, null, 'Great explanation. My problem is resolved now.', '2023-08-30 12:00:00'),
(1, 17, null, 'Didn\'t find relevant information. Not useful.', '2023-08-30 13:15:00'),
(1, 18, null, 'This post deserves appreciation. It fixed my IT issue.', '2023-08-30 14:30:00'),
(1, 19, null, 'I regret reading this. It didn\'t provide any solution.', '2023-08-30 15:45:00'),
(1, 20, null, 'This post lacked crucial details. Wasn\'t helpful.', '2023-08-30 16:00:00');

INSERT INTO `MiPiace` (`idPost`, `idUtente`) VALUES
(1, 1),
(1, 2);

INSERT INTO `Notifica` (`idNotificatore`, `idNotificato`, `idPost`, `tipo`, `letta`, `timestamp`) VALUES
(2, 1, 1, 0, 0, '2023-07-01 21:19:03'),
(3, 1, 1, 1, 0, '2023-07-01 21:19:03'),
(2, 1, 1, 2, 0, '2023-07-01 21:19:03'),
(3, 1, 1, 3, 0, '2023-07-01 21:19:03'),
(2, 1, 1, 4, 0, '2023-07-01 21:19:03');

select * from Post;
select * from Pubblicazione;
select * from Allegato;
select * from Post;
select * from Settore;
select * from Utente;
select * from Credenziali;
select * from Tag;
select * from Etichettamento;
select * from Commento;
select * from MiPiace;
select * from Notifica;
select * from Amicizia;


SELECT idNotifica as notificationId, idNotificatore as notifacatorId, letta as isRead, tipo as type, idPost as postId, timestamp
        FROM Notifica
        where idNotificato = 1 and letta = 0;

SELECT p.idPost as postId, u.idUtente as authorId, u.username as authorName, p.titolo as title, p.testo as text, s.nomeSettore as sector, p.timestamp as timestamp
        FROM Post as p, Settore as s, Pubblicazione as pub, Utente as u
        where p.idPost = 1
        and p.idPost = pub.idPost and p.idSettore = s.idSettore and pub.idUtente = u.idUtente and pub.collaboratore = 0;
# idPost --> idTag, Tag
SELECT t.idTag, nome as Tag
		FROM Tag as t, Etichettamento as e
		where e.idPost = 1 and e.idTag = t.idTag;
        
# idPost --> idAllegato, Allegato[bytes], tipo
SELECT a.idAllegato, data as Allegato, tipo
        FROM Allegato as a
        where a.idPost = 1;
        
# idPost --> idUtente, username
SELECT u.idUtente, username
        FROM Utente as u, Pubblicazione as p
        where p.idPost = 1 and p.idUtente = u.idUtente;
        
# prefix ---> idUtente, nome, cognome, username, idSettore
SELECT * 
		FROM Utente
		where username LIKE 'l%';
        
# idUtente --> idUtente, nome, cognome, username, idSettore, inizioAmicizia
SELECT u.idUtente, u.nome, u.cognome, u.username, u.idSettore, a.timestamp as inizioAmicizia
        FROM Utente as u, Amicizia as a
        where u.idUtente = a.idSeguito and a.idSeguace = 1;

#idUtente --> idPubblicazione, idPost, comeCollaboratore
SELECT idPubblicazione, idPost, collaboratore as comeCollaboratore
        FROM Pubblicazione as p
        where idUtente = 2;
        
#username,password --> idUtente, username, nome
SELECT u.idUtente, username, nome 
        FROM Utente as u, Credenziali as c 
        WHERE u.idUtente = c.idUtente and u.username = "sangio" and c.password = "admin";
