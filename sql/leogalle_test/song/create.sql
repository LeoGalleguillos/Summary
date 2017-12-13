CREATE TABLE `song` (
    `song_id` int(10) unsigned auto_increment,
    `artist` varchar(255) not null,
    `title` varchar(255) not null,
    `featured_artists` varchar(255) default null,
    PRIMARY KEY (`song_id`)
) charset=utf8;
