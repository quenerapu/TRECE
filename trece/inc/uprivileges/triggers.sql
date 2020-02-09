CREATE TRIGGER `inconceivable_uprivileges_serialize_name_url_name` BEFORE INSERT ON `inconceivable_uprivileges` FOR EACH ROW BEGIN
     DECLARE original_name varchar(120);
     DECLARE original_url_name varchar(120);
     DECLARE name_counter int;
     SET original_name = new.name;
     SET original_url_name = new.url_name;
     SET name_counter = 1;
     WHILE EXISTS (SELECT true FROM `inconceivable_uprivileges` WHERE name = new.name) DO
        SET new.name = CONCAT(original_name, '_', name_counter);
        SET new.url_name = CONCAT(original_url_name, '_', name_counter);
        SET name_counter = name_counter + 1;
     END WHILE;
END;
