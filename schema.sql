CREATE DATABASE `myDB`;
CREATE TABLE `users`
(
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR (50) NOT NULL ,
    `login` VARCHAR (50) NOT NULL,
    `password` VARCHAR (100) NOT NULL,
    `avatar` VARCHAR (100),
    `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

CREATE TABLE `category`
(
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR (100) NOT NULL

) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

CREATE TABLE `post_type`
(
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR (100) NOT NULL,
    `title` VARCHAR (100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

CREATE TABLE `hashtags`
(
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR (100) NOT NULL

) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

CREATE TABLE `posts`
(
    `id` INT  UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `post_type_id` INT UNSIGNED NOT NULL,
    `title` VARCHAR (100) NOT NULL,
    `content` TEXT,
    `url` VARCHAR (100),
    `image_url` VARCHAR (100),
    `video_url` VARCHAR (100),
    `author_id` INT UNSIGNED NOT NULL,
    `cat_id` INT UNSIGNED NOT NULL,
    `hashtags_id` INT UNSIGNED,
    `views_number` INT (20) DEFAULT 0 ,
    `date_create` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`author_id`)  REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (`cat_id`)  REFERENCES `category` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (`post_type_id`)  REFERENCES `post_type` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (`hashtags_id`)  REFERENCES `hashtags` (`id`) ON UPDATE CASCADE ON DELETE CASCADE

) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

CREATE TABLE `user_post_like`
(
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT UNSIGNED NOT NULL,
    `post_id` INT UNSIGNED NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

CREATE TABLE `comment`
(
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `post_id` INT UNSIGNED NOT NULL,
    `user_id` INT UNSIGNED NOT NULL,
    `content` VARCHAR (250) NOT NULL,
    `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`)  REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (`post_ID`)  REFERENCES `posts` (`id`) ON UPDATE CASCADE ON DELETE CASCADE

) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

CREATE TABLE   `subscription`
(
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `follower_id`  INT UNSIGNED NOT NULL,
    `user_id`  INT UNSIGNED NOT NULL,
    FOREIGN KEY (follower_id) REFERENCES users (id),
    FOREIGN KEY (user_id) REFERENCES users (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

CREATE TABLE `message`
(
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `text` TEXT,
    `sender_id` INT UNSIGNED NOT NULL,
    `recipient_id` INT UNSIGNED NOT NULL,
    FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;