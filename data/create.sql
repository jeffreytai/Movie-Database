CREATE TABLE Movie(
	id int CHECK(id>0),
	title varchar(100),
	year int,
	rating varchar(10),
	company varchar(50),
	PRIMARY KEY(id, title)
) ENGINE=InnoDB;

# No movies can have both the same id and title
# The id of each movie must be valid, or greater than 0

CREATE TABLE Actor (
	id int CHECK(id>0),
	last varchar(20),
	first varchar(20),
	sex varchar(6),
	dob DATE,
	dod DATE,
	PRIMARY KEY(id, last, first),
	UNIQUE(id, dob)
) ENGINE=InnoDB;

# No actors can have all the same id, last, and first name
# The id of each actor must be valid, or greater than 0

CREATE TABLE Director (
	id int CHECK(id>0),
	last varchar(20),
	first varchar(20),
	dob DATE,
	dod DATE,
	PRIMARY KEY(id, last, first),
	UNIQUE(id, dob)
) ENGINE=InnoDB;

# No directors can have all the same id, last, and first name
# The id of each director must be valid, or greater than 0

CREATE TABLE MovieGenre (
	mid int,
	genre varchar(20),
	FOREIGN KEY(mid) REFERENCES Movie(id)
) ENGINE=InnoDB;

# No tuple in MovieGenre can have the same movie id
# The id in Movie to which MovieGenre refers to must always exist

CREATE TABLE MovieDirector (
	mid int,
	did int,
	PRIMARY KEY(mid),
	FOREIGN KEY(mid) REFERENCES Movie(id),
	FOREIGN KEY(did) REFERENCES Director(id)
) ENGINE=InnoDB;

# No tuple in MovieDirector can have the same movie id
# The id in Movie to which MovieDirector refers to must always exist
# The id in Director to which MovieDirector refers to must always exist

CREATE TABLE MovieActor (
	mid int,
	aid int,
	role varchar(50),
	PRIMARY KEY(mid, aid),
	FOREIGN KEY(mid) REFERENCES Movie(id),
	FOREIGN KEY(aid) REFERENCES Actor(id)
) ENGINE=InnoDB;

# No tuples in MovieActor can have the same movie id and actor id
# The id in Movie to which the MovieActor refers to must always exist
# The id in Actor to which the MovieActor refers to must always exist

CREATE TABLE Review (
	name varchar(20),
	time TIMESTAMP,
	mid int,
	rating int,
	comment varchar(500),
	PRIMARY KEY (name,mid),
	FOREIGN KEY(mid) REFERENCES Movie(id)
) ENGINE=InnoDB;

# No tuples in Review can be the same person and about the same movie
# The id in Movie to which Review refers to must always exist

CREATE TABLE MaxPersonID (
	id int
);

CREATE TABLE MaxMovieID (
	id int
);
