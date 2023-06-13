import sqlite3
import argparse
import random
from pycountry import languages as lg
from faker import Faker

parser = argparse.ArgumentParser()
parser.add_argument("db_name", type=str, help="Path of Database")
args = parser.parse_args()

db_name = args.db_name
conn = sqlite3.connect(db_name)
cursor = conn.cursor()

fake = Faker()

# Genre
genres = [("Action",), ("Adventure",), ("Animation",), ("Comedy",), ("Crime",), ("Documentary",), ("Drama",), ("Family",), ("Fantasy",), ("History",), ("Horror",), ("Music",), ("Mystery",), ("Romance",), ("Science Fiction",), ("TV Movie",), ("Thriller",), ("War",), ("Western",)]
cursor.executemany("INSERT INTO genre (name) VALUES (?)",genres)


# Keyword
keywords = [
    (fake.word(),)
    for _ in range(100)
]
cursor.executemany("INSERT INTO keyword (name) VALUES (?)",keywords)


# Language
languages = [
    (language.alpha_2, language.name)
    for language in lg
    if hasattr(language, 'alpha_2') and hasattr(language, 'name')
]
cursor.executemany("INSERT INTO language (code, name) VALUES (?, ?)",(languages))


# Production_company 
production_companies = [
    (fake.company(), fake.country())
    for _ in range(10)
]
cursor.executemany("INSERT INTO production_company (name, origin_country) VALUES (?, ?)",production_companies)


# Department
departments = [("Directing",), ("Writing",), ("Cinematography",), ("Editing",), ("Production",), ("Sound",), ("Art",), ("Costume",), ("Makeup",), ("Visual Effects",),]
cursor.executemany("INSERT INTO department (department_name) VALUES (?)",departments)



# Gender
genders = [("Female",),("Male",),("Non-binary",),("Transgender",),("Other",)]
cursor.executemany("INSERT INTO gender (name) VALUES (?)",genders)


# Person
person = [
    (fake.first_name(), fake.last_name(), fake.date_of_birth().strftime('%Y-%m-%d'),round(random.uniform(0.0,10.0),2), fake.random_int(1,len(genders)))
    for _ in range(3000)
]
cursor.executemany("INSERT INTO person (firstName, lastName, birthDate, popularity, gender_id) VALUES (?, ?, ?, ?, ?)",person)


# Movie
movies = [
    (fake.boolean(),
    fake.random_int(min=10, max=100000, step=1),
    random.choice(languages)[0],
    fake.sentence(nb_words=4,variable_nb_words=True),
    fake.paragraph(nb_sentences=3, variable_nb_sentences=False),
    round(random.uniform(0.0,10.0),2), 
    fake.sentence(nb_words=2, variable_nb_words=False),
    fake.sentence(nb_words=4,variable_nb_words=True), 
    round(random.uniform(0.0,10.0),2),
    fake.random_number(digits=6))
    for _ in range(500)
]
cursor.executemany("INSERT INTO movie (adult, budget, original_language, original_title, overview, popularity, status, title, vote_average, vote_count) VALUES (?,?,?,?,?,?,?,?,?,?)", movies)


# Movie_genre
movies_genres = []
for index in range(len(movies)) :
    movie_id = index + 1
    for _ in range(random.randint(1, 3)):
        genre_id = fake.random_int(min=1, max=len(genres), step=1)
        movies_genres.append((movie_id, genre_id))
cursor.executemany("INSERT INTO movie_genre (movie_id, genre_id) VALUES (?, ?)", movies_genres)


# Movie_cast
movies_cast = []
for index in range(len(movies)) :
    movie_id = index + 1
    for order in range(1,random.randint(5, 10)):
        person_id = fake.random_int(min=1, max=len(person), step=1)
        gender_id = fake.random_int(min=1, max=len(genders),step=1)
        character_name = fake.name()
        cast_order = order
        movies_cast.append((movie_id,gender_id, person_id, character_name, cast_order))
cursor.executemany("INSERT INTO movie_cast (movie_id,gender_id, person_id, character_name, cast_order) VALUES (?, ?, ?, ?, ?)", movies_cast)


# Movie_crew
movies_crew = []
for index in range(len(movies)) :
    movie_id = index + 1
    for _ in range(random.randint(5, 50)):
        person_id = fake.random_int(min=1, max=len(person), step=1)
        department_id = fake.random_int(min=1, max=len(departments), step=1)
        job = fake.job()
        movies_crew.append((movie_id, person_id, department_id, job))
cursor.executemany("INSERT INTO movie_crew (movie_id, person_id, department_id, job) VALUES (?, ?, ?, ?)", movies_crew)

# Movie_keyword
movies_keywords = []
for index in range(len(movies)) :
    movie_id = index + 1
    for _ in range(random.randint(1, 10)):
        keyword_id = fake.random_int(min=1, max=len(keywords), step=1)
        movies_keywords.append((movie_id, keyword_id))

cursor.executemany("INSERT INTO movie_keyword (movie_id, keyword_id) VALUES (?, ?)", movies_keywords)


# Movie_company
movies_companies = [
    (i+1, fake.random_int(min=1, max=len(production_companies), step=1))
    for i in range(len(movies))
]

cursor.executemany("INSERT INTO movie_company (movie_id, company_id) VALUES (?, ?)", movies_companies)


# Movie_language
movies_languages = []
for index in range(len(movies)) :
    movie_id = index + 1
    for _ in range(random.randint(3, 10)):
        language_id = fake.random_int(min=1, max=len(languages), step=1)
        movies_languages.append((movie_id, language_id))
cursor.executemany("INSERT INTO movie_language (movie_id, language_id) VALUES (?, ?)", movies_languages)

# FILL THE FUCKING DATABASE
conn.commit()