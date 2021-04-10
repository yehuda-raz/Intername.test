# Yehuda Raz - Intername.test

All the questions are indicated here The answers are indicated here or indicate the name of the relevant file

### 1. Create Mysql\MariaDB Database with 2 tables, users and posts.

File name: test_intername.sql

```sql
  CREATE TABLE `users` (
    `id` int(8)  NOT NULL auto_increment,
    `name` varchar(255) collate utf8_unicode_ci NOT NULL,
    `email`  varchar(255) NOT NULL,
    `updated_at` timestamp  NULL,
    `created_at`  timestamp NOT NULL default CURRENT_TIMESTAMP,
    PRIMARY KEY  (`id`)
  ) ;

  CREATE TABLE `posts` (
    `id` int(8) unsigned NOT NULL auto_increment,
    `user_id` int(8) NOT NULL,
    `title` varchar(255) collate utf8_unicode_ci NOT NULL,
    `body`  varchar(255) collate utf8_unicode_ci NOT NULL,
    `updated_at` timestamp  NULL,
    `created_at`  timestamp NOT NULL default CURRENT_TIMESTAMP,
    PRIMARY KEY  (`id`)
  );


  ALTER TABLE `posts` ADD FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

```

### 2. Create 3 Classes

File name:
A. DbConnection class - lib/class.DbConnection.php

B. User class - lib/class.user.php

C. Post class - lib/class.post.php

### 3. Fetch users and posts via curl and save them in your database

File name: curl.php
On the config.php file change to your DB credential

### 4. Create html file that will include a form, with the following fields

File name: index.php

### 5. Create php file that will output all the posts as json

File name: get_json.php

      a. get_json.php?user_id={USER_ID}
      b. get_json.php?post_id={POST_ID}

### 6. Write a mysql query that will return the average of posts users created by monthly, and weekly. The columns should be: user_id, monthly_average, weekly_average.

I know this is not the optimal way to do it.
I would like to know what do you think is the optimal way

```sql

SELECT month.user_id, week.week_avg , month.month_avg FROM

(
select user_id, ((a.week_sum / sum(a.week_sum ) OVER () ) * COUNT(*) OVER ()) AS week_avg from ( select user_id, count(created_at)as week_sum FROM posts WHERE yearweek(created_at) = yearweek(CURRENT_DATE()) group by user_id ) a

) week
 JOIN
(
select user_id, ((b.month_sum / sum(b.month_sum ) OVER () ) * COUNT(*) OVER ()) AS month_avg from ( select user_id, count(created_at)as month_sum FROM posts WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) group by user_id ) b

) month
ON week.user_id = month.user_id


```
