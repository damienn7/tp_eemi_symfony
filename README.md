# tp_eemi_symfony

Init the project with Docker :
docker compose build

Install symfony :
docker compose run --rm app composer create-project symfony/skeleton:"8.1.*" .

Install depedencies :
docker compose run --rm app composer require symfony/twig-bundle doctrine/orm doctrine/doctrine-bundle doctrine/doctrine-migrations-bundle symfony/form symfony/validator symfony/security-bundle symfony/asset-mapper symfony/translation symfony/uid

docker compose run --rm app composer require --dev symfony/maker-bundle

Run the project :
docker compose up -d

Adminer connection :
Système : PostgreSQL
Serveur : db
Utilisateur : eventhub
Mot de passe : eventhub
Base : eventhub

Confifure app/.env :
DATABASE_URL="postgresql://eventhub:eventhub@db:5432/eventhub?serverVersion=16&charset=utf8"