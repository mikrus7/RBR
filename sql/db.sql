CREATE TABLE `current` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `currentPostsId` int(11) NOT NULL,
  `currentUsersId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `posts` (
  `postsUserId` int(11) NOT NULL,
  `postsId` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `postsTitle` longtext NOT NULL,
  `postsBody` longtext NOT NULL,
  `postsUsed` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `usersName` longtext NOT NULL,
  `usersUsername` tinytext NOT NULL,
  `usersEmail` longtext NOT NULL,
  `usersAddress` longtext NOT NULL,
  `usersPhone` longtext NOT NULL,
  `usersWebsite` longtext NOT NULL,
  `usersCompany` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
