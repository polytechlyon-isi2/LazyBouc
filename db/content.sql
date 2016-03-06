insert into t_author values
(1, 'Thibault', 'Dubois',1995);
insert into t_author values
(2, 'Nicolas', 'Tammerson',1995);

insert into t_book values
(1, 'Mon premier livre', 'Bon livre','C\'est un très bon livre',2016,3,29.99,'1er-livre.png');
insert into t_book values
(2, 'Hairy Potter à l\'école des coiffeurs', 'Ciseaux', 'L\'histoire fantastique d\'un jeune coiffeur',2005,1,5,'Hairy.png'); 
insert into t_book values
(3, 'Les poules ont des dents !', 'Pas terrible','C\'est un livre qui manque cruellement de croquant',2016,2,1.99,'poule.png');

insert into t_genre values
(1, 'Science-fiction', 'SF');
insert into t_genre values
(2, 'Fantasy', 'FY');
insert into t_genre values
(3, 'Biographie', 'BIO');

insert into t_aut_bk_write values
(1,1);
insert into t_aut_bk_write values
(2,2);
insert into t_aut_bk_write values
(1,3);

/* raw password is 'brazierl' */
insert into t_user values
(1, 'brazierl', 'Louis', 'BRAZIER', 'louis.brazier@etu.univ-lyon1.fr', 'L2nNR5hIcinaJkKR+j4baYaZjcHS0c3WX2gjYF6Tmgl1Bs+C9Qbr+69X8eQwXDvw0vp73PrcSeT0bGEW5+T2hA==', 'YcM=A$nsYzkyeDVjEUa7W9K', 'ROLE_USER');
/* raw password is 'duboist' */
insert into t_user values
(2, 'duboist', 'Thibault', 'DUBOIS', 'thibault.dubois@etu.univ-lyon1.fr', 'EfakNLxyhHy2hVJlxDmVNl1pmgjUZl99gtQ+V3mxSeD8IjeZJ8abnFIpw9QNahwAlEaXBiQUBLXKWRzOmSr8HQ==', 'dhMTBkzwDKxnD;4KNs,4ENy', 'ROLE_USER');
