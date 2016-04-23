insert into t_author values
(1, 'Thibault', 'Dubois',1995);
insert into t_author values
(2, 'Nicolas', 'Tammerson',1995);

insert into t_book values
(1, 'Mon premier livre', 'Bon livre','C\'est un très bon livre',2016,3,29.99,'1er-livre.png',1);
insert into t_book values
(2, 'Hairy Potter à l\'école des coiffeurs', 'Ciseaux', 'L\'histoire fantastique d\'un jeune coiffeur',2005,1,5,'Hairy.png',2); 
insert into t_book values
(3, 'Les poules ont des dents !', 'Pas terrible','C\'est un livre qui manque cruellement de croquant',2016,2,1.99,'poule.png',1);

insert into t_genre values
(1, 'Science-fiction', 'SF');
insert into t_genre values
(2, 'Fantasy', 'FY');
insert into t_genre values
(3, 'Biographie', 'BIO');
insert into t_genre values
(4, 'Conte', 'C');

/* raw password is 'brazierl' */
insert into t_user values
(1, 'brazierl', 'Louis', 'BRAZIER', 'louis.brazier@etu.univ-lyon1.fr', 'tCunkmr2Bc6073GcgHStpDrqsqFdmW5ItR6Nmbsvl/Vl5nsA+iWZy/wBq+GLqCyOwdpMkOOhP2RNFyv3qDQuvQ==', 'f45688bacb14d857aa0866d', 'ROLE_ADMIN');
/* raw password is 'duboist' */
insert into t_user values
(2, 'duboist', 'Thibault', 'DUBOIS', 'thibault.dubois@etu.univ-lyon1.fr', 'wJ8m37lJFpCocUGERfh5Y7DUyMkY3k4ZxUL2z1DP58HGuUNr1a1hGb8Lt+VqwmHPQHteqcnkbTe5i11BkCu5ww==', 'a961527a255d806ad3e0eca', 'ROLE_USER');
