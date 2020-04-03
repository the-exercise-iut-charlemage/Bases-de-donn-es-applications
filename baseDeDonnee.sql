CREATE TABLE user
(
  id INT AUTO_INCREMENT,
  email VARCHAR (30),
  name VARCHAR (15),
  surname VARCHAR (15),
  adress VARCHAR (30),
  phone VARCHAR (10),
  birth DATE,
  PRIMARY KEY (id)
);

CREATE TABLE message
(
  id INT AUTO_INCREMENT,
  title VARCHAR (15),
  content TEXT,
  created_at DATE,
  updated_at DATE,
  PRIMARY KEY (id)
);

CREATE TABLE message2user
(
  idusr INT,
  idmsg INT,
  PRIMARY KEY (idusr,idmsg)
);

CREATE TABLE message2game
(
  idgame INT,
  idmsg INT,
  PRIMARY KEY (idgame,idmsg)
);