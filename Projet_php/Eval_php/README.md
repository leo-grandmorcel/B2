# php_exam

## Présentation du projet

Ce projet fait en php est un site E-commerce où l'on peut acheter des produits et les mettre dans un panier. Il est possible de s'inscrire et de se connecter ou simplement de consulter les articles sans se connecter.

## Prérequis et installation

### Prérequis

Il va falloir installer le logiciel XAMPP afin de pouvoir lancer le serveur web et la base de données.

Modifiez ensuite dans la configuration apache de XAMPP

```
DocumentRoot "C:/xampp/htdocs/php_exam"
<Directory "C:/xampp/htdocs/php_exam">
```

Cela permettra de pouvoir accéder au site via l'url : `http://localhost`

Au lieu de `http://localhost/php_exam`

### Installation

L'installation est simple, il suffit de cloner le répertoire git en faisant la commande :

```bash
git clone https://ytrack.learn.ynov.com/git/LGRAND-MORCEL/php_exam.git
```

Une fois le répertoire cloné il suffit de lancer le serveur web et la base de données via XAMPP.

Rentrez dans votre navigateur l'url : http://localhost/phpmyadmin5/index.php?route=/server/databases

Créez une base de données nommée `php_exam_db` et importez le fichier `php_exam_db.sql` qui se trouve dans le répertoire fichier cloné. Cela va créer les tables.

Une fois la base de données créée, il suffit de se rendre sur le site via l'url : http://localhost

De plus, il est possible de se connecter en tant qu'administrateur avec les identifiants suivants :

Identifiant : `admin@admin.com`

Mot de passe : `admin`

## Fonctionnalités

- Pouvoir créer un compte et se connecter.
- Pouvoir modifier ses informations d'utilisateur ainsi que son image de profil et son mot de passe.
- Pouvoir vendre un article en ajoutant une image, un titre, une description, un prix et une quantité.
- Pouvoir acheter un article en ajoutant un article au panier.
- Pouvoir modifier la quantité d'un article dans le panier ou supprimer cet article du panier.
- Rechercher un article par son nom.
- En tant qu'administrateur, pouvoir supprimer/modifier un article ou un utilisateur.
