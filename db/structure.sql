drop table if exists t_book;
drop table if exists t_author;

create table t_book (
    bk_id integer not null primary key auto_increment,
    bk_title varchar(100) not null,
    bk_short_summary varchar(140) not null,
	bk_long_summary varchar(2000) not null,
	aut_id integer not null,
	bk_price float not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table t_author (
    aut_id integer not null primary key auto_increment,
    aut_firstname varchar(100) not null,
    aut_lastname varchar(100) not null,
	aut_birth integer
) engine=innodb character set utf8 collate utf8_unicode_ci;

