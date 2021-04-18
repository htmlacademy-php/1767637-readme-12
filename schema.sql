CREATE DATABASE `myDB`;
CREATE TABLE `posts`
(
    `id` INT  UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `post_type_id` VARCHAR (50) NOT NULL,
    `title` VARCHAR (100) NOT NULL,
    `excerpt` VARCHAR (150) NOT NULL,
    `content` TEXT NOT NULL,
    `url` VARCHAR (100) NOT NULL,
    `image_url` VARCHAR (100) NOT NULL,
    `video_url` VARCHAR (100) NOT NULL,
    `author_id` INT (6) NOT NULL,
    `cat_id` INT (6) NOT NULL,
    `hashtags_id` INT (6) NOT NULL,
    `comment_count` INT (20) DEFAULT 0 ,
    `views_number` INT (20) DEFAULT 0 ,
    `date_create` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`author_id`)  REFERENCES `users` (`id`) ON UPDATE CASCADE,
    FOREIGN KEY (`cat_id`)  REFERENCES `category` (`id`) ON UPDATE CASCADE,
    FOREIGN KEY (`post_type_id`)  REFERENCES `post_type` (`id`) ON UPDATE CASCADE,
    FOREIGN KEY (`hashtags_id`)  REFERENCES `hashtags` (`id`) ON UPDATE CASCADE

) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

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
    `name` VARCHAR (100) NOT NULL

) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

CREATE TABLE `hashtags`
(
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR (100) NOT NULL

) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

CREATE TABLE `user_post_like`
(
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
   ` user_id` INT,
    `post_id` INT,
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
    FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

CREATE TABLE `comment`
(
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `comment_post_ID` INT (100) NOT NULL,
    `user_id` INT (6) NOT NULL,
    `comment_content` VARCHAR (250) NOT NULL,
    `comment_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`)  REFERENCES `users` (`id`)ON UPDATE CASCADE,
    FOREIGN KEY (`comment_post_ID`)  REFERENCES `posts` (`id`) ON UPDATE CASCADE

) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

CREATE TABLE   `subscription`
(
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `follower_id`  INT (6) NOT NULL,
    `user_id`  INT NOT NULL,
    FOREIGN KEY (follower_id) REFERENCES users (id) ON UPDATE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

CREATE TABLE `message`
(
    `id` INT NOT NULL,
    `message_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `message_text`      TEXT,
    `sender_id`    INT (6) NOT NULL,
    `recipient_id` INT (6) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
    FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;