CREATE TABLE `n_gram_3` (
    `n_gram_3_id` int(10) unsigned not null auto_increment,
    `summary_id` int(10) unsigned not null,
    `count` int(10) unsigned not null,
    `word_1` varchar(255) not null,
    `word_2` varchar(255) not null,
    `word_3` varchar(255) not null,
    PRIMARY KEY (`n_gram_3_id`),
    UNIQUE `summary_id_count_word_1_word_2_word_3` (`summary_id`, `count`, `word_1`, `word_2`, `word_3`)
) charset=utf8;
