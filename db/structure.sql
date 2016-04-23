drop table if exists t_book;
drop table if exists t_author;
drop table if exists t_genre;
drop table if exists t_user;

create table t_book (
    bk_id integer not null primary key auto_increment,
    bk_title varchar(100) not null,
    bk_short_summary varchar(140) not null,
	bk_long_summary varchar(2000) not null,
	bk_year integer,
	gen_id integer not null,
	bk_price float not null,
	bk_image varchar(100),
	aut_id integer not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table t_author (
    aut_id integer not null primary key auto_increment,
    aut_firstname varchar(100) not null,
    aut_lastname varchar(100) not null,
	aut_birth integer
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table t_genre (
    gen_id integer not null primary key auto_increment,
    gen_label varchar(30) not null,
    gen_short_lbl varchar(5)
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table t_user (
    usr_id integer not null primary key auto_increment,
	usr_login varchar(50) not null,
    usr_firstname varchar(50) not null,
	usr_lastname varchar(50) not null,
	usr_mail varchar(50) not null,
    usr_password varchar(88) not null,
    usr_salt varchar(23) not null,
    usr_role varchar(50) not null 
) engine=innodb character set utf8 collate utf8_unicode_ci;
