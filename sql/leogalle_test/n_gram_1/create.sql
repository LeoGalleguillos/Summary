CREATE TABLE `n_gram_1` (
    `n_gram_1_id` int(10) unsigned not null auto_increment,
    `summary_id` int(10) unsigned not null,
    `count` int(10) unsigned not null,
    `word_1` varchar(255) not null,
    PRIMARY KEY (`n_gram_1_id`),
    UNIQUE `summary_id_count_word_1` (`summary_id`, `count`, `word_1`)
) charset=utf8;
