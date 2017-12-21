CREATE TABLE `summary` (
    `summary_id` int(10) unsigned auto_increment,
    `title` varchar(255) not null,
    `body` text not null,
    `thumbnail_root_relative_path` varchar(255) default null,
    `thumbnail_width` int(10) default null,
    `thumbnail_height` int(10) default null,
    PRIMARY KEY (`summary_id`)
) charset=utf8;
