CREATE TABLE `n_gram_2` (
    `n_gram_2_id` int(10) unsigned not null auto_increment,
    `summary_id` int(10) unsigned not null,
    `count` int(10) unsigned not null,
    `word_1` varchar(255) not null,
    `word_2` varchar(255) not null,
    PRIMARY KEY (`n_gram_2_id`),
    UNIQUE `summary_id_count_word_1_word_2` (`summary_id`, `count`, `word_1`, `word_2`)
) charset=utf8;
