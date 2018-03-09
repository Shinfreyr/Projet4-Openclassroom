#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: account
#------------------------------------------------------------

CREATE TABLE account(
        idAccount     int (11) Auto_increment  NOT NULL ,
        pseudo        Varchar (25) NOT NULL ,
        firstName     Varchar (25) ,
        lastName      Varchar (25) ,
        eMail         Varchar (60) NOT NULL ,
        avatar        Varchar (60) ,
        pass          Char (60) NOT NULL ,
        accountStatue Varchar (25) NOT NULL ,
        PRIMARY KEY (idAccount )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: posts
#------------------------------------------------------------

CREATE TABLE posts(
        idPost      int (11) Auto_increment  NOT NULL ,
        titlePost   Text NOT NULL ,
        contentPost Longtext ,
        imagePost   Varchar (60) ,
        datePost    Varchar (60) NOT NULL ,
        postStatue  Varchar (25) NOT NULL ,
        idAccount   Int NOT NULL ,
        PRIMARY KEY (idPost )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: comments
#------------------------------------------------------------

CREATE TABLE comments(
        idComments     int (11) Auto_increment  NOT NULL ,
        contentComment Text NOT NULL ,
        dateComment    Date NOT NULL ,
        alertComment   Int ,
        statueComment  Varchar (25) NOT NULL ,
        idAccount      Int NOT NULL ,
        idPost         Int NOT NULL ,
        PRIMARY KEY (idComments )
)ENGINE=InnoDB;

ALTER TABLE posts ADD CONSTRAINT FK_posts_idAccount FOREIGN KEY (idAccount) REFERENCES account(idAccount);
ALTER TABLE comments ADD CONSTRAINT FK_comments_idAccount FOREIGN KEY (idAccount) REFERENCES account(idAccount);
ALTER TABLE comments ADD CONSTRAINT FK_comments_idPost FOREIGN KEY (idPost) REFERENCES posts(idPost);
