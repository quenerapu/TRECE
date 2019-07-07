CREATE TRIGGER `inconceivable_serialize_language_name` BEFORE INSERT ON `inconceivable_languages` FOR EACH ROW BEGIN
     DECLARE original_name varchar(255);
     DECLARE name_counter int;
     SET original_name = new.name;
     SET name_counter = 1;
     WHILE EXISTS (SELECT true FROM `inconceivable_languages` WHERE name = new.name) DO
        SET new.name = CONCAT(original_name, '_', name_counter);
        SET name_counter = name_counter + 1;
     END WHILE;
END;;
