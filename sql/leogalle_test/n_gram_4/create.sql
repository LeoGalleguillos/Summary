CREATE TABLE `n_gram_4` (
    `n_gram_4_id` int(10) unsigned not null auto_increment,
    `summary_id` int(10) unsigned not null,
    `count` int(10) unsigned not null,
    `word_1` varchar(255) not null,
    `word_2` varchar(255) not null,
    `word_3` varchar(255) not null,
    `word_4` varchar(255) not null,
    PRIMARY KEY (`n_gram_4_id`),
    KEY `summary_id_count` (`summary_id`, `count`)
) charset=utf8;
