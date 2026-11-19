CREATE TABLE Utilisateur(
   id_utili INT,
   identifiant VARCHAR(50),
   mdp_hash VARCHAR(256),
   nom VARCHAR(50),
   prenom VARCHAR(50),
   date_naissance DATE,
   mail VARCHAR(50),
   cle_publique VARCHAR(50),
   icone VARCHAR(50),
   PRIMARY KEY(id_utili)
);

CREATE TABLE Salon(
   id_salon INT,
   nom_salon VARCHAR(50),
   date_creation DATE,
   id_utili INT NOT NULL,
   PRIMARY KEY(id_salon),
   FOREIGN KEY(id_utili) REFERENCES Utilisateur(id_utili)
);

CREATE TABLE Message(
   id_message VARCHAR(50),
   contenu_chiffre VARCHAR(250),
   message VARCHAR(230),
   date_envoi DATE,
   id_utili INT,
   id_salon INT,
   id_utili_1 INT NOT NULL,
   PRIMARY KEY(id_message),
   FOREIGN KEY(id_utili) REFERENCES Utilisateur(id_utili),
   FOREIGN KEY(id_salon) REFERENCES Salon(id_salon),
   FOREIGN KEY(id_utili_1) REFERENCES Utilisateur(id_utili)
);

CREATE TABLE Invitation(
   id_invit INT,
   lien_invitation VARCHAR(250),
   date_creation DATE,
   id_salon INT NOT NULL,
   PRIMARY KEY(id_invit),
   FOREIGN KEY(id_salon) REFERENCES Salon(id_salon)
);

CREATE TABLE participer(
   id_utili INT,
   id_salon INT,
   PRIMARY KEY(id_utili, id_salon),
   FOREIGN KEY(id_utili) REFERENCES Utilisateur(id_utili),
   FOREIGN KEY(id_salon) REFERENCES Salon(id_salon)
);
