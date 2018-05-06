CREATE TABLE `summary` (
    `summary_id` int(10) unsigned not null auto_increment,
    `webpage_id` int(10) unsigned not null,
    `title` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`summary_id`)
) charset=utf8;
