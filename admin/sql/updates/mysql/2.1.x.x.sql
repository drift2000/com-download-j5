ALTER TABLE `#__download_items` 
ADD  `access_level` INT NULL DEFAULT NULL AFTER `usersgroup`;
ALTER TABLE `#__download_items` 
ADD  `user_id` INT NULL DEFAULT NULL AFTER `manager`;