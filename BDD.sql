CREATE DATABASE IF NOT EXISTS `infomaniak_books`;

use infomaniak_books;

CREATE USER infomaniakApp IDENTIFIED BY 'password';
GRANT SELECT, INSERT, UPDATE, DELETE ON infomaniak_books.* to infomaniakApp;

DROP TABLE IF EXISTS Books;
CREATE TABLE Books(
    B_ID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    B_Titre VARCHAR(255) NOT NULL,
    B_Auteur VARCHAR(255) NOT NULL,
    B_Genre VARCHAR(255) NOT NULL,
    B_Type VARCHAR(255) NOT NULL,
    B_Date DATE NOT NULL,
    B_Dispo BOOLEAN NOT NULL
);

INSERT INTO Books (B_Titre, B_Auteur, B_Genre, B_Type, B_Date, B_Dispo)
VALUES ('Antigone', 'Jean Anouilh', 'Theatre', 'Roman', '2016-06-01', TRUE),
       ('Royaume de Kensuké', 'Michael Morpurgo', 'Aventure', 'Bande Dessinée', '2018-05-17', TRUE),
       ('Les Furtifs', 'Alain Damasio', 'Litterature', 'Roman/CD', '2019-04-18', TRUE);

DROP TABLE IF EXISTS Users;
CREATE TABLE Users(
    U_ID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    U_Username VARCHAR(255) NOT NULL,
    U_Password VARCHAR(255) NOT NULL,
    U_Prenom VARCHAR(255) NOT NULL,
    U_Nom VARCHAR(255) NOT NULL,
    U_Type INT NOT NULL
);

INSERT INTO Users (U_Username, U_Password, U_Prenom, U_Nom, U_Type)
VALUES ('admin', SHA2('adminpwd', 256), 'PrenomAdmin', 'NomAdmin', 1),
       ('user', SHA2('userpwd', 256), 'PrenomUser', 'NomUser', 0);

DROP TABLE IF EXISTS Borrow;
CREATE TABLE Borrow(
    B_ID INT UNSIGNED NOT NULL,
    U_ID INT UNSIGNED NOT NULL,
    PRIMARY KEY (B_ID, U_ID),
    FOREIGN KEY (B_ID) REFERENCES Books(B_ID),
    FOREIGN KEY (U_ID) REFERENCES Users(U_ID)
);