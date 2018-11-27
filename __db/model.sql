-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `galleries`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `galleries` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  `description` VARCHAR(255) NULL,
  `meta_title` VARCHAR(45) NULL,
  `meta_description` VARCHAR(255) NULL,
  `meta_keywords` VARCHAR(255) NULL,
  `date_create` TIMESTAMP NULL,
  `date_update` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
  ENGINE = InnoDB
  DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `photos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `photos` (
  `id` INT(15) UNSIGNED NOT NULL AUTO_INCREMENT,
  `path` VARCHAR(255) NOT NULL,
  `description` VARCHAR(255) NULL,
  `gallery_id` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `idphotos_UNIQUE` (`id` ASC),
  INDEX `fk_photos_gallery_idx` (`gallery_id` ASC),
  CONSTRAINT `fk_photos_gallery`
  FOREIGN KEY (`gallery_id`)
  REFERENCES `galleries` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
  ENGINE = InnoDB
  DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `posts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `posts` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `short_text` VARCHAR(255) NULL,
  `text` MEDIUMTEXT NOT NULL,
  `meta_title` VARCHAR(45) NULL,
  `meta_description` VARCHAR(255) NULL,
  `meta_keywords` VARCHAR(255) NULL,
  `date_create` TIMESTAMP NULL,
  `date_update` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
  ENGINE = InnoDB
  DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sliders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` INT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
  ENGINE = InnoDB
  DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `slider_photos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `slider_photos` (
  `id` INT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `path` VARCHAR(255) NOT NULL,
  `slider_id` INT(5) UNSIGNED NOT NULL,
  `description` VARCHAR(255) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_slider_photos_idx` (`slider_id` ASC),
  CONSTRAINT `fk_slider_photos`
  FOREIGN KEY (`slider_id`)
  REFERENCES `sliders` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
  ENGINE = InnoDB
  DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `requests`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `requests` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NULL,
  `phone` VARCHAR(25) NULL,
  `message` VARCHAR(255) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
  ENGINE = InnoDB
  DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
