# api--product-alten
Guide d'installation du projet Symfony et test de la collection Postman

Ce guide vous explique comment installer un projet Symfony et tester une collection Postman associée.

Prérequis

Assurez-vous d'avoir les outils suivants installés sur votre machine :

PHP (version >= 8.1)

Composer

Symfony CLI

MySQL ou un autre SGBD compatible

Postman

Git

Installation du projet Symfony

1. Clôner le dépôt

Exécutez la commande suivante pour clôner le projet depuis le dépôt Git :

git clone <URL_DU_DEPOT>
cd <NOM_DU_PROJET>

2. Installer les dépendances

Utilisez Composer pour installer les dépendances :

composer install

3. Configurer les variables d'environnement

Copiez le fichier .env pour créer un fichier .env.local :

cp .env .env.local

Modifiez le fichier .env.local pour y configurer votre connexion à la base de données :

DATABASE_URL="mysql://<UTILISATEUR>:<MOT_DE_PASSE>@127.0.0.1:3306/<NOM_DE_LA_BDD>"

4. Créer la base de données

Exécutez les commandes suivantes pour créer la base de données et appliquer les migrations :

php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

5. Lancer le serveur de développement

Démarrez le serveur Symfony :

symfony server:start

Le projet sera disponible à l'adresse suivante : http://127.0.0.1:8000

Tester la collection Postman

1. Importer la collection

Ouvrez Postman.

Cliquez sur Import (en haut à gauche).

Sélectionnez le fichier .json de la collection Postman fourni avec le projet.

2. Configurer l'environnement

Cliquez sur Environments (en haut à droite).

Créez un nouvel environnement avec les variables suivantes :

base_url: http://127.0.0.1:8000

D'autres variables peuvent être ajoutées selon les besoins de votre projet.

3. Exécuter les requêtes

Sélectionnez l'environnement configuré.

Naviguez dans la collection importée.

Exécutez les différentes requêtes pour vérifier les fonctionnalités de l'API.

Ressources supplémentaires

Documentation Symfony

Postman Documentation

Si vous rencontrez des problèmes, n'hésitez pas à consulter les journaux ou à demander de l'aide. Bonne installation !
