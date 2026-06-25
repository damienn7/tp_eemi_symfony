# EventHub — TP EEMI Symfony

EventHub est une plateforme web développée avec Symfony permettant à des étudiants de publier, consulter et modérer des événements : soirées, ateliers, conférences, tournois, etc.

Le projet utilise Docker pour simplifier l’installation de l’environnement de développement.

## Stack technique

* Symfony 8.1
* PHP 8.4
* PostgreSQL
* Doctrine ORM
* Twig
* Symfony Security
* Docker / Docker Compose
* Adminer

## Prérequis

Avant de lancer le projet, assurez-vous d’avoir installé :

* Docker
* Docker Compose
* Git

## Installation du projet

Cloner le dépôt :

```bash
git clone URL_DU_DEPOT
cd tp_eemi_symfony
```

Construire les conteneurs Docker :

```bash
docker compose build
```

Lancer les conteneurs :

```bash
docker compose up -d
```

Installer les dépendances PHP :

```bash
docker compose exec app composer install
```

## Configuration de l’environnement

Dans le fichier `app/.env`, configurer la connexion à la base de données :

```env
DATABASE_URL="postgresql://eventhub:eventhub@db:5432/eventhub?serverVersion=16&charset=utf8"
```

## Base de données

Exécuter les migrations Doctrine :

```bash
docker compose exec app php bin/console doctrine:migrations:migrate
```

## Accès à l’application

L’application est disponible à l’adresse suivante :

```txt
http://localhost:8080
```

## Accès à Adminer

Adminer est disponible à l’adresse suivante :

```txt
http://localhost:8081
```

Informations de connexion :

```txt
Système : PostgreSQL
Serveur : db
Utilisateur : eventhub
Mot de passe : eventhub
Base : eventhub
```

## Commandes utiles

Lancer le projet :

```bash
docker compose up -d
```

Arrêter le projet :

```bash
docker compose down
```

Vider le cache Symfony :

```bash
docker compose exec app php bin/console cache:clear
```

Afficher les routes disponibles :

```bash
docker compose exec app php bin/console debug:router
```

Exécuter les migrations :

```bash
docker compose exec app php bin/console doctrine:migrations:migrate
```

Valider le schéma Doctrine :

```bash
docker compose exec app php bin/console doctrine:schema:validate
```

## Dépendances installées

Dépendances principales :

```bash
docker compose run --rm app composer require symfony/twig-bundle doctrine/orm doctrine/doctrine-bundle doctrine/doctrine-migrations-bundle symfony/form symfony/validator symfony/security-bundle symfony/asset-mapper symfony/translation symfony/uid
docker compose exec app composer require symfony/mailer symfonycasts/verify-email-bundle
docker compose exec app composer require symfony/apache-pack
docker compose exec app composer require symfony/asset
```

Dépendances de développement :

```bash
docker compose run --rm app composer require --dev symfony/maker-bundle
```

## Initialisation du projet Symfony

Le projet a été initialisé avec la commande suivante :

```bash
docker compose run --rm app composer create-project symfony/skeleton:"8.1.*" .
```

## Fonctionnalités principales

* Inscription utilisateur
* Connexion et déconnexion
* Création d’événements
* Catégorisation des événements
* Upload d’image pour les événements
* Consultation des événements publiés
* Modération des événements par un administrateur
* Gestion des rôles et autorisations
* Interface de gestion via Symfony et Doctrine

## Compte administrateur

Pour donner le rôle administrateur à un utilisateur déjà inscrit, exécuter la requête SQL suivante dans Adminer :

```sql
UPDATE "user"
SET roles = '["ROLE_ADMIN"]'
WHERE email = 'votre-email@example.com';
```

Remplacer `votre-email@example.com` par l’adresse email du compte concerné.