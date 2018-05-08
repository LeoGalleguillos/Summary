CREATE TABLE `n_gram_1` (
    `n_gram_1_id` int(10) unsigned not null auto_increment,
    `summary_id` int(10) unsigned not null,
    `count` int(10) unsigned not null,
    `word_1` varchar(255) not null,
    PRIMARY KEY (`n_gram_1_id`),
    KEY `summary_id_count` (`summary_id`, `count`)
) charset=utf8;
