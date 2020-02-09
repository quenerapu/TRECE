CREATE TRIGGER `inconceivable_organizations_serialize_url_name` BEFORE INSERT ON `inconceivable_organizations` FOR EACH ROW BEGIN
     DECLARE original_url_name varchar(200);
     DECLARE url_name_counter int;
     SET original_url_name = new.url_name;
     SET url_name_counter = 1;
     WHILE EXISTS (SELECT true FROM `inconceivable_organizations` WHERE url_name = new.url_name) DO
        SET new.url_name = CONCAT(original_url_name, '-', url_name_counter);
        SET url_name_counter = url_name_counter + 1;
     END WHILE;
END;
