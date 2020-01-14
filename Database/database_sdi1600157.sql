-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sdi1600157` DEFAULT CHARACTER SET utf8 ;
USE `sdi1600157` ;

-- -----------------------------------------------------
-- Table `mydb`.`bus_stops`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sdi1600157`.`bus_stops` (
  `bus_stop` VARCHAR(45) NOT NULL,
  `amea` TINYINT(4) NOT NULL,
  `area` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`bus_stop`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`buses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sdi1600157`.`buses` (
  `bus_id` INT(11) NOT NULL,
  PRIMARY KEY (`bus_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`buses_stops`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sdi1600157`.`buses_stops` (
  `bus_stop` VARCHAR(45) NOT NULL,
  `bus` INT(11) NOT NULL,
  PRIMARY KEY (`bus_stop`, `bus`),
  INDEX `fk_bus_stops_has_buses_buses1_idx` (`bus` ASC),
  INDEX `fk_bus_stops_has_buses_bus_stops1_idx` (`bus_stop` ASC),
  CONSTRAINT `fk_bus_stops_has_buses_bus_stops1`
    FOREIGN KEY (`bus_stop`)
    REFERENCES `sdi1600157`.`bus_stops` (`bus_stop`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bus_stops_has_buses_buses1`
    FOREIGN KEY (`bus`)
    REFERENCES `sdi1600157`.`buses` (`bus_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sdi1600157`.`users` (
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `first_name` VARCHAR(45) NOT NULL,
  `surname` VARCHAR(45) NOT NULL,
  `telephone` VARCHAR(14) NOT NULL,
  `type` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`username`, `email`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`purchases`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sdi1600157`.`purchases` (
  `purchase_id` INT(11) NOT NULL,
  `number_of_tickets` INT(11) NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`purchase_id`),
  INDEX `fk_purchases_users_idx` (`username` ASC, `email` ASC),
  CONSTRAINT `fk_purchases_users`
    FOREIGN KEY (`username` , `email`)
    REFERENCES `sdi1600157`.`users` (`username` , `email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
