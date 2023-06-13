CREATE TABLE movie (
  movie_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  adult BOOLEAN NOT NULL,
  budget INTEGER NOT NULL,
  original_language TEXT NOT NULL,
  original_title TEXT,
  overview TEXT,
  popularity REAL,
  status TEXT,
  title TEXT NOT NULL,
  vote_average REAL,
  vote_count INTEGER
);
CREATE TABLE genre (
  genre_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  name TEXT NOT NULL
);
CREATE TABLE keyword (
  keyword_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  name TEXT NOT NULL
);
CREATE TABLE language (
  language_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  code TEXT NOT NULL,
  name TEXT NOT NULL
);
CREATE TABLE production_company (
  company_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  name TEXT NOT NULL,
  origin_country TEXT NOT NULL
);
CREATE TABLE department (
  department_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  department_name TEXT NOT NULL
);
CREATE TABLE gender (
    gender_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    name TEXT NOT NULL
);
CREATE TABLE person (
    person_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    firstName TEXT NOT NULL,
    lastName TEXT NOT NULL,
    birthDate TEXT NOT NULL,
    popularity REAL,
    gender_id INTEGER NOT NULL,
    FOREIGN KEY (gender_id) REFERENCES gender(gender_id)
);
CREATE TABLE movie_crew (
  movie_id INTEGER NOT NULL,
  department_id INTEGER NOT NULL,
  person_id INTEGER NOT NULL,
  job TEXT NOT NULL,
  FOREIGN KEY (movie_id) REFERENCES movie(movie_id),
  FOREIGN KEY (department_id) REFERENCES department(department_id),
  FOREIGN KEY (person_id) REFERENCES person(person_id)
);
CREATE TABLE movie_cast (
  movie_cast_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  movie_id INTEGER NOT NULL,
  gender_id INTEGER NOT NULL,
  person_id INTEGER NOT NULL,
  character_name TEXT NOT NULL,
  cast_order INTEGER NOT NULL,
  FOREIGN KEY (movie_id) REFERENCES movie(movie_id),
  FOREIGN KEY (gender_id) REFERENCES gender(gender_id),
  FOREIGN KEY (person_id) REFERENCES person(person_id)
);
CREATE TABLE movie_genre (
  movie_id INTEGER NOT NULL,
  genre_id INTEGER NOT NULL,
  FOREIGN KEY (movie_id) REFERENCES movie(movie_id),
  FOREIGN KEY (genre_id) REFERENCES genre(genre_id)
);
CREATE TABLE movie_keyword (
  movie_id INTEGER NOT NULL,
  keyword_id INTEGER NOT NULL,
  FOREIGN KEY (movie_id) REFERENCES movie(movie_id),
  FOREIGN KEY (keyword_id) REFERENCES keyword(keyword_id)
);
CREATE TABLE movie_language (
  movie_id INTEGER NOT NULL,
  language_id INTEGER NOT NULL,
  FOREIGN KEY (movie_id) REFERENCES movie(movie_id),
  FOREIGN KEY (language_id) REFERENCES language(language_id)
);
CREATE TABLE movie_company (
  movie_id INTEGER NOT NULL,
  company_id INTEGER NOT NULL,
  FOREIGN KEY (movie_id) REFERENCES movie(movie_id),
  FOREIGN KEY (company_id) REFERENCES production_company(company_id)
);