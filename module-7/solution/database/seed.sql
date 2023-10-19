USE modphp;

INSERT INTO user (username, password_hash, firstname, lastname, email, prefered_supervisor, prefered_room)
VALUES
  ('user1', '$2y$10$5.NMLXWSZqf.w/85D60cKeNnZEmmZ7uyWCwLmHHETaQJT3BzOt7zO', 'Torkel', 'Ivarsøy', 'torkel@uia.no', 1, 12),
  ('user2', '$2y$10$5.NMLXWSZqf.w/85D60cKeNnZEmmZ7uyWCwLmHHETaQJT3BzOt7zO', 'Siddharth', 'Dushantha', 'sid@uia.no', 1, 45),
  ('user3', '$2y$10$5.NMLXWSZqf.w/85D60cKeNnZEmmZ7uyWCwLmHHETaQJT3BzOt7zO', 'John', 'Doe', 'john@uia.no', 2, 45);

INSERT INTO supervisor (username, password_hash, firstname, lastname, email)
VALUES
  ('supervisor1', '$2y$10$5.NMLXWSZqf.w/85D60cKeNnZEmmZ7uyWCwLmHHETaQJT3BzOt7zO', 'Bob', 'Smith', 'bob@uia.no'),
  ('supervisor2', '$2y$10$5.NMLXWSZqf.w/85D60cKeNnZEmmZ7uyWCwLmHHETaQJT3BzOt7zO', 'Alice', 'Smith', 'alice@uia.no');

INSERT INTO booking (supervisor_id, user_id, time, subject, description, room)
VALUES
  (1, 1, '2023-11-05 10:00:00', 'Utveksling', 'Økonomiske vanskeligheter', 12),
  (1,1,'2023-11-11 17:00:00','valg fag', 'hjelp til valg av valg-fag', 45),
  (1, 2, '2023-12-02 14:30:00', 'Master', 'Mine muligheter', 45),
  (1,2,'2023-11-23 17:00:00','valg fag', 'hjelp til valg av valg-fag', 44)