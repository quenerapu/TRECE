CREATE TRIGGER `inconceivable_serialize_bloglabel_name` BEFORE INSERT ON `inconceivable_bloglabels` FOR EACH ROW BEGIN
     DECLARE original_name_en varchar(191);
     DECLARE original_url_name_en varchar(191);
     DECLARE name_en_counter int;
     SET original_name_en = new.name_en;
     SET original_url_name_en = new.url_name_en;
     SET name_en_counter = 1;
     WHILE EXISTS (SELECT true FROM `inconceivable_bloglabels` WHERE name_en = new.name_en) DO
        SET new.name_en = CONCAT(original_name_en, ' ', name_en_counter);
        SET new.url_name_en = CONCAT(original_url_name_en, '_', name_en_counter);
        SET name_en_counter = name_en_counter + 1;
     END WHILE;
END;
