SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`membres`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`membres` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `pseudo` VARCHAR(45) NULL ,
  `password` VARCHAR(45) NULL ,
  `mail` VARCHAR(255) NULL ,
  `sexe` VARCHAR(10) NULL ,
  `avatar` VARCHAR(255) NULL ,
  `birthday` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`images`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`images` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `url` VARCHAR(255) NULL ,
  `titre` VARCHAR(70) NULL ,
  `description` VARCHAR(255) NULL ,
  `membres_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_images_membres` (`membres_id` ASC) ,
  CONSTRAINT `fk_images_membres`
    FOREIGN KEY (`membres_id` )
    REFERENCES `mydb`.`membres` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`commentaires`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`commentaires` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `message` LONGTEXT NULL ,
  `timestamp` TIMESTAMP NULL ,
  `membres_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_commentaires_membres1` (`membres_id` ASC) ,
  CONSTRAINT `fk_commentaires_membres1`
    FOREIGN KEY (`membres_id` )
    REFERENCES `mydb`.`membres` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
