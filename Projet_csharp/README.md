## Présentation du projet

WeatherApp est une application météo codée en C# utilisant l'api [OpenWeatherMap](https://openweathermap.org/api)


## Installation et utilisation

L'installation est simple, il suffit de cloner le répertoire git en faisant la commande :

```bash
git clone https://ytrack.learn.ynov.com/git/ACORRE2/WeatherApp.git
```

Après avoir cloné le répertoire vous devez créer un fichier Api_key.txt à la racine du projet et y écrire votre propre clé API Openweather.

Une fois fait, lancez tout simplement la commande ci-dessous dans le dossier `WeatherApp` :

```bash
dotnet run
```

La commande va directement lancer l'application

## Fonctionnalités

- Une page prévision qui affiche la météo de la ville par défaut sur 5 jours.
- Une page recherche qui permet d'obtenir la météo actuelle avec une courte description de la ville recherchée.
- Une page paramètres qui permet de changer la langue des requêtes ou la ville par défaut.
