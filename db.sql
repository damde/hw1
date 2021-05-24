SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE HOTELS(
  id int NOT NULL AUTO_INCREMENT,
  denomination VARCHAR(128),
  description VARCHAR(512),
  address VARCHAR(128),
  image VARCHAR(128),
  PRIMARY KEY(id)
);
CREATE TABLE STANZE(
  IDStanza int NOT NULL AUTO_INCREMENT,
  hotel int,
  numero int,
  prezzo float,
  tipo VARCHAR(32),
  image VARCHAR(32),
  FOREIGN KEY(hotel) REFERENCES HOTELS(id),
  PRIMARY KEY(IDStanza)
);
CREATE TABLE CLIENTI(
  username VARCHAR(32),
  name VARCHAR(32),
  surname VARCHAR(32),
  email VARCHAR(128),
  password VARCHAR(60),
  PRIMARY KEY(username)
);

CREATE TABLE PRENOTAZIONI(
  IDPrenotazione int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  cliente VARCHAR(32),
  dataPrenotazione date NOT NULL DEFAULT NOW(),
  dataInizio date,
  dataFine date,
  prezzoTotale float,
  FOREIGN KEY (cliente) REFERENCES CLIENTI(username)
);

CREATE TABLE PRENOTA(
  prenotazione int NOT NULL,
  stanza int NOT NULL,
  FOREIGN KEY(prenotazione) REFERENCES PRENOTAZIONI(IDPrenotazione),
  FOREIGN KEY(stanza) REFERENCES STANZE(IDStanza),
  PRIMARY KEY(prenotazione, stanza)
);
INSERT INTO HOTELS(denomination, description, address, image)
VALUES(
    'Hotel 1',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris risus ex, semper in semper quis, molestie quis justo. Nunc cursus tempor feugiat. Nulla nec convallis diam, quis egestas nulla. Fusce elementum dictum dignissim. Donec at metus id massa rutrum commodo.',
    'VIA DELLE VIE, CATANIA',
    'assets/images/one.png'
  ),
  (
    'Hotel 2',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris risus ex, semper in semper quis, molestie quis justo. Nunc cursus tempor feugiat. Nulla nec convallis diam, quis egestas nulla. Fusce elementum dictum dignissim. Donec at metus id massa rutrum commodo.',
    'VIALE DEI VIALI, MESSINA',
    'assets/images/two.png'
  ),
  (
    'Hotel 4',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris risus ex, semper in semper quis, molestie quis justo. Nunc cursus tempor feugiat. Nulla nec convallis diam, quis egestas nulla. Fusce elementum dictum dignissim. Donec at metus id massa rutrum commodo.',
    'PIAZZA X, PALERMO',
    'assets/images/three.png'
  ),
  (
    'Hotel 5',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris risus ex, semper in semper quis, molestie quis justo. Nunc cursus tempor feugiat. Nulla nec convallis diam, quis egestas nulla. Fusce elementum dictum dignissim. Donec at metus id massa rutrum commodo.',
    'VIA Y, PALERMO',
    'assets/images/threeh.png'
  );

INSERT INTO STANZE(hotel, prezzo, tipo)
VALUES (1, 50, "Singola"),
  (1, 100, "Doppia"),
  (1, 150, "Matrimoniale"),
  (1, 50, "Singola"),
  (1, 100, "Doppia"),
  (1, 150, "Matrimoniale"),
  (1, 50, "Singola"),
  (1, 100, "Doppia"),
  (1, 150, "Matrimoniale"),
  (1, 50, "Singola"),
  (1, 100, "Doppia"),
  (1, 150, "Matrimoniale"),
  (2, 50, "Singola"),
  (2, 100, "Doppia"),
  (2, 150, "Matrimoniale"),
  (3, 50, "Singola"),
  (3, 100, "Doppia"),
  (3, 150, "Matrimoniale"),
  (2, 50, "Singola"),
  (2, 100, "Doppia"),
  (2, 150, "Matrimoniale"),
  (3, 50, "Singola"),
  (3, 100, "Doppia"),
  (3, 150, "Matrimoniale"),
  (2, 50, "Singola"),
  (2, 100, "Doppia"),
  (2, 150, "Matrimoniale"),
  (3, 50, "Singola"),
  (3, 100, "Doppia"),
  (3, 150, "Matrimoniale");