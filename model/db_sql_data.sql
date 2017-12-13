-- -----------------------------------------------------
-- Data for table `frieseck_prava`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `frieseck_prava` (`id_prava`, `nazev`, `vaha`) VALUES (1, 'Administrator', 1);
INSERT INTO `frieseck_prava` (`id_prava`, `nazev`, `vaha`) VALUES (2, 'Recenzent', 2);
INSERT INTO `frieseck_prava` (`id_prava`, `nazev`, `vaha`) VALUES (3, 'Autor', 3);

COMMIT;


-- -----------------------------------------------------
-- Data for table `frieseck_uzivatele`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `frieseck_uzivatele` (`id_uzivatel`, `jmeno`, `login`, `heslo`, `email`, `id_prava`) VALUES (1, 'David Friesecký', 'frieseck', 'admin', 'frieseck@students.zcu.cz', 1);

COMMIT;

UPDATE db1_vyuka.frieseck_uzivatele SET id_prava = 1 WHERE id_uzivatel = 1;