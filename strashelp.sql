CREATE TABLE user(  
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'Primary Key',
    login VARCHAR(255),
    password VARCHAR(255)
);


CREATE TABLE particulier(  
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'Primary Key',
    name VARCHAR(255),
    description TEXT,
    phone INT,
    email VARCHAR(255),
    credit INT,


    user_id INT NOT NULL,
    Foreign Key (user_id) 
    REFERENCES user(id)

);

CREATE TABLE association(  
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'Primary Key',
    siret INT,
    name VARCHAR(255),
    description TEXT,
    address VARCHAR(255),
    creationDate DATE,
    phone INT,
    email VARCHAR(255),
    credit INT,


    user_id INT NOT NULL,
    Foreign Key (user_id) 
    REFERENCES user(id)
 );



    CREATE TABLE note(  
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'Primary Key',
    date DATE,
    note INT,

    user_id INT NOT NULL,
    Foreign Key (user_id) 
    REFERENCES user(id),

    offre_id INT NOT NULL,
    Foreign Key (offre_id) 
    REFERENCES offre(id)

);

CREATE TABLE categorie(  
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'Primary Key',
    description TEXT

);


CREATE TABLE offre(  
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'Primary Key',
    title VARCHAR(255),
    description TEXT,
    availability VARCHAR(255),
    area VARCHAR(255),
    price INT,


    user_id INT NOT NULL,
    Foreign Key (user_id) 
    REFERENCES user(id),

    note_id INT NOT NULL,
    Foreign Key (note_id) 
    REFERENCES note(id),

    categorie_id INT NOT NULL,
    Foreign Key (categorie_id) 
    REFERENCES categorie(id)

);