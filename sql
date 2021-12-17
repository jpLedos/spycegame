create database spygames;

create table statuts  (
    id INT AUTO_INCREMENT NOT NULL, 
    statut VARCHAR(100) NOT NULL, 
    PRIMARY KEY(id)) 
    DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;

insert into statuts (statut) value ("En preparation"),("en cours"), ("Terminé"), ("Echec")


create table types (
    id INT AUTO_INCREMENT NOT NULL, 
    type VARCHAR(100) NOT NULL, 
    PRIMARY KEY(id)) 
    DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;

insert into types (type) value ("Surveillance"),("Assassinat"), ("Infiltration"), ("Exfiltration")

create table types (
    id INT AUTO_INCREMENT NOT NULL, 
    type VARCHAR(100) NOT NULL, 
    PRIMARY KEY(id)) 
    DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;

insert into types (type) value ("Surveillance"),("Assassinat"), ("Infiltration"), ("Exfiltration")

create table specialities (
    id INT AUTO_INCREMENT NOT NULL, 
    name VARCHAR(100) NOT NULL, 
    PRIMARY KEY(id)) 
    DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;

insert into specialities (name) value ("arts martiaux"),("Deguisements"), ("armes blanches"), ("Poisons")

CREATE TABLE targets (
    id INT AUTO_INCREMENT NOT NULL, 
    lastname VARCHAR(100) NOT NULL, 
    firstname VARCHAR(100) NOT NULL, 
    code VARCHAR(100) NOT NULL, 
    countryID INT NOT NULL,  
    is_dead TINYINT(1) NOT NULL, 
    date_of_birth DATE NOT NULL, 
    PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;

CREATE TABLE contacts (
    id INT AUTO_INCREMENT NOT NULL, 
    lastname VARCHAR(100) NOT NULL, 
    firstname VARCHAR(100) NOT NULL, 
    code VARCHAR(100) NOT NULL, 
    countryID INT NOT NULL,  
    is_dead TINYINT(1) NOT NULL, 
    date_of_birth DATE NOT NULL, 
    PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;

CREATE TABLE agents (
    id INT AUTO_INCREMENT NOT NULL, 
    lastname VARCHAR(100) NOT NULL, 
    firstname VARCHAR(100) NOT NULL, 
    code VARCHAR(100) NOT NULL, 
    countryID INT NOT NULL,  
    is_dead TINYINT(1) NOT NULL, 
    date_of_birth DATE NOT NULL, 
    specialities LONGTEXT NOT NULL,
    PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;


create table hidaways
(
    id INT AUTO_INCREMENT NOT NULL, 
    code VARCHAR(100) NOT NULL, 
    country_id INT NOT  NULL, 
    hidaways_Type_id INT  NOT NULL,
    address VARCHAR(100) NOT NULL,
    PRIMARY KEY(id)) 
    DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;


create table hidaway_types (
    id INT AUTO_INCREMENT NOT NULL, 
    name VARCHAR(100) NOT NULL, 
    PRIMARY KEY(id)) 
    DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;

insert into hidaway_types (name) value ("gare"),("villa"), ("appartement"), ("grenier")

create table countries (
    id INT AUTO_INCREMENT NOT NULL, 
    name VARCHAR(50) NOT NULL, 
    code VARCHAR(50) NOT NULL,  
    PRIMARY KEY(id))
    DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;


create table missions (
    id INT AUTO_INCREMENT NOT NULL, 
    title VARCHAR(100) NOT NULL, 
    description LONGTEXT  NOT NULL,
    code VARCHAR(100) NOT NULL,
    country_id INT NOT NULL,
    targets  LONGTEXT  NOT NULL,
    agents  LONGTEXT  NOT NULL,
    contacts  LONGTEXT  NOT NULL,
    type_id INT NOT NULL,
    statut_id INT NOT NULL,
    hidaways LONGTEXT  NULL,
    speciality_id INT NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    PRIMARY KEY(id)) 
    DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;

ALTER TABLE missions ADD CONSTRAINT FK_statut_id FOREIGN KEY (statut_id) REFERENCES statut (id);
ALTER TABLE missions ADD CONSTRAINT FK_country_id FOREIGN KEY (country_id) REFERENCES countries (id);
ALTER TABLE missions ADD CONSTRAINT FK_type_id FOREIGN KEY (type_id) REFERENCES types(id);
ALTER TABLE hidaways ADD CONSTRAINT FK_hidaway_type_id FOREIGN KEY (hidawaystype_id) REFERENCES hidaway_types(id);


