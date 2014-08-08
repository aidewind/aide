drop database if exists site;
create database site;
use site;
  
create table setting (
  id bigint not null primary key auto_increment,
  site_name varchar(63) not null
)ENGINE=InnoDB;

create table account (
  id bigint not null primary key auto_increment,
  email varchar(250) not null unique,
  display_name varchar(63) not null unique,
  password_hash varchar(128) not null,
  password_salt varchar(31) not null
)ENGINE=InnoDB;

create table session (
  id bigint not null primary key auto_increment,
  code varchar(31) not null,
  created datetime not null,
  account bigint not null
)ENGINE=InnoDB;

create table ticket (
  id bigint not null primary key auto_increment,
  body text not null,
  created datetime not null,
  updated datetime null
)ENGINE=InnoDB;

create table sector (
  id bigint not null primary key auto_increment,
  name varchar(255) not null,
  initials varchar(255) not null unique,  
  place varchar(255) not null,
  telephone varchar(255) not null
)ENGINE=InnoDB;

create table ticket_sector (
  ticket bigint not null references ticket(id),
  sector bigint not null references sector(id)
)ENGINE=InnoDB;

create table member (
  id bigint not null primary key auto_increment,
  email varchar(250) not null unique,
  complete_name varchar(63) not null unique ,
  account bigint null
)ENGINE=InnoDB;

alter table ticket_sector add index (ticket, sector);
alter table session add foreign key (account) references account(id);
alter table member add foreign key (account) references account(id);