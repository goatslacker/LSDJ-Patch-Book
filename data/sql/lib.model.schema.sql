
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- Instrument
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `Instrument`;


CREATE TABLE `Instrument`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	`stripped` VARCHAR(255)  NOT NULL,
	`software` VARCHAR(25) default 'LSDJ' NOT NULL,
	`type` VARCHAR(5)  NOT NULL,
	`description` TEXT,
	`object` TEXT,
	`owner` VARCHAR(255),
	`author` VARCHAR(255),
	`author_strip` VARCHAR(255),
	`share` BOOLEAN default 1,
	`popularity` INTEGER(3) default 0,
	`sample` VARCHAR(36),
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `Instrument_stripped_index`(`stripped`),
	KEY `Instrument_software_index`(`software`),
	KEY `Instrument_type_index`(`type`),
	KEY `Instrument_author_strip_index`(`author_strip`),
	CONSTRAINT `Instrument_FK_1`
		FOREIGN KEY (`software`)
		REFERENCES `Ware` (`soft`),
	INDEX `Instrument_FI_2` (`owner`),
	CONSTRAINT `Instrument_FK_2`
		FOREIGN KEY (`owner`)
		REFERENCES `User` (`username`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- User
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `User`;


CREATE TABLE `User`
(
	`username` VARCHAR(255)  NOT NULL,
	`stripped` VARCHAR(255),
	`realname` VARCHAR(255),
	`description` TEXT,
	`avatar` VARCHAR(255),
	`location` VARCHAR(255),
	`is_admin` BOOLEAN default 0,
	PRIMARY KEY (`username`),
	KEY `User_stripped_index`(`stripped`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- Tags
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `Tags`;


CREATE TABLE `Tags`
(
	`instrument_id` INTEGER  NOT NULL,
	`user_id` VARCHAR(255)  NOT NULL,
	`tag` VARCHAR(100),
	`normalized` VARCHAR(100)  NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`instrument_id`,`user_id`,`normalized`),
	CONSTRAINT `Tags_FK_1`
		FOREIGN KEY (`instrument_id`)
		REFERENCES `Instrument` (`id`),
	INDEX `Tags_FI_2` (`user_id`),
	CONSTRAINT `Tags_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `User` (`username`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- Search
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `Search`;


CREATE TABLE `Search`
(
	`instrument_id` INTEGER,
	`word` VARCHAR(255),
	`weight` INTEGER(3) default 0,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	KEY `Search_word_index`(`word`),
	INDEX `Search_FI_1` (`instrument_id`),
	CONSTRAINT `Search_FK_1`
		FOREIGN KEY (`instrument_id`)
		REFERENCES `Instrument` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- Comment
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `Comment`;


CREATE TABLE `Comment`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`instrument_id` INTEGER,
	`author` VARCHAR(255) default 'anonymous',
	`comment` TEXT,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `Comment_FI_1` (`instrument_id`),
	CONSTRAINT `Comment_FK_1`
		FOREIGN KEY (`instrument_id`)
		REFERENCES `Instrument` (`id`)
		ON DELETE CASCADE,
	INDEX `Comment_FI_2` (`author`),
	CONSTRAINT `Comment_FK_2`
		FOREIGN KEY (`author`)
		REFERENCES `User` (`username`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- Bank
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `Bank`;


CREATE TABLE `Bank`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255),
	`owner` VARCHAR(255),
	`software` VARCHAR(25) default 'LSDJ' NOT NULL,
	`share` BOOLEAN default 1,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `Bank_software_index`(`software`),
	INDEX `Bank_FI_1` (`owner`),
	CONSTRAINT `Bank_FK_1`
		FOREIGN KEY (`owner`)
		REFERENCES `User` (`username`),
	CONSTRAINT `Bank_FK_2`
		FOREIGN KEY (`software`)
		REFERENCES `Ware` (`soft`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- InstrumentBank
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `InstrumentBank`;


CREATE TABLE `InstrumentBank`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`bank_id` INTEGER  NOT NULL,
	`instrument_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `InstrumentBank_FI_1` (`bank_id`),
	CONSTRAINT `InstrumentBank_FK_1`
		FOREIGN KEY (`bank_id`)
		REFERENCES `Bank` (`id`),
	INDEX `InstrumentBank_FI_2` (`instrument_id`),
	CONSTRAINT `InstrumentBank_FK_2`
		FOREIGN KEY (`instrument_id`)
		REFERENCES `Instrument` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- Ware
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `Ware`;


CREATE TABLE `Ware`
(
	`soft` VARCHAR(25)  NOT NULL,
	`hard` VARCHAR(25),
	PRIMARY KEY (`soft`)
)Type=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
