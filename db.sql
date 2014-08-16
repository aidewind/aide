drop database if exists site;
create database site;
use site;

/*
 * entities
 */
  
create table account (
  id bigint not null primary key auto_increment,
  email varchar(250) not null unique,
  display_name varchar(63) not null unique,
  password_hash varchar(128) not null,
  password_salt varchar(31) not null
)ENGINE=InnoDB;

create table comment (
  id bigint not null primary key auto_increment,
  body text not null,  
  created datetime not null,
  updated datetime null,
  account bigint not null,
  ticket bigint not null  
)ENGINE=InnoDB;

create table member (
  id bigint not null primary key auto_increment,
  email varchar(250) not null unique,
  complete_name varchar(63) not null unique ,
  account bigint null
)ENGINE=InnoDB;

create table sector (
  id bigint not null primary key auto_increment,
  name varchar(255) not null
)ENGINE=InnoDB;

/*
create table sector (
  id bigint not null primary key auto_increment,
  email varchar(250) not null unique,
  name varchar(255) not null,
  initial varchar(255) not null unique,  
  place varchar(255) not null,
  telephone varchar(255) not null
)ENGINE=InnoDB;
*/
create table session (
  id bigint not null primary key auto_increment,
  code varchar(31) not null,
  created datetime not null,
  account bigint not null
)ENGINE=InnoDB;

create table setting (
  id bigint not null primary key auto_increment,
  site_name varchar(63) not null
)ENGINE=InnoDB;

create table ticket (
  id bigint not null primary key auto_increment,
  body text not null,
  created datetime not null,
  updated datetime null
)ENGINE=InnoDB;

/*
 * relations
 */

create table sector_closure (
  ancestor bigint not null,
  descendant bigint not null,
  primary key (ancestor, descendant)
);

create table ticket_member (
  id bigint not null primary key auto_increment,
  member bigint not null,
  created datetime not null,
  updated datetime null,
  account bigint not null,
  ticket bigint not null  
)ENGINE=InnoDB;

create table ticket_sector (
  id bigint not null primary key auto_increment,
  sector bigint not null,
  created datetime not null,
  updated datetime null,
  account bigint not null,
  ticket bigint not null  
)ENGINE=InnoDB;

/*
 * foreign keys
 */

alter table comment add foreign key (account) references account(id);
alter table comment add foreign key (ticket) references ticket(id);
alter table member add foreign key (account) references account(id);
alter table session add foreign key (account) references account(id);
alter table sector_closure add foreign key (ancestor) references sector(id);
alter table sector_closure add foreign key (descendant) references sector(id);
alter table ticket_member add foreign key (member) references member(id);
alter table ticket_member add foreign key (account) references account(id);
alter table ticket_member add foreign key (ticket) references ticket(id);
alter table ticket_sector add foreign key (sector) references sector(id);
alter table ticket_sector add foreign key (account) references account(id);
alter table ticket_sector add foreign key (ticket) references ticket(id);