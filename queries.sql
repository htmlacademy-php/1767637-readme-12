INSERT INTO post_type (name) VALUES ('post-quote'), ('post-text'), ('post-photo'), ('post-link'), ('post-video');

INSERT INTO users ( email, login, password, avatar) VALUES ('test.@mail.com', 'Ivan', '12345', ''), ('email.@gmail.com', 'Nina', '123', ''), ('test2.@mail.ru', 'Mike', 'abc', '');

INSERT INTO category (name) VALUES ('cat 1'), ('cat 2'), ('cat 3');

INSERT INTO hashtags (name) VALUES ('text'), ('link'), ('image'), ('video');

INSERT INTO 
posts ( `post_type_id`, `title`, `content`, `url`, `image_url`, `video_url`, `author_id`, `cat_id`, `hashtags_id` ) 
VALUES 
(4, 'Умная Цитата', 'Лучше поздно, чем никогда. ...', '', '', '', 1, 3, 1 ),
(1, 'Интересная ссылка', '', 'quote.com', '', '', 1, 3, 2 ),
(3, 'Красивое изображение', '', '', 'image.jpg', '', 3, 1, 3 ),
(5, 'Видео', '', '', '', 'video.mp4', 2, 1, 4 ),
(2, 'Мудрый текст', 'Приходит день, приходит час, И понимаешь: все не вечно! Жизнь бессердечно учит нас. О том, что время быстротечно. О том, что нужно все ценить, Беречь все то, что нам дается. Ведь жизнь как тоненькая нить,
Она порой внезапно рвется…', '', '', '', 2, 3, 1 );

INSERT INTO 
comment ( `post_id`, `user_id`, `content`) 
VALUES 
(26, 3, 'Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века.'),
(29, 2, 'Многие думают, что Lorem Ipsum - взятый с потолка псевдо-латинский набор слов, но это не совсем так. Его корни уходят в один фрагмент классической латыни 45 года н.э.'),
(30, 1, 'Классический текст Lorem Ipsum, используемый с XVI века, приведён ниже. Также даны разделы 1.10.32 и 1.10.33 "de Finibus Bonorum et Malorum" Цицерона и их английский перевод, сделанный H. Rackham, 1914 год.');

-- получить список постов с сортировкой по популярности и вместе с именами авторов и типом контента
SELECT * FROM posts p 
    JOIN users u ON p.author_id = u.id
    JOIN post_type t ON p.post_type_id = t.id
    ORDER BY views_number ASC;

-- получить список постов для конкретного пользователя;
SELECT * FROM posts WHERE author_id = 1; 

-- получить список комментариев для одного поста, в комментариях должен быть логин пользователя;
SELECT * FROM comment c 
    JOIN posts p ON c.post_id = p.id
    JOIN users u ON c.user_id = u.id


-- добавить лайк к посту;
INSERT INTO user_post_like (user_id, post_id) VALUES (1, 2);

-- подписаться на пользователя.
INSERT INTO subscription (follower_id, user_id) VALUES (2, 26);