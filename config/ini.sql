create database dotinstall_php_sns;

create table users(
  id int not null auto_increment primary key,
  email varchar(255) unique,
  password varchar(255),
  created datetime,
  midified datetime
);

