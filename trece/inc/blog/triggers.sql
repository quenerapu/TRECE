CREATE TRIGGER `inconceivable_serialize_blogpost_url_title` BEFORE INSERT ON `inconceivable_blog` FOR EACH ROW BEGIN
     DECLARE original_url_title_en varchar(200);
     DECLARE url_title_en_counter int;
     SET original_url_title_en = new.url_title_en;
     SET url_title_en_counter = 1;
     WHILE EXISTS (SELECT true FROM `inconceivable_blog` WHERE url_title_en = new.url_title_en) DO
        SET new.url_title_en = CONCAT(original_url_title_en, '-', url_title_en_counter);
        SET url_title_en_counter = url_title_en_counter + 1;
     END WHILE;
END;
