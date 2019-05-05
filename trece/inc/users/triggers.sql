CREATE TRIGGER `serialize_username` BEFORE INSERT ON `inconceivable_users` FOR EACH ROW BEGIN
     DECLARE original_username varchar(255);
     DECLARE original_email varchar(255);
     DECLARE username_counter int;
     SET original_username = new.username;
     SET original_email = new.email;
     SET username_counter = 1;
     WHILE EXISTS (SELECT true FROM `inconceivable_users` WHERE username = new.username) DO
        SET new.username = CONCAT(original_username, '_', username_counter);
        SET new.email = CONCAT(original_email, '_', username_counter);
        SET username_counter = username_counter + 1;
     END WHILE;
END;
