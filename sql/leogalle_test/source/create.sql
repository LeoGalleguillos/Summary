CREATE TABLE `source` (
    `source_id` int(10) unsigned auto_increment,
    `summary_id` int(10) not null,
    `url` varchar(255) not null,
    `title` varchar(255) not null,
    PRIMARY KEY (`source_id`),
    INDEX (`summary_id`)
) charset=utf8;
