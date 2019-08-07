CREATE TRIGGER `inconceivable_serialize_pages_url_title` BEFORE INSERT ON `inconceivable_pages` FOR EACH ROW BEGIN
     DECLARE original_url_title varchar(200);
     DECLARE url_title_counter int;
     SET original_url_title = new.url_title;
     SET url_title_counter = 1;
     WHILE EXISTS (SELECT true FROM `inconceivable_pages` WHERE url_title = new.url_title) DO
        SET new.url_title = CONCAT(original_url_title, '-', url_title_counter);
        SET url_title_counter = url_title_counter + 1;
     END WHILE;
END;;
