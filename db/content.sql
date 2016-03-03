insert into t_author values
(1, 'Thibault', 'Dubois',1995);
insert into t_author values
(2, 'Nicolas', 'Tammerson',1995);

insert into t_book values
(1, 'Mon premier livre', 'Bon livre','C\'est un très bon livre',2016,1,29.99);
insert into t_book values
(2, 'Hairy Potter à l\'école des coiffeurs', 'Ciseaux', 'L\'histoire fantastique d\'un jeune coiffeur',2005,2,5); 
insert into t_book values
(3, 'Les poules ont des dents !', 'Pas terrible','C\'est un livre qui manque cruellement de croquant',2016,1,1.99);

insert into t_genre values
(1, 'Science-fiction', 'SF');
insert into t_genre values
(2, 'Fantasy', 'FY');
insert into t_genre values
(3, 'Biographie', 'BIO');

insert into t_gen_bk_link values
(1,3);
insert into t_gen_bk_link values
(2,1);
insert into t_gen_bk_link values
(3,2);

