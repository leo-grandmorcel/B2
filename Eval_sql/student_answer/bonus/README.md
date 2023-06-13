# Faker_insert

## Utilisation

Le programme `faker_insert.py` s'utilise en ligne de commande avec python 3.10
Il est nécessaire d'installer les packets pycountry et Faker via la commande ci-dessous

```
pip install pycountry Faker
```

Il est nécessaire de préciser le chemin de la base de donnée à remplir.
Exemple d'utilisation :

```
python faker_insert.py <nomBDD>.db
```

## Description

`faker_insert.py` va remplir la base de données avec des informations fausses, en utilisant la librairie Faker.

Seules les tables Genre, Genders et Language possèdent des vrais valeurs.