USE bookingsystem;

INSERT INTO user (username, password_hash, firstname, lastname, email, role)
VALUES
  ('user1', '$2y$10$5.NMLXWSZqf.w/85D60cKeNnZEmmZ7uyWCwLmHHETaQJT3BzOt7zO', 'Torkel', 'Ivarsøy', 'torkel@uia.no','user'),
  ('user2', '$2y$10$5.NMLXWSZqf.w/85D60cKeNnZEmmZ7uyWCwLmHHETaQJT3BzOt7zO', 'Siddharth', 'Dushantha', 'sid@uia.no','user'),
  ('user3', '$2y$10$5.NMLXWSZqf.w/85D60cKeNnZEmmZ7uyWCwLmHHETaQJT3BzOt7zO', 'John', 'Doe', 'john@uia.no','user'),
  ('supervisor1', '$2y$10$5.NMLXWSZqf.w/85D60cKeNnZEmmZ7uyWCwLmHHETaQJT3BzOt7zO', 'Bob', 'Smith', 'bob@uia.no','supervisor'),
  ('supervisor2', '$2y$10$5.NMLXWSZqf.w/85D60cKeNnZEmmZ7uyWCwLmHHETaQJT3BzOt7zO', 'Alice', 'Smith', 'alice@uia.no','supervisor');

INSERT INTO booking (supervisor_id, user_id, time, subject, description)
VALUES
  (4, 1, '2023-09-05 10:00:00', 'Utveksling', 'Økonomiske vanskeligheter'),
  (4,1,'2023-09-06 17:00:00','valg fag', 'hjelp til valg av valg-fag'),
  (5, 2, '2023-09-06 14:30:00', 'Master', 'Mine muligheter'),
  (5,2,'2023-09-06 17:00:00','valg fag', 'hjelp til valg av valg-fag')