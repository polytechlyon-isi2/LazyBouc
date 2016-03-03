drop table if exists t_gen_bk_link;
drop table if exists t_genre;
drop table if exists t_book;
drop table if exists t_author;

create table t_book (
    bk_id integer not null primary key auto_increment,
    bk_title varchar(100) not null,
    bk_short_summary varchar(140) not null,
	bk_long_summary varchar(2000) not null,
	bk_year integer,
	aut_id integer not null,
	bk_price float not null
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

create table t_gen_bk_link (
    gen_id integer not null,
    bk_id integer not null, 
	primary key (gen_id, bk_id),
	FOREIGN KEY (gen_id) 
		REFERENCES t_genre(gen_id),
	FOREIGN KEY (bk_id) 
		REFERENCES t_book(bk_id)
) engine=innodb character set utf8 collate utf8_unicode_ci;
