CREATE TRIGGER `inconceivable_serialize_location_name` BEFORE INSERT ON `inconceivable_locations` FOR EACH ROW BEGIN
     DECLARE original_name varchar(191);
     DECLARE name_counter int;
     SET original_name = new.name;
     SET name_counter = 1;
     WHILE EXISTS (SELECT true FROM `inconceivable_locations` WHERE name = new.name) DO
        SET new.name = CONCAT(original_name, ' ', name_counter);
        SET name_counter = name_counter + 1;
     END WHILE;
END;
