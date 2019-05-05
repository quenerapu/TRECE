CREATE TRIGGER `serialize_blogpost_title` BEFORE INSERT ON `inconceivable_blog` FOR EACH ROW BEGIN
     DECLARE original_title varchar(255);
     DECLARE original_url_title varchar(255);
     DECLARE title_counter int;
     SET original_title = new.title;
     SET original_url_title = new.url_title;
     SET title_counter = 1;
     WHILE EXISTS (SELECT true FROM `inconceivable_blog` WHERE title = new.title) DO
        SET new.title = CONCAT(original_title, '_', title_counter);
        SET new.url_title = CONCAT(original_url_title, '_', title_counter);
        SET title_counter = title_counter + 1;
     END WHILE;
END;
