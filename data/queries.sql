SELECT concat(first,' ',last)
FROM Movie JOIN MovieActor ON Movie.id=MovieActor.mid
	JOIN Actor ON Actor.id=MovieActor.aid
WHERE Movie.title='Die Another Day';

-- This query gives the names of all the actors in the movie 'Die Another Day' in the format of <firstname> <lastname> --

SELECT COUNT(*)
FROM ( SELECT Actor.id, COUNT(*)
	FROM Actor JOIN MovieActor ON Actor.id=MovieActor.aid
	GROUP BY Actor.id
	HAVING COUNT(*) > 1
	) A;

-- This query gives me the count of all the actors who acted in multiple movies. --

SELECT mid
FROM MovieDirector
WHERE did IN (SELECT id
		FROM Director
		WHERE dod IS NOT NULL);

-- Find the movie IDs of directors who have passed away --
