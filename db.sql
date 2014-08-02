drop database if exists blog;
create database blog;
use blog;
  
create table setting (
  id bigint not null primary key auto_increment,
  blog_name varchar(63) not null,
  email varchar(250) not null,
  display_name varchar(63) not null,
  password_hash varchar(128) not null,
  password_salt varchar(31) not null
)ENGINE=InnoDB;

create table account (
  id bigint not null primary key auto_increment,
  email varchar(250) not null,
  display_name varchar(63) not null,
  password_hash varchar(128) not null,
  password_salt varchar(31) not null
)ENGINE=InnoDB;

create table session (
  id bigint not null primary key auto_increment,
  code varchar(31) not null,
  created datetime not null
)ENGINE=InnoDB;

create table ticket (
  id bigint not null primary key auto_increment,
  body text not null,
  created datetime not null,
  updated datetime null
)ENGINE=InnoDB;

create table tag (
  id bigint not null primary key auto_increment,
  name varchar(255) not null
)ENGINE=InnoDB;

create table ticket_tag (
  ticket bigint not null references ticket(id),
  tag bigint not null references tag(id)
)ENGINE=InnoDB;

alter table ticket_tag add index (ticket, tag);