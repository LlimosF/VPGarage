-- Active: 1684829951085@@127.0.0.1@3306@database
CREATE TABLE horaires
(
  id INT PRIMARY KEY AUTO_INCREMENT NOT NULL ,
  jour VARCHAR(20) NOT NULL,
  matin VARCHAR(30) NOT NULL,
  apresmidi VARCHAR(30)
)

CREATE TABLE users
(
  id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  nom VARCHAR(50) NOT NULL,
  email VARCHAR(60) NOT NULL,
  password VARCHAR(60) NOT NULL,
  role VARCHAR(20) NOT NULL
)

INSERT INTO horaires 
  (jour, matin, apresmidi) 
VALUES 
  ("lun", "08:45 - 12:00", "14:00 - 18:00")

INSERT INTO horaires 
  (jour, matin, apresmidi) 
VALUES 
  ("mar", "08:45 - 12:00", "14:00 - 18:00")

INSERT INTO horaires 
  (jour, matin, apresmidi) 
VALUES 
  ("mer", "08:45 - 12:00", "14:00 - 18:00")

INSERT INTO horaires 
  (jour, matin, apresmidi) 
VALUES 
  ("jeu", "08:45 - 12:00", "14:00 - 18:00")

INSERT INTO horaires 
  (jour, matin, apresmidi) 
VALUES 
  ("ven", "08:45 - 12:00", "14:00 - 18:00")

INSERT INTO horaires
  (jour, matin) 
VALUES 
  ("sam", "08:45 - 12:00")

INSERT INTO horaires 
  (jour, matin) 
VALUES 
  ("dim", "Fermé")

CREATE TABLE voitures
(
  id INT PRIMARY KEY AUTO_INCREMENT NOT NULL ,
  nom VARCHAR(80) NOT NULL,
  kilometrage INT(30) NOT NULL,
  annee INT(10) NOT NULL,
  transmission VARCHAR(30) NOT NULL,
  cylindre VARCHAR(30) NOT NULL,
  chevaux INT(10) NOT NULL,
  prix INT(10) NOT NULL,
  photo BLOB(4294967295) NOT NULL
)

CREATE TABLE commentaires_attente
(
  id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  nom VARCHAR(80) NOT NULL,
  content VARCHAR(255) NOT NULL,
  note INT(10) NOT NULL
)

CREATE TABLE commentaires
(
  id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  nom VARCHAR(80) NOT NULL,
  content VARCHAR(255) NOT NULL,
  note INT(10) NOT NULL
)

CREATE TABLE formulaire_atelier
(
  id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  nom VARCHAR(80) NOT NULL,
  prenom VARCHAR(80) NOT NULL,
  email VARCHAR(100) NOT NULL,
  telephone INT(20) NOT NULL,
  raison VARCHAR(30) NOT NULL,
  message TEXT(20000) NOT NULL
)

CREATE TABLE formulaire_vente
(
  id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  vehicule VARCHAR(80) NOT NULL,
  nom VARCHAR(80) NOT NULL,
  telephone INT(20) NOT NULL
)

CREATE TABLE formulaire_contact
(
  id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  nom VARCHAR(80) NOT NULL,
  prenom VARCHAR(80) NOT NULL,
  email VARCHAR(100) NOT NULL,
  telephone INT(20) NOT NULL,
  raison VARCHAR(80) NOT NULL,
  message TEXT(20000) NOT NULL
)

CREATE TABLE bandeau_reparation
(
  id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  nom VARCHAR(30) NOT NULL,
  image BLOB(4294967295) NOT NULL
)

CREATE TABLE reparation
(
  id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  title VARCHAR(30) NOT NULL,
  content TEXT(2000) NOT NULL
)