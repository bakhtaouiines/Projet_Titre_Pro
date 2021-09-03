#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Role
#------------------------------------------------------------

CREATE TABLE Role(
        id    Int  Auto_increment  NOT NULL ,
        name  Varchar (50) NOT NULL ,
        level Int NOT NULL
	,CONSTRAINT Role_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: User
#------------------------------------------------------------

CREATE TABLE User(
        id            Int  Auto_increment  NOT NULL ,
        pseudo        Varchar (20) NOT NULL ,
        mail          Varchar (80) NOT NULL ,
        password_hash Varchar (255) NOT NULL ,
        avatar        Varchar (50) ,
        hash          Varchar (50) ,
        is_activated  Bool NOT NULL ,
        id_Role       Int NOT NULL
	,CONSTRAINT User_PK PRIMARY KEY (id)

	,CONSTRAINT User_Role_FK FOREIGN KEY (id_Role) REFERENCES Role(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Composer
#------------------------------------------------------------

CREATE TABLE Composer(
        id        Int  Auto_increment  NOT NULL ,
        lastname  Varchar (50) NOT NULL ,
        firstname Varchar (50) NOT NULL ,
        birthdate Date NOT NULL ,
        deathdate Date
	,CONSTRAINT Composer_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Badge
#------------------------------------------------------------

CREATE TABLE Badge(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT Badge_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Playlist
#------------------------------------------------------------

CREATE TABLE Playlist(
        id          Int  Auto_increment  NOT NULL ,
        name        Varchar (50) NOT NULL ,
        description Varchar (255) ,
        id_User     Int NOT NULL
	,CONSTRAINT Playlist_PK PRIMARY KEY (id)

	,CONSTRAINT Playlist_User_FK FOREIGN KEY (id_User) REFERENCES User(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Article
#------------------------------------------------------------

CREATE TABLE Article(
        id      Int  Auto_increment  NOT NULL ,
        title   Varchar (50) NOT NULL ,
        content Longtext NOT NULL ,
        id_User Int NOT NULL
	,CONSTRAINT Article_PK PRIMARY KEY (id)

	,CONSTRAINT Article_User_FK FOREIGN KEY (id_User) REFERENCES User(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Comment
#------------------------------------------------------------

CREATE TABLE Comment(
        id         Int  Auto_increment  NOT NULL ,
        content    Varchar (255) NOT NULL ,
        date       Date NOT NULL ,
        id_User    Int NOT NULL ,
        id_Article Int NOT NULL
	,CONSTRAINT Comment_PK PRIMARY KEY (id)

	,CONSTRAINT Comment_User_FK FOREIGN KEY (id_User) REFERENCES User(id)
	,CONSTRAINT Comment_Article0_FK FOREIGN KEY (id_Article) REFERENCES Article(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: BadgeList
#------------------------------------------------------------

CREATE TABLE BadgeList(
        id       Int  Auto_increment  NOT NULL ,
        id_User  Int NOT NULL ,
        id_Badge Int NOT NULL
	,CONSTRAINT BadgeList_PK PRIMARY KEY (id)

	,CONSTRAINT BadgeList_User_FK FOREIGN KEY (id_User) REFERENCES User(id)
	,CONSTRAINT BadgeList_Badge0_FK FOREIGN KEY (id_Badge) REFERENCES Badge(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: OSTPicture
#------------------------------------------------------------

CREATE TABLE OSTPicture(
        id    Int  Auto_increment  NOT NULL ,
        path  Varchar (80) NOT NULL ,
        title Varchar (50) NOT NULL ,
        alt   Varchar (50) NOT NULL
	,CONSTRAINT OSTPicture_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: OST
#------------------------------------------------------------

CREATE TABLE OST(
        id            Int  Auto_increment  NOT NULL ,
        name          Varchar (50) NOT NULL ,
        summary       Text NOT NULL ,
        date          Date NOT NULL ,
        buy_link      Varchar (255) NOT NULL ,
        music_link    Varchar (255) NOT NULL ,
        id_OSTPicture Int NOT NULL
	,CONSTRAINT OST_PK PRIMARY KEY (id)

	,CONSTRAINT OST_OSTPicture_FK FOREIGN KEY (id_OSTPicture) REFERENCES OSTPicture(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Category
#------------------------------------------------------------

CREATE TABLE Category(
        id     Int  Auto_increment  NOT NULL ,
        name   Varchar (155) NOT NULL ,
        id_OST Int NOT NULL
	,CONSTRAINT Category_PK PRIMARY KEY (id)

	,CONSTRAINT Category_OST_FK FOREIGN KEY (id_OST) REFERENCES OST(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Vote
#------------------------------------------------------------

CREATE TABLE Vote(
        id      Int  Auto_increment  NOT NULL ,
        vote    Int NOT NULL ,
        id_User Int NOT NULL ,
        id_OST  Int NOT NULL
	,CONSTRAINT Vote_PK PRIMARY KEY (id)

	,CONSTRAINT Vote_User_FK FOREIGN KEY (id_User) REFERENCES User(id)
	,CONSTRAINT Vote_OST0_FK FOREIGN KEY (id_OST) REFERENCES OST(id)
	,CONSTRAINT Vote_User_AK UNIQUE (id_User)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: PlaylistList
#------------------------------------------------------------

CREATE TABLE PlaylistList(
        id          Int  Auto_increment  NOT NULL ,
        id_Playlist Int NOT NULL ,
        id_OST      Int NOT NULL
	,CONSTRAINT PlaylistList_PK PRIMARY KEY (id)

	,CONSTRAINT PlaylistList_Playlist_FK FOREIGN KEY (id_Playlist) REFERENCES Playlist(id)
	,CONSTRAINT PlaylistList_OST0_FK FOREIGN KEY (id_OST) REFERENCES OST(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: MiniPost
#------------------------------------------------------------

CREATE TABLE MiniPost(
        id      Int  Auto_increment  NOT NULL ,
        content Text NOT NULL ,
        id_User Int NOT NULL ,
        id_OST  Int NOT NULL
	,CONSTRAINT MiniPost_PK PRIMARY KEY (id)

	,CONSTRAINT MiniPost_User_FK FOREIGN KEY (id_User) REFERENCES User(id)
	,CONSTRAINT MiniPost_OST0_FK FOREIGN KEY (id_OST) REFERENCES OST(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ArticlePicture
#------------------------------------------------------------

CREATE TABLE ArticlePicture(
        id         Int  Auto_increment  NOT NULL ,
        title      Varchar (50) NOT NULL ,
        path       Varchar (80) NOT NULL ,
        alt        Varchar (50) NOT NULL ,
        id_Article Int NOT NULL
	,CONSTRAINT ArticlePicture_PK PRIMARY KEY (id)

	,CONSTRAINT ArticlePicture_Article_FK FOREIGN KEY (id_Article) REFERENCES Article(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ComposerList
#------------------------------------------------------------

CREATE TABLE ComposerList(
        id          Int  Auto_increment  NOT NULL ,
        id_OST      Int NOT NULL ,
        id_Composer Int NOT NULL
	,CONSTRAINT ComposerList_PK PRIMARY KEY (id)

	,CONSTRAINT ComposerList_OST_FK FOREIGN KEY (id_OST) REFERENCES OST(id)
	,CONSTRAINT ComposerList_Composer0_FK FOREIGN KEY (id_Composer) REFERENCES Composer(id)
)ENGINE=InnoDB;

