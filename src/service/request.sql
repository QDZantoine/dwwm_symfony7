INSERT  INTO  client(num_client,nom_client,adresse_client) VALUES
('CLT001','Norbert','Niort'),
('CLT002','Claude','Clisson'),
('CLT003','Marie','Marseille'),
('CLT004','Paul','Paris'),
('CLT005','Fabien','Fontenay le comte');


-----------------Insert data into the table menu----------------

insert into menu(rang,libelle,url,role,parent_id) values
('001','Home','app_home','ROLE_USER',null),
('002','Article','app_article_index','ROLE_USER',null),
('003','Client','app_client','ROLE_USER',null),
('004','Commande','app_commande','ROLE_USER',null),
('005','Parametre','app_parametre','ROLE_USER',null),

('006','Facture','app_facture','ROLE_USER',4),
('007','Devis','app_home','ROLE_USER',4),
('008','Avoir','app_home','ROLE_USER',4),


('009','User','app_user','ROLE_USER',5),
('0010','Role','app_role','ROLE_USER',5),
('0011','Menu','app_menu','ROLE_USER',5);

select * from menu;

MariaDB [dwwm_symfony7]> select * from menu;
+----+------+-----------+-------------------+------+-----------+-----------+
| id | rang | libelle   | url               | icon | role      | parent_id |
+----+------+-----------+-------------------+------+-----------+-----------+
|  1 | 001  | Home      | app_home          | NULL | ROLE_USER |      NULL |
|  2 | 002  | Article   | app_article_index | NULL | ROLE_USER |      NULL |
|  3 | 003  | Client    | app_client        | NULL | ROLE_USER |      NULL |
|  4 | 004  | Commande  | app_commande      | NULL | ROLE_USER |      NULL |
|  5 | 005  | Parametre | app_parametre     | NULL | ROLE_USER |      NULL |
|  6 | 006  | Facture   | app_facture       | NULL | ROLE_USER |         4 |
|  7 | 007  | Devis     | app_home          | NULL | ROLE_USER |         4 |
|  8 | 008  | Avoir     | app_home          | NULL | ROLE_USER |         4 |
|  9 | 009  | User      | app_user          | NULL | ROLE_USER |         5 |
| 10 | 0010 | Role      | app_role          | NULL | ROLE_USER |         5 |
| 11 | 0011 | Menu      | app_menu          | NULL | ROLE_USER |         5 |
+----+------+-----------+-------------------+------+-----------+-----------+
11 rows in set (0,000 sec)

