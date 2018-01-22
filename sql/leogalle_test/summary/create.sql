CREATE TABLE `summary` (
    `summary_id` int(10) unsigned not null auto_increment,
    `webpage_id` int(10) unsigned not null,
    PRIMARY KEY (`summary_id`),
    CONSTRAINT `webpage_id` FOREIGN KEY (`webpage_id`) REFERENCES `website`.`webpage` (`webpage_id`) ON DELETE CASCADE ON UPDATE CASCADE
) charset=utf8;
