-- MySQL Script generated by MySQL Workbench
-- Fri May 26 11:43:06 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema TPI
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `TPI` ;

-- -----------------------------------------------------
-- Schema TPI
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `TPI` DEFAULT CHARACTER SET utf8 ;
USE `TPI` ;

-- -----------------------------------------------------
-- Table `TPI`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TPI`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `username` VARCHAR(20) NOT NULL,
  `picture` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `confirmed` TINYINT NOT NULL,
  `administrator` TINYINT NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `blocked` TINYINT NOT NULL,
  `creationdate` DATE NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `UniqueUser` (`email` ASC, `username` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TPI`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TPI`.`categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(15) NOT NULL,
  `icone` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `UniqueCategory` (`name` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TPI`.`subjects`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TPI`.`subjects` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(255) NOT NULL,
  `creationdate` DATE NOT NULL,
  `media` VARCHAR(255) NOT NULL,
  `title` VARCHAR(100) NOT NULL,
  `blocked` TINYINT NOT NULL,
  `archived` TINYINT NOT NULL,
  `Category_id` INT NOT NULL,
  `User_id` INT NOT NULL,
  `updated` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_subjects_categories_idx` (`Category_id` ASC) INVISIBLE,
  INDEX `fk_subjects_users1_idx` (`User_id` ASC) VISIBLE,
  CONSTRAINT `fk_subjects_categories`
    FOREIGN KEY (`Category_id`)
    REFERENCES `TPI`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_subjects_users1`
    FOREIGN KEY (`User_id`)
    REFERENCES `TPI`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TPI`.`posts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TPI`.`posts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(255) NOT NULL,
  `creationdate` DATE NOT NULL,
  `media` VARCHAR(255) NOT NULL,
  `blocked` TINYINT NOT NULL,
  `Subject_id` INT NOT NULL,
  `replyingto` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_posts_subjects1_idx` (`Subject_id` ASC) VISIBLE,
  CONSTRAINT `fk_posts_subjects1`
    FOREIGN KEY (`Subject_id`)
    REFERENCES `TPI`.`subjects` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TPI`.`users_subscribe_subjects`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TPI`.`users_subscribe_subjects` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `User_id` INT NOT NULL,
  `Subject_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_users_has_subjects_subjects1_idx` (`Subject_id` ASC) VISIBLE,
  INDEX `fk_users_has_subjects_users1_idx` (`User_id` ASC) VISIBLE,
  CONSTRAINT `fk_users_has_subjects_users1`
    FOREIGN KEY (`User_id`)
    REFERENCES `TPI`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_subjects_subjects1`
    FOREIGN KEY (`Subject_id`)
    REFERENCES `TPI`.`subjects` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TPI`.`users_reply_posts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TPI`.`users_reply_posts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `User_id` INT NOT NULL,
  `Post_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_users_has_posts_posts1_idx` (`Post_id` ASC) VISIBLE,
  INDEX `fk_users_has_posts_users1_idx` (`User_id` ASC) VISIBLE,
  CONSTRAINT `fk_users_has_posts_users1`
    FOREIGN KEY (`User_id`)
    REFERENCES `TPI`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_posts_posts1`
    FOREIGN KEY (`Post_id`)
    REFERENCES `TPI`.`posts` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
