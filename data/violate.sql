# 3 primary key constraints

Movie: id, title
INSERT INTO Movie VALUES(262,"Baby Take a Bow",2010,"PG-13","Paramount Pictures");
-- A tuple with the same movie id and title already exist --

Actor: id, last, first
INSERT INTO Actor VALUES(163,"Achour","Doria","Male",19361108,\n);
-- A tuple with the same Actor id, first, and last name already exist --

Director: id, last, first
INSERT INTO Director VALUES(23414,"Goldberg","Adam",19560803,\n);
-- A tuple with the same Director id, first, and last name already exist --

Extras -
MovieGenre: mid
MovieDirector: mid
MovieActor: mid, aid
Review: name, mid


# 6 referential integrity constraints

MovieGenre: mid REFERENCES Movie(id)
INSERT INTO MovieGenre VALUES(0,"Horror");
-- The Movie Genre mid must reference a valid Movie id --

MovieDirector: mid REFERENCES Movie(id)
INSERT INTO MovieDirector VALUES(0,68367);
-- The Movie Director mid must reference a valid Movie id --

MovieDirector: did REFERENCES Director(id)
INSERT INTO MovieDirector VALUES(1074,0);
-- The Movie Director did must reference a valid Director id --

MovieActor: mid REFERENCES Movie(id)
INSERT INTO MovieActor VALUES(0,68596,"Helen Schmidt");
-- Movie Actor mid must reference a valid Movie id --

MovieActor: aid REFERENCES Actor(id)
INSERT INTO MovieActor VALUES(241,0,"Lindsey's Mum");
-- Movie Actor aid must reference a valid Actor id --

Review: mid REFERENCES Movie(id)
INSERT INTO Review VALUES("Jeffrey Tai",2014-10-26 03:04:15,0,4,"This movie sucked");
-- Review mid must reference a valid Movie id --

# 3 CHECK constraints

Movie: CHECK(id > 0)
INSERT INTO Movie VALUES(-2,"The Hills Have Eyes",2006,"R","Dune Entertainment");
-- The Movie id is less than 0 --

Actor: CHECK(id > 0)
INSERT INTO Actor VALUES(-1,"Brown","Joe","Male",112494,\n);
-- The Actor id is less than 0 --

Director: CHECK(id > 0)
INSERT INTO Director VALUES(-3,"Jeffrey","Tai",102586,\n);
-- The Director id is less than 0 --
