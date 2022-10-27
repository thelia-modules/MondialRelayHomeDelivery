-- ---------------------------------------------------------------------
-- mondial_relay_home_delivery_freeshipping
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `mondial_relay_home_delivery_freeshipping`;

CREATE TABLE `mondial_relay_home_delivery_freeshipping`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `active` TINYINT(1) DEFAULT 0,
    `freeshipping_from` DECIMAL(18,2),
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_mondial_relay_home_delivery_freeshipping_area_id`
        FOREIGN KEY (`id`)
            REFERENCES `area` (`id`)
            ON UPDATE RESTRICT
            ON DELETE CASCADE
) ENGINE=InnoDB;