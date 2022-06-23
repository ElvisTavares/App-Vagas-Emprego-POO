CREATE TABLE `vagas`.`vaga` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(255) NULL,
  `descricao` TEXT NULL,
  `ativo` ENUM('s', 'n') NULL,
  `data` TIMESTAMP NULL,
  PRIMARY KEY (`id`)
  
  );
