CREATE TABLE `summary` (
    `summary_id` int(10) unsigned auto_increment,
    `title` varchar(255) not null,
    `body` text not null,
    PRIMARY KEY (`summary_id`)
) charset=utf8;
